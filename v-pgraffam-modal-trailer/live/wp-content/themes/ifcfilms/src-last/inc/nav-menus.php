<?php

add_action('init', 'nav_menus'); // Register nav menus
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)

// IFC_Films navigation
function ifcfilms_nav() {
  wp_nav_menu(array(
    'theme_location'  => 'header-menu',
    'menu'            => '',
    'container'       => 'div',
    'container_class' => 'menu-{menu slug}-container',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul>%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
  ));
}

// Register Main Nav
function nav_menus() {
  register_nav_menus(array( // Using array to specify more menus if needed
    'main-nav' => __('Header Menu', 'ifcfilms'), // Main Navigation
    'main-nav' => __('Main Nav'),
    'info-links' => __('Info Links'),
    'info-links-mobile' => __('Info Links Mobile'),
    'social-links' => __('Social Links'),
    'social-links-mobile' => __('Social Links Mobile'),
    'external-links' => __('External Links'),
    'external-links-mobile' => __('External Links Mobile'),
  ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
  $args['container'] = false;
  return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}
