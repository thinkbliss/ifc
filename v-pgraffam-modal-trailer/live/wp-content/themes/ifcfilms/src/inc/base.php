<?php

// Remove Actions and Filters
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Add Actions and Filters
add_action('init', 'ifcfilms_wp_pagination'); // Add HTML5 Pagination
//add_action('init', 'add_countries', 100); // generate countries in category

add_filter('avatar_defaults', 'ifcfilmsgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images



function add_countries()
{
  $country_array = array(
    'AF'=>'AFGHANISTAN',
    'AL'=>'ALBANIA',
    'DZ'=>'ALGERIA',
    'AS'=>'AMERICAN SAMOA',
    'AD'=>'ANDORRA',
    'AO'=>'ANGOLA',
    'AI'=>'ANGUILLA',
    'AQ'=>'ANTARCTICA',
    'AG'=>'ANTIGUA AND BARBUDA',
    'AR'=>'ARGENTINA',
    'AM'=>'ARMENIA',
    'AW'=>'ARUBA',
    'AU'=>'AUSTRALIA',
    'AT'=>'AUSTRIA',
    'AZ'=>'AZERBAIJAN',
    'BS'=>'BAHAMAS',
    'BH'=>'BAHRAIN',
    'BD'=>'BANGLADESH',
    'BB'=>'BARBADOS',
    'BY'=>'BELARUS',
    'BE'=>'BELGIUM',
    'BZ'=>'BELIZE',
    'BJ'=>'BENIN',
    'BM'=>'BERMUDA',
    'BT'=>'BHUTAN',
    'BO'=>'BOLIVIA',
    'BA'=>'BOSNIA AND HERZEGOVINA',
    'BW'=>'BOTSWANA',
    'BV'=>'BOUVET ISLAND',
    'BR'=>'BRAZIL',
    'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
    'BN'=>'BRUNEI DARUSSALAM',
    'BG'=>'BULGARIA',
    'BF'=>'BURKINA FASO',
    'BI'=>'BURUNDI',
    'KH'=>'CAMBODIA',
    'CM'=>'CAMEROON',
    'CA'=>'CANADA',
    'CV'=>'CAPE VERDE',
    'KY'=>'CAYMAN ISLANDS',
    'CF'=>'CENTRAL AFRICAN REPUBLIC',
    'TD'=>'CHAD',
    'CL'=>'CHILE',
    'CN'=>'CHINA',
    'CX'=>'CHRISTMAS ISLAND',
    'CC'=>'COCOS (KEELING) ISLANDS',
    'CO'=>'COLOMBIA',
    'KM'=>'COMOROS',
    'CG'=>'CONGO',
    'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
    'CK'=>'COOK ISLANDS',
    'CR'=>'COSTA RICA',
    'CI'=>'COTE D IVOIRE',
    'HR'=>'CROATIA',
    'CU'=>'CUBA',
    'CY'=>'CYPRUS',
    'CZ'=>'CZECH REPUBLIC',
    'DK'=>'DENMARK',
    'DJ'=>'DJIBOUTI',
    'DM'=>'DOMINICA',
    'DO'=>'DOMINICAN REPUBLIC',
    'TP'=>'EAST TIMOR',
    'EC'=>'ECUADOR',
    'EG'=>'EGYPT',
    'SV'=>'EL SALVADOR',
    'GQ'=>'EQUATORIAL GUINEA',
    'ER'=>'ERITREA',
    'EE'=>'ESTONIA',
    'ET'=>'ETHIOPIA',
    'FK'=>'FALKLAND ISLANDS (MALVINAS)',
    'FO'=>'FAROE ISLANDS',
    'FJ'=>'FIJI',
    'FI'=>'FINLAND',
    'FR'=>'FRANCE',
    'GF'=>'FRENCH GUIANA',
    'PF'=>'FRENCH POLYNESIA',
    'TF'=>'FRENCH SOUTHERN TERRITORIES',
    'GA'=>'GABON',
    'GM'=>'GAMBIA',
    'GE'=>'GEORGIA',
    'DE'=>'GERMANY',
    'GH'=>'GHANA',
    'GI'=>'GIBRALTAR',
    'GR'=>'GREECE',
    'GL'=>'GREENLAND',
    'GD'=>'GRENADA',
    'GP'=>'GUADELOUPE',
    'GU'=>'GUAM',
    'GT'=>'GUATEMALA',
    'GN'=>'GUINEA',
    'GW'=>'GUINEA-BISSAU',
    'GY'=>'GUYANA',
    'HT'=>'HAITI',
    'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
    'VA'=>'HOLY SEE (VATICAN CITY STATE)',
    'HN'=>'HONDURAS',
    'HK'=>'HONG KONG',
    'HU'=>'HUNGARY',
    'IS'=>'ICELAND',
    'IN'=>'INDIA',
    'ID'=>'INDONESIA',
    'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
    'IQ'=>'IRAQ',
    'IE'=>'IRELAND',
    'IL'=>'ISRAEL',
    'IT'=>'ITALY',
    'JM'=>'JAMAICA',
    'JP'=>'JAPAN',
    'JO'=>'JORDAN',
    'KZ'=>'KAZAKSTAN',
    'KE'=>'KENYA',
    'KI'=>'KIRIBATI',
    'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
    'KR'=>'KOREA REPUBLIC OF',
    'KW'=>'KUWAIT',
    'KG'=>'KYRGYZSTAN',
    'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
    'LV'=>'LATVIA',
    'LB'=>'LEBANON',
    'LS'=>'LESOTHO',
    'LR'=>'LIBERIA',
    'LY'=>'LIBYAN ARAB JAMAHIRIYA',
    'LI'=>'LIECHTENSTEIN',
    'LT'=>'LITHUANIA',
    'LU'=>'LUXEMBOURG',
    'MO'=>'MACAU',
    'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
    'MG'=>'MADAGASCAR',
    'MW'=>'MALAWI',
    'MY'=>'MALAYSIA',
    'MV'=>'MALDIVES',
    'ML'=>'MALI',
    'MT'=>'MALTA',
    'MH'=>'MARSHALL ISLANDS',
    'MQ'=>'MARTINIQUE',
    'MR'=>'MAURITANIA',
    'MU'=>'MAURITIUS',
    'YT'=>'MAYOTTE',
    'MX'=>'MEXICO',
    'FM'=>'MICRONESIA, FEDERATED STATES OF',
    'MD'=>'MOLDOVA, REPUBLIC OF',
    'MC'=>'MONACO',
    'MN'=>'MONGOLIA',
    'MS'=>'MONTSERRAT',
    'MA'=>'MOROCCO',
    'MZ'=>'MOZAMBIQUE',
    'MM'=>'MYANMAR',
    'NA'=>'NAMIBIA',
    'NR'=>'NAURU',
    'NP'=>'NEPAL',
    'NL'=>'NETHERLANDS',
    'AN'=>'NETHERLANDS ANTILLES',
    'NC'=>'NEW CALEDONIA',
    'NZ'=>'NEW ZEALAND',
    'NI'=>'NICARAGUA',
    'NE'=>'NIGER',
    'NG'=>'NIGERIA',
    'NU'=>'NIUE',
    'NF'=>'NORFOLK ISLAND',
    'MP'=>'NORTHERN MARIANA ISLANDS',
    'NO'=>'NORWAY',
    'OM'=>'OMAN',
    'PK'=>'PAKISTAN',
    'PW'=>'PALAU',
    'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
    'PA'=>'PANAMA',
    'PG'=>'PAPUA NEW GUINEA',
    'PY'=>'PARAGUAY',
    'PE'=>'PERU',
    'PH'=>'PHILIPPINES',
    'PN'=>'PITCAIRN',
    'PL'=>'POLAND',
    'PT'=>'PORTUGAL',
    'PR'=>'PUERTO RICO',
    'QA'=>'QATAR',
    'RE'=>'REUNION',
    'RO'=>'ROMANIA',
    'RU'=>'RUSSIAN FEDERATION',
    'RW'=>'RWANDA',
    'SH'=>'SAINT HELENA',
    'KN'=>'SAINT KITTS AND NEVIS',
    'LC'=>'SAINT LUCIA',
    'PM'=>'SAINT PIERRE AND MIQUELON',
    'VC'=>'SAINT VINCENT AND THE GRENADINES',
    'WS'=>'SAMOA',
    'SM'=>'SAN MARINO',
    'ST'=>'SAO TOME AND PRINCIPE',
    'SA'=>'SAUDI ARABIA',
    'SN'=>'SENEGAL',
    'SC'=>'SEYCHELLES',
    'SL'=>'SIERRA LEONE',
    'SG'=>'SINGAPORE',
    'SK'=>'SLOVAKIA',
    'SI'=>'SLOVENIA',
    'SB'=>'SOLOMON ISLANDS',
    'SO'=>'SOMALIA',
    'ZA'=>'SOUTH AFRICA',
    'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
    'ES'=>'SPAIN',
    'LK'=>'SRI LANKA',
    'SD'=>'SUDAN',
    'SR'=>'SURINAME',
    'SJ'=>'SVALBARD AND JAN MAYEN',
    'SZ'=>'SWAZILAND',
    'SE'=>'SWEDEN',
    'CH'=>'SWITZERLAND',
    'SY'=>'SYRIAN ARAB REPUBLIC',
    'TW'=>'TAIWAN, PROVINCE OF CHINA',
    'TJ'=>'TAJIKISTAN',
    'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
    'TH'=>'THAILAND',
    'TG'=>'TOGO',
    'TK'=>'TOKELAU',
    'TO'=>'TONGA',
    'TT'=>'TRINIDAD AND TOBAGO',
    'TN'=>'TUNISIA',
    'TR'=>'TURKEY',
    'TM'=>'TURKMENISTAN',
    'TC'=>'TURKS AND CAICOS ISLANDS',
    'TV'=>'TUVALU',
    'UG'=>'UGANDA',
    'UA'=>'UKRAINE',
    'AE'=>'UNITED ARAB EMIRATES',
    'GB'=>'UNITED KINGDOM',
    'US'=>'UNITED STATES',
    'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
    'UY'=>'URUGUAY',
    'UZ'=>'UZBEKISTAN',
    'VU'=>'VANUATU',
    'VE'=>'VENEZUELA',
    'VN'=>'VIET NAM',
    'VG'=>'VIRGIN ISLANDS, BRITISH',
    'VI'=>'VIRGIN ISLANDS, U.S.',
    'WF'=>'WALLIS AND FUTUNA',
    'EH'=>'WESTERN SAHARA',
    'YE'=>'YEMEN',
    'YU'=>'YUGOSLAVIA',
    'ZM'=>'ZAMBIA',
    'ZW'=>'ZIMBABWE',
  );

  // Loop through array and insert terms
  foreach($country_array as $abbr => $name)
  {
    if(!get_term_by('name', ucwords(strtolower($name)), 'country'))
      wp_insert_term(ucwords(strtolower($name)), 'country');
  }
}

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
    if($post_type)
      $post_type = $post_type;
    else
      $post_type = array('nav_menu_item','post','film'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
    return $query;
  }
}

