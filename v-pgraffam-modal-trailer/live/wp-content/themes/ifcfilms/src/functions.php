<?php
/**
 * Author: Big Spaceship
 * URL: ifcfilms.com | @ifcfilms
 * Loads custom functions, support, custom post types and more.
 */

// Load external config files
add_action( 'after_setup_theme', function() {
  $all = get_template_directory() . '/inc/*.php';
  $index = get_template_directory() . '/inc/index.php';

  $wp_debug = defined('WP_DEBUG') AND WP_DEBUG;

  /* we want an index.php in the folder for security
   * but we don't want to load it into functions.php
   */

  // get all files in /inc and index page separately
  $all_files = ($wp_debug) ? glob($all, GLOB_ERR) : glob($all);
  $index_page = ($wp_debug) ? glob($index, GLOB_ERR) : glob($index);
  // diff index page out of globbed file arrays
  $files = array_diff($all_files, $index_page);

  // load functions
  foreach ($files as $file) {
    include $file;
  }
});
