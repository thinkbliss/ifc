<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

  <link href="//www.google-analytics.com" rel="dns-prefetch">
  <link href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" rel="shortcut icon">
  <link href="<?php echo get_template_directory_uri(); ?>/images/icons/touch.png" rel="apple-touch-icon-precomposed">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <?php get_template_part('partials/social', 'tags'); ?>

  <?php wp_head(); ?>

  <!--[if lte IE 9]>
  <script src="animation-legacy-support.js"></script>
  <![endif]-->
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
  <![endif]-->

  <script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
      assets: '<?php echo get_template_directory_uri(); ?>',
      tests: {}
    });
  </script>

</head>
<body <?php body_class(); ?>>

<?php get_template_part('partials/header-nav'); ?>