function add_query_vars_filter( $vars ){
  $vars[] = "filter";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

if (!isset($content_width)) {
  $content_width = 900;
}

if (function_exists('add_theme_support')) {
  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true); // Large Thumbnail
  add_image_size('medium', 250, '', true); // Medium Thumbnail
  add_image_size('small', 120, '', true); // Small Thumbnail
  add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  // Localisation Support
  load_theme_textdomain('ifcfilms', get_template_directory() . '/languages');
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links
function ifcfilms_wp_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}

// Remove Admin bar
function remove_admin_bar() {
  return false;
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  return $classes;
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Custom Gravatar in Settings > Discussion
function ifcfilmsgravatar ($avatar_defaults) {
  $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
  $avatar_defaults[$myavatar] = "Custom Gravatar";
  return $avatar_defaults;
}

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 * Modified to also accept category slug or array of slugs.
 *
 * @param int|string|array $cats The target categories. Integer ID, slug string or array of integer IDs or slug strings
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @uses get_term_by() Passes $cats if they are strings
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
  function post_is_in_descendant_category( $cats, $_post = null ) {
    foreach ( (array) $cats as $cat ) {
      // get_term_children() accepts integer ID only
      if ( is_string( $cat ) ) {
        $cat = get_term_by( 'slug', $cat, 'category' );
        if ( ! isset( $cat, $cat->term_id ) )
          continue;
        $cat = $cat->term_id;
      }
      $descendants = get_term_children( (int) $cat, 'category' );
      if ( $descendants && in_category( $descendants, $_post ) )
        return true;
    }
    return false;
  }
}