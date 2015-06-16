<?php
$amcn_s3_uploads_config = array(
	'key' => '', // AWS Access Key ID
	'secret' => '', // AWS Secret Key
	'bucket' => 'images.amcnetworks.com', // S3 Bucket
	'site-bucket' => 'ifcfilms.com', //Use if stacking all sites in one bucket
	'enable-s3-tab' => false, // hide the Amazon S3 tab in the WordPress media screen
	'alt-dns' => 'images.amcnetworks.com',
	'enable-uploads' => true, //Readonly for everything bug prod
	'enable-plugin' => true, // Plugin kill switch
);

$env = substr($_SERVER['SERVER_NAME'], 0, strpos($_SERVER['SERVER_NAME'], '.'));

switch ($env){
	case 'www':
		$amcn_s3_uploads_config['enable-uploads'] = true;
		break;
}
