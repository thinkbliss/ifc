<?php
/*
Plugin Name: AMCN Amazon S3 Uploads
Description: Automatically copies media uploads to Amazon S3 for storage and delivery. Optionally configure Amazon CloudFront for even faster delivery.
Author: Brian Fegter
Version: 0.1
License: GPLv2 or greater

// Copyright (c) 2013 Brad Touesnard. All rights reserved.
// Forked Amazon S3 and Cloudfront (http://wordpress.org/plugins/amazon-s3-and-cloudfront/)
// which is a fork of Amazon S3 for WordPress with CloudFront (http://wordpress.org/extend/plugins/tantan-s3-cloudfront/)
// which is a fork of Amazon S3 for WordPress (http://wordpress.org/extend/plugins/tantan-s3/).

*/
if (class_exists('AMCN_S3_Uploads')) return;

if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/') >= 0) {
	$ver = get_bloginfo('version');
    if (version_compare(phpversion(), '5.0', '>=') && version_compare($ver, '2.1', '>=')) {
        require_once(dirname(__FILE__).'/inc/class-plugin.php');
        $amcn_s3_uploads = new AMCN_S3_Uploads();
	} elseif (ereg('wordpress-mu-', $ver)) {
        require_once(dirname(__FILE__).'/inc/class-plugin.php');
        $amcn_s3_uploads = new AMCN_S3_Uploads();
    } else {
        class AMCN_S3_Uploads_Error {
            function AMCN_S3_Uploads_Error() {add_action('admin_menu', array(&$this, 'addhooks'));}
            function addhooks() {add_options_page('Amazon S3', 'Amazon S3', 10, __FILE__, array(&$this, 'admin'));}
            function admin(){include(dirname(__FILE__).'/inc/admin-version-error.html');}
        }
        $error = new AMCN_S3_Uploads_Error();
    }
} else {
    require_once(dirname(__FILE__).'/inc/class-plugin-public.php');
    $amcn_s3_uploads = new AMCN_S3_Uploads_Public();
}
?>