<?php
class AMCN_S3_Uploads_Public {
    var $options;
    var $s3;
	var $meta;

	function AMCN_S3_Uploads_Public() {
		$this->options = array();
		if (file_exists(dirname(__FILE__).'/config.php')) {
			require_once(dirname(__FILE__).'/config.php');
			if ($amcn_s3_uploads_config) $this->options = $amcn_s3_uploads_config;
		}
		add_action('plugins_loaded', array(&$this, 'addhooks'));
	}
    function addhooks() {
		add_filter('wp_get_attachment_url', array(&$this, 'wp_get_attachment_url'), 9, 2);
		add_filter('the_content', array($this, 'filter_content'), 9999, 1);
	}
	function wp_get_attachment_url($url, $postID) {
        if (!$this->options) $this->options = get_option('amcn_s3_uploads');

        if ($this->options['enable-plugin'] && ($amazon = get_post_meta($postID, 'amazonS3_info', true))) {
	        if ( isset($this->options['alt-dns']) && $this->options['alt-dns'] ) {
	        	$accessDomain = $this->options['alt-dns'];
			}
	    	elseif ( isset($this->options['virtual-host']) && $this->options['virtual-host'] ) {
	    		$accessDomain = $this->options['bucket'];
	    	}
	        else {
				$accessDomain = $amazon['bucket'] . '.s3.amazonaws.com';
	        }

	        $url = 'http://'.$accessDomain.'/'.$amazon['key'];

	        $url = apply_filters( 'wps3_get_attachment_url', $url, $postID, $this );
	    }

        return $url;
    }


	/**
	* Generate a link to download a file from Amazon S3 using query string
	* authentication. This link is only valid for a limited amount of time.
	*
	* @param $bucket The name of the bucket in which the file is stored.
	* @param $filekey The key of the file, excluding the leading slash.
	* @param $expires The amount of time the link is valid (in seconds).
	* @param $operation The type of HTTP operation. Either GET or HEAD.
	*/
	function get_secure_attachment_url($postID, $expires = 900, $operation = 'GET') {
        if (!$this->options) $this->options = get_option('amcn_s3_uploads');

        if (
			!$this->options['enable-plugin'] || !$this->options['key'] || !$this->options['secret']
			|| !$this->options['bucket'] || !($amazon = get_post_meta($postID, 'amazonS3_info', true))
		) {
			return false;
		}

		$accessDomain = $this->options['virtual-host'] ? $amazon['bucket'] : $amazon['bucket'].'.s3.amazonaws.com';

		$expire_time = time() + $expires;
		$filekey = rawurlencode($amazon['key']);
		$filekey = str_replace('%2F', '/', $filekey);
		$path = $amazon['bucket'] .'/'. $filekey;

		/**
		* StringToSign = HTTP-VERB + "\n" +
		* Content-MD5 + "\n" +
		* Content-Type + "\n" +
		* Expires + "\n" +
		* CanonicalizedAmzHeaders +
		* CanonicalizedResource;
		*/

		$stringtosign =
			$operation ."\n". // type of HTTP request (GET/HEAD)
			"\n". // Content-MD5 is meaningless for GET
			"\n". // Content-Type is meaningless for GET
			$expire_time ."\n". // set the expire date of this link
			"/$path"; // full path (incl bucket), starting with a /

		require_once(dirname(__FILE__).'/lib.s3.php');
		$s3 = new AMCN_S3($this->options['key'], $this->options['secret']);
		$signature = urlencode($s3->constructSig($stringtosign));

		return sprintf('http://%s/%s?AWSAccessKeyId=%s&Expires=%u&Signature=%s', $accessDomain, $filekey, $this->options['key'], $expire_time, $signature);
	}

	function filter_content($content){
		preg_match_all('/<img[^>]+./', $content, $matches);
		if($matches){
			foreach($matches[0] as $img){
				if(preg_match('/wp-content\/uploads/', $img)){
					preg_match('/src=\'?"?(.+(png|jpg|jpeg|bmp|gif))\'?"?/', $img, $match);
					if(isset($match[1])){
						$parts = explode('uploads', $match[1]);
						$upload_path = $parts[1];
						$site_bucket = isset($this->options['site-bucket']) && $this->options['site-bucket'] ? '/'.$this->options['site-bucket'] : '';
						$new_url = 'http://'.$this->options['alt-dns'].$site_bucket.'/wp-content/uploads'.$upload_path;
						$content = str_replace($match[1], $new_url, $content);
					}
				}
			}
		}
		return $content;
	}
}

function wps3_get_secure_attachment_url($postID, $expires = 900, $operation = 'GET') {
	global $amcn_s3_uploads;
	return $amcn_s3_uploads->get_secure_attachment_url($postID, $expires, $operation);
}
