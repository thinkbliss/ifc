<?php
/*
Plugin Name: AMCN S3 Conversion
Description: Converts previously uploaded attachments to work with amcn-s3-uploads plugin
Version: 0.1
Author: Brian Fegter
*/

/**
 * Converts previous attachment metadata to work with amcn-s3-uploads plugin
 */

class AMCN_S3_Conversion{

	/**
	 * Obscure Query Variable
	 * @var string
	 */
	private $key = 's3-conversion';

	/**
	 * Password
	 * @var string
	 */
	private $pass = 'benderisbest';

	/**
	 * Constructor Method
	 */
	public function __construct(){
		#Set a high priority so all admin assets load
		add_action('admin_init', array($this, 'migrate_data'), 9999999);
	}

	/**
	 * Verifies the authority of the user as well as the authenticity of the request
	 * Checks if:
	 * 	- Is wp-admin
	 * 	- User is logged in
	 * 	- User is an administrator
	 * 	- Query variable is set
	 * 	- Query variable value is correct
	 * @return bool
	 */
	protected function verify_request(){
		return
			is_admin()
			&& current_user_can('manage_options')
			&& isset($_GET[$this->key])
			&& $_GET[$this->key] === $this->pass
		? true : false;
	}

	/**
	 * Migration
	 * @return null - exits page load
	 */
	public function migrate_data(){

		#Check again since this is a public method
		if(!$this->verify_request())
			return;

		set_time_limit(0);

		show_message('<pre>');

		global $wpdb;

		$bucket = isset($_GET['bucket']) && $_GET['bucket'] ? $_GET['bucket'] : false;

		if(!$bucket){
			show_message('$_GET["bucket"] is not defined.');
			die();
		}

		$site_bucket = isset($_GET['site-bucket']) && $_GET['site-bucket'] ? $_GET['site-bucket'] : '';

		if(!$site_bucket){
			show_message('$_GET["site-bucket"] is not defined.');
			die();
		}

		$sql = "
			SELECT p.ID, pm.meta_value path
			FROM $wpdb->posts p
			LEFT JOIN $wpdb->postmeta pm
			ON p.ID = pm.post_id
			WHERE p.post_type = 'attachment'
			AND pm.meta_key = '_wp_attached_file'
		";
		$attachments = $wpdb->get_results($sql);
		$count = count($attachments);
		show_message("<h2>$count Attachments</h2>");
		$errors = 0;
		$error = array();
		foreach($attachments as $attachment){
			$s3_info = array();
			$s3_info['bucket'] = $bucket;
			$s3_info['key'] = trim("$site_bucket/wp-content/uploads/$attachment->path", '/');
			if(update_post_meta($attachment->ID, 'amazonS3_info', $s3_info))
				show_message("$count - #$attachment->ID - $attachment->path converted correctly");
			else{
				$errors++;
				$error[] = $attachment->ID.' - '.$attachment->path;
				show_message("<span style='font-weight:bold; color:red;'>$count - #$attachment->ID - $attachment->path was not converted</span>");
			}
			$count--;
		}
		show_message("<h2>$errors Errors</h2><span style='color:red;'");
		print_r($error);
		echo '</span></pre>';
		exit;
	}
}
new AMCN_S3_Conversion;
