<?php

add_action('init', 'create_post_type_film'); // Add Custom Post Type for Film Posts
add_action('init', 'create_post_type_discover'); // Add Custom Post Type for Discover lists

function create_post_type_film() {
  register_post_type('film', array(
    'labels' => array(
      'name' => __('Films', 'ifcfilms'), // Rename these to suit
      'singular_name' => __('Film', 'ifcfilms'),
      'add_new' => __('Add Film', 'ifcfilms'),
      'add_new_item' => __('Add New Film', 'ifcfilms'),
      'edit' => __('Edit', 'ifcfilms'),
      'edit_item' => __('Edit Film', 'ifcfilms'),
      'new_item' => __('New Film', 'ifcfilms'),
      'view' => __('View Film', 'ifcfilms'),
      'view_item' => __('View Film', 'ifcfilms'),
      'search_items' => __('Search Films', 'ifcfilms'),
      'not_found' => __('No Films found', 'ifcfilms'),
      'not_found_in_trash' => __('No Films found in Trash', 'ifcfilms'),
    ),
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-tickets-alt',
    'public' => true,
    'hierarchical' => false,
    'has_archive' => true,
    'rewrite' => array(
      'slug'=>'films',
      'with_front'=> false,
      'feed'=> true,
      'pages'=> true,
    ),
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
    ),
    'can_export' => true, // Allows export in Tools > Export
    'taxonomies' => array(
      'category',
    ),
  ));

  register_taxonomy_for_object_type('category', 'film');
}

function create_post_type_discover() {
  register_post_type('discover', array(
    'labels' => array(
      'name' => __('Discover', 'ifcfilms'),
      'singular_name' => __('Discover Group', 'ifcfilms'),
      'add_new' => __('Add Discover Group', 'ifcfilms'),
      'add_new_item' => __('Add New Discover Group', 'ifcfilms'),
      'edit' => __('Edit', 'ifcfilms'),
      'edit_item' => __('Edit Discover Group', 'ifcfilms'),
      'new_item' => __('New Discover Group', 'ifcfilms'),
      'view' => __('View Discover Group', 'ifcfilms'),
      'view_item' => __('View Discover Group', 'ifcfilms'),
      'search_items' => __('Search Discover Groups', 'ifcfilms'),
      'not_found' => __('No Discover Groups found', 'ifcfilms'),
      'not_found_in_trash' => __('No Discover Groups found in Trash', 'ifcfilms'),
    ),
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-visibility',
    'public' => true,
    'hierarchical' => false,
    'has_archive' => true,
    'rewrite' => array(
      'slug'=>'discover',
      'with_front'=> true,
      'feed'=> true,
      'pages'=> true,
    ),
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
    ),
    'can_export' => true, // Allows export in Tools > Export
  ));
}
