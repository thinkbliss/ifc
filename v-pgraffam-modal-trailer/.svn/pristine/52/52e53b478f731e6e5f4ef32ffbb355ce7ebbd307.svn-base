<?php
/*
Plugin Name: IFC Films API
Description: Adds an API endpoint at /api/films
Version: 0.1
Author: Big Spaceship
Author URL: http://ifcfilms.com
*/

class IFC_Films_API {
  
  /**
  * Hook WordPress
  * @return void
  */
  public function __construct() {
    add_filter('query_vars', array($this, 'add_query_vars'), 0);
    add_action('parse_request', array($this, 'sniff_requests'), 0);
    add_action('init', array($this, 'add_endpoint'), 0);
  } 
  
  /**
  * Add public query vars
  * @param array $vars List of current public query vars
  * @return array $vars 
  */
  public function add_query_vars($vars) {
    $vars[] = '__api';
    $vars[] = 'films';
    return $vars;
  }

  /**
  * Add API Endpoint
  * Add WP rewrite rule
  * @return void
  */
  public function add_endpoint() {
    add_rewrite_rule('^api/films/?(\w+)?/?','index.php?__api=1&films=$matches[1]','top');
  }

  /**
  * Sniff Requests
  * If $_GET['__api'] is set, we kill WP and serve API data
  * @return die if API request
  */
  public function sniff_requests() {
    global $wp;

    if(isset($wp->query_vars['__api'])){
      $this->handle_request();
      exit;
    }
  }
  
  /**
  * Get All Films
  * Gets post objects for all films
  * @return array post objects
  */
  private function get_all_films() {
    $all_films = array();
    $args = array (
      'post_type' => 'film',
    );

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
        $the_query->the_post();
        array_push($all_films, $the_query->post);
      }

      return $all_films;
    }
    
    wp_reset_postdata();
  }

  /** 
  * Get Featured Films (trailer drawer)
  * Gets post objects for all featured films
  * @return array post objects
  */
  private function get_featured_films() {
    $home_page_id = get_option('page_on_front');
    $featured = get_field('film_carousel', $home_page_id);

    return $featured;
  }

  /** 
  * Get Film By ID
  * Gets a single film object by its ID
  * @param int $id a post id
  * @return obj post object
  */
  private function get_film_by_id($id) {
    $args = array (
      'p'                      => $id,
      'post_type'              => 'film',
    );

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
      return $the_query->posts[0];
    }

    wp_reset_postdata();
  }

  /** 
  * Get ACF Data
  * Gets the ACF field data for an object or array of objects
  * and merges it into the original post object
  * @param obj|array $data a post object or array of objects
  * @return obj|array post object or array of post objects
  */
  private function get_acf_data($data) {
    if (is_object($data)) {
      $acf_data = get_fields($data->ID);

      return $this->merge_data($data, $acf_data);
    }
    else {
      $posts_arr = array();

      foreach ($data as $raw_post) {
        $acf_data = get_fields($raw_post->ID);
        $full_post = $this->merge_data($raw_post, $acf_data);
        array_push($posts_arr, $full_post);
      }

      return $posts_arr;
    }
    
  }

  /** 
  * Merge Post Data
  * Merges a single post object with its ACF data
  * @param obj $post_object single post object
  * @param array $acf_array ACF data array for this post
  * @return obj complete post object
  */
  private function merge_data($post_object, $acf_array) {
    foreach ($acf_array as $k=>$v) {
      if ($k) $post_object->{$k} = $v;
    }

    return $post_object;
  }

  /**
  * Handle Requests
  * query for data
  * @return void 
  */
  protected function handle_request() {
    global $wp;
    $film_query = $wp->query_vars['films'];
    
    if (!$film_query) { // send all films
      $raw_data = $this->get_all_films();
    }
    else if ($film_query == "featured") { // send featured films
      $raw_data = $this->get_featured_films();
    }
    else if (is_numeric($film_query)) { // send film of id
      $raw_data = $this->get_film_by_id($film_query);
    }
    else { // input error
      $this->send_response('Bad Input');
    }

    $all_data = $this->get_acf_data($raw_data);
    $this->send_response('200 OK', $all_data);
  }
  

  /** Response Handler
  * send a JSON response to the browser
  */
  protected function send_response($msg, $data = '') {
    $response['message'] = $msg;
    
    if ($data) {
      $response['data'] = $data;
    }
    header('content-type: application/json; charset=utf-8');
      echo json_encode($response)."\n";
      exit;
  }
}

new IFC_Films_API();
