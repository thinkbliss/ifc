<?php

add_action('init', 'ifcfilms_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'ifcfilms_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'ifcfilms_styles'); // Add Theme Stylesheet
add_filter('style_loader_tag', 'ifcfilms_style_remove'); // Remove 'text/css' from enqueued stylesheet

// Load IFC_Films scripts (header.php)
function ifcfilms_header_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    if (HTML5_DEBUG) {
      // Modernizr
      wp_register_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), '2.8.3');

      // Conditionizr
      wp_register_script('conditionizr', get_template_directory_uri() . '/js/conditionizr-4.3.0.min.js', array(), '4.3.0');

      // jQuery
      wp_deregister_script('jquery');
      wp_register_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '1.11.2');

      // If production
    } else {
      // Scripts minify
      wp_register_script('ifcfilmsscripts-min', get_template_directory_uri() . '/js/homepage.bundle.js', array(), '1.0.0');
      // Enqueue Scripts
      wp_enqueue_script('ifcfilmsscripts-min');
    }
  }
}

// Load IFC_Films conditional scripts
function ifcfilms_conditional_scripts() {
  // Enqueue Scripts
  if(is_page_template('template_home.php')) {
    // homepage
    wp_register_script('home-scripts', get_template_directory_uri() . '/js/homepage.bundle.js',
      array('conditionizr', 'modernizr', 'jquery'), '1.0.0', true);

    // pass in directory uri for trailer drawer images
    $variable_array = array('directoryURI' => get_template_directory_uri());
    wp_localize_script('home-scripts', 'wordpressData', $variable_array);

    wp_enqueue_script('home-scripts');
  } else if(is_singular('film')) {
    // single page
    wp_register_script('single-scripts', get_template_directory_uri() . '/js/single.bundle.js',
      array('conditionizr', 'modernizr', 'jquery'), '1.0.0', true);
    // pass in directory uri for trailer drawer images
    $variable_array = array('directoryURI' => get_template_directory_uri());
    wp_localize_script('single-scripts', 'wordpressData', $variable_array);

    wp_enqueue_script('single-scripts');
  } else {
    // generic page
    wp_register_script('single-scripts', get_template_directory_uri() . '/js/single.bundle.js',
      array('conditionizr', 'modernizr', 'jquery'), '1.0.0', true);
    // pass in directory uri for trailer drawer images
    $variable_array = array('directoryURI' => get_template_directory_uri());
    wp_localize_script('single-scripts', 'wordpressData', $variable_array);

    wp_enqueue_script('single-scripts');
  }
}

// Load IFC_Films styles
function ifcfilms_styles() {
  if (HTML5_DEBUG) {
    // normalize-css
    wp_register_style('normalize', get_template_directory_uri() . '/bower_components/foundation/css/normalize.css', array(), '3.0.2');

    // foundation-css
    wp_register_style('foundation', get_template_directory_uri() . '/bower_components/foundation/css/foundation.css', array('normalize'), '5.5.1');

    // foundation-css
    wp_register_style('rangeslider', get_template_directory_uri() . '/bower_components/rangeslider.js/dist/rangeslider.css', array('normalize'), '5.5.1');

    // foundation-css
    wp_register_style('flexslider', get_template_directory_uri() . '/bower_components/FlexSlider/flexslider.css', array('normalize'), '5.5.1');

    // Custom CSS
    wp_register_style('ifcfilms', get_template_directory_uri() . '/style.css', array(), '1.0');
    wp_register_style('home-styles', get_template_directory_uri() . '/css/home.css', array('normalize', 'foundation', 'rangeslider', 'flexslider'), '1.0');
    wp_register_style('single-styles', get_template_directory_uri() . '/css/single.css', array('normalize', 'foundation', 'rangeslider', 'flexslider'), '1.0');

    // Register CSS
    wp_enqueue_style('ifcfilms');

    if(is_page_template('template_home.php')) {
      wp_enqueue_style('home-styles');
    } else if(is_singular('film')) {
      wp_enqueue_style('single-styles');
    } else {
      wp_enqueue_style('single-styles');
    }

  } else {
    // Custom CSS
    wp_register_style('ifcfilmscssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
    // Register CSS
    wp_enqueue_style('ifcfilmscssmin');
  }
}

// Load IFC_Films conditional styles
function ifcfilms_conditional_styles() {
  // if (is_page('pagenamehere')) {

  // }
}

// Remove 'text/css' from our enqueued stylesheet
function ifcfilms_style_remove($tag) {
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
