<?php
// setup genre query
$main_genre_term = get_term_by('slug', 'ifc-films', 'category');

$genre_args = array(
  'orderby'            => 'name',
  'order'              => 'ASC',
  'style'              => 'list',
  'show_count'         => 0,
  'hide_empty'         => 1, // change this later to hide empty genres
  'use_desc_for_title' => 0,
  'child_of'           => $main_genre_term->term_id,
  'title_li'           => null,
  'number'             => null,
  'taxonomy'           => 'category',
);

// setup country query
$country_args = array(
  'orderby'            => 'name',
  'order'              => 'ASC',
  'style'              => 'list',
  'show_count'         => 0,
  'hide_empty'         => 1, // change this later to hide empty countries
  'use_desc_for_title' => 0,
  'title_li'           => null,
  'number'             => null,
  'taxonomy'           => 'country',
);

?>

<!-- filter by options -->
<div class="catFilters">
  <h3>Filter By</h3>
  <ul class="accordion" data-accordion>
    <li><a href="/films">All IFC Films</a></li>
    <li><a href="/films?filter=now-playing">Now Playing</a></li>
    <li><a href="/films?filter=coming-soon">Coming Soon</a></li>
    <li>
      <a href="#" class="filterToggle">Genre</a>
      <ul class="genreFilter"><?php wp_list_categories($genre_args); ?></ul>
    </li>
    <li>
      <a class="filterToggle" href="#">Country</a>
      <ul class="countryFilter"><?php wp_list_categories($country_args); ?></ul>
    </li>
  </ul>
</div>
