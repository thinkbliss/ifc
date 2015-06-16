<?php

add_action('admin_menu', 'remove_admin_menu_items'); // Remove items from Admin Sidebar menu
add_filter('custom_menu_order', '__return_true'); // Set custom_menu_order tp true
add_filter('menu_order', 'custom_admin_menu_order'); // Set custom menu order
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive'); // Adds Custom Post Type Archives to Menu options
add_action('admin_head', 'admin_custom_css'); // All CSS customization to Admin area
add_action('user_register', 'set_default_admin_color'); // Set default admin color scheme

// hide unnecessary admin menus
function remove_admin_menu_items() {
  // always remove these items
  $remove_menu_items = array(
    __('Dashboard'),
    __('Posts'),
    __('Links'),
    __('Comments'),
  );

  // remove admin panels for non-admins
  $remove_if_not_administrator = array(
    __('Appearance'),
    __('Plugins'),
    __('Users'),
    __('Tools'),
    __('Settings'),
  );

  // Get current user's data
  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;
  $user = new WP_User($user_id);
  $is_admin = 0;

  if (!empty($user->roles) && is_array($user->roles)) {
    $is_admin = in_array('administrator', $user->roles);
  }

  global $menu;
  end ($menu);

  while (prev($menu)) {
    $item_array = explode(' ', $menu[key($menu)][0]);
    $item = $item_array[0] != NULL ? $item_array[0] : "";

    if (in_array($item, $remove_menu_items)) {
      unset($menu[key($menu)]);
    }

    if (!$is_admin && in_array($item, $remove_if_not_administrator)) {
      unset($menu[key($menu)]);
    }
  }
}

// reorder admin menu
function custom_admin_menu_order($menu_ord) {
  if (!$menu_ord) return true;
   
  return array(
    'edit.php?post_type=film', // Film Post Type
    'edit.php?post_type=discover', // Discover Post Type
    'separator1', // separator
    'edit.php?post_type=page', // Pages
    'separator2', // separator
    'upload.php', // Media
    'separator-last', // Second separator
    'plugins.php', // Plugins
    'users.php', // Users
    'themes.php', // Appearance
    'tools.php', // Tools
    'options-general.php', // Settings
  );
}

// add custom post type archive pages to menu options
function wpclean_add_metabox_menu_posttype_archive() {
  add_meta_box(
    'wpclean-metabox-nav-menu-posttype',
    'Custom Post Archives',
    'wpclean_metabox_menu_posttype_archive',
    'nav-menus',
    'side',
    'default'
  );
}

function wpclean_metabox_menu_posttype_archive() {
  $post_types = get_post_types(
    array(
      'show_in_nav_menus' => true,
      'has_archive' => true,
    ),
    'object'
  );

  if ($post_types):
    $items = array();
    $loop_index = 999999;

    foreach ($post_types as $post_type) {
      $item = new stdClass();
      $loop_index++;

      $item->object_id = $loop_index;
      $item->db_id = 0;
      $item->object = 'post_type_' . $post_type->query_var;
      $item->menu_item_parent = 0;
      $item->type = 'custom';
      $item->title = $post_type->labels->name;
      $item->url = get_post_type_archive_link($post_type->query_var);
      $item->target = '';
      $item->attr_title = '';
      $item->classes = array();
      $item->xfn = '';

      $items[] = $item;
    }

    $walker = new Walker_Nav_Menu_Checklist(array());

    echo '<div id="posttype-archive" class="posttypediv">';
    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
    echo '</ul>';
    echo '</div>';
    echo '</div>';

    echo '<p class="button-controls">';
    echo '<span class="add-to-menu">';
    echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
    echo '<span class="spinner"></span>';
    echo '</span>';
    echo '</p>';

  endif;
}

// all custom css for admin theme
function admin_custom_css() { ?>
  <style>
  /* Custom Admin logo */
  /*#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
    width: auto;
    background-image: url(<?php echo get_template_directory_uri() ?>/img/ifcf-logo.png);
  }
  #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
    content: '';
  }*/
  /* Films icon */
  /*.dashicons-admin-post:before {
    content: "\f524";
  }*/
  /* Media icon */
  .dashicons-admin-media:before {
    content: "\f161";
  }
  /* Custom Fields icon */
  #toplevel_page_edit-post_type-acf .dashicons-admin-generic:before {
    content: "\f116";
  }
  #acf-field-rating, #acf-release_date, #acf-feature_length {
    width: 120px;
  }
  #acf-bc_trailer_id, #acf-gowatchit_id {
    width: 300px;
  }
  </style>
<?php }

// sets admin theme default color scheme
function set_default_admin_color($user_id) {
  $args = array(
    'ID' => $user_id,
    'admin_color' => 'midnight'
  );
  
  wp_update_user($args);
}

// Uncomment to remove non-admin ability to change color scheme
if (!current_user_can('manage_options')) {
  // remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
}
