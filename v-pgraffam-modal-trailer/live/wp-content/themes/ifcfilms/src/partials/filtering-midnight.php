<?php
// setup genre query
$main_genre_term = get_term_by('slug', 'midnight', 'category');

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
$catTitle = strtolower(single_cat_title('', false));
?>

  <!-- filter by options -->
  <ul class="filtering-list inline-list text-uppercase border-bottom">
    <li <?php if ($catTitle == 'midnight') {?>class="current-cat"<?php } ?>><a href="/category/midnight">All | </a></li>
    <?php wp_list_categories($genre_args); ?>
  </ul>