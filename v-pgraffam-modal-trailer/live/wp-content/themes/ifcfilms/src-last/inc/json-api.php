<?php

// setup API controllers and locations
add_filter('json_api_controllers', function($controllers) {
  $controllers[] = 'featured';
  return $controllers;
});

add_filter('json_api_featured_controller_path', function() {
  return get_template_directory() . '/api/featured.php';
});

// adds all ACF fields to JSON API response for posts
add_filter('json_api_encode', 'json_api_encode_acf');

function json_api_encode_acf($response) {
  if (isset($response['posts'])) {
    foreach ($response['posts'] as $post) {
      json_api_add_acf($post);
    }
  }
  else if (isset($response['post'])) {
    json_api_add_acf($response['post']);
  }

  return $response;
}

function json_api_add_acf(&$post) {
  $fields = get_fields($post->ID);

  foreach ($fields as $k=>$v) {
    if (!empty($k)) {
      $post->{$k} = $v;
    }
  }
}
