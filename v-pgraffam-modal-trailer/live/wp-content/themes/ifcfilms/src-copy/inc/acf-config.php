<?php

add_filter('acf/settings/save_json', 'ifc_acf_json_save_point');
add_filter('acf/settings/load_json', 'ifc_acf_json_load_point');
add_filter('acf/settings/show_admin', 'ifc_acf_show_admin');

function ifc_acf_json_save_point($path) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
}

function ifc_acf_json_load_point($paths) {
    // remove original path
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    // return
    return $paths;
}

// hides ACF menu item. swap commented line to hide/show for admins
function ifc_acf_show_admin( $show ) {
    //return false;
    return current_user_can('manage_options');
}
