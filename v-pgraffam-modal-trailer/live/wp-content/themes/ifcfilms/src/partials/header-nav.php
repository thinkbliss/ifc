<!-- header -->
<header class="header">
  <div class="top-bar-container">
    <div class="name hide-for-medium-up">
      <h1>
        <a href="<?php echo home_url(); ?>">
          <?php get_template_part( 'partials/svgs/ifc', 'logo' ); ?>
        </a>
      </h1>
    </div>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area trailer-color inline-list left">
        <li class="toggle-topbar mobile-menu-icon"><a href="#"><span></span></a></li>
        <li class="name hide-for-small">
          <h1>
            <a href="<?php echo home_url(); ?>">
              <?php get_template_part( 'partials/svgs/ifc', 'logo' ); ?>
            </a>
          </h1>
        </li>
      </ul>

      <ul class="right hide-for-medium-up">
        <li class="top-bar-mobile-search">
          <!-- search form -->
          <?php get_search_form(); ?>
          <!-- /search form -->
        </li>
      </ul>

      <section class="top-bar-section trailer-color">
        <div class="top-mobile-section">
          <!-- Left Nav Section -->
          <?php wp_nav_menu(array('theme_location' => 'main-nav')); ?>

          <!-- Right Nav Section -->
          <ul class="right">
            <li><a class="text-uppercase text-smaller" href="/films">All Films</a></li>
            <li class="show-for-medium-up">
              <!-- search form -->
              <?php get_search_form(); ?>
              <!-- /search form -->
            </li>
          </ul>
        </div>

        <div class="divider hide-for-medium-up small-12 columns"></div>

        <nav class="bottom-mobile-section hide-for-medium-up small-12">
          <ul class="small-10 columns">
            <?php wp_nav_menu(array('theme_location' => 'info-links-mobile')); ?>
            <li><a href="#">Newsletter</a></li>
          </ul>

          <ul class="text-center small-2 columns">
            <?php wp_nav_menu(array('theme_location' => 'social-links-mobile')); ?>
          </ul>
        </nav>

        <div class="divider hide-for-medium-up small-12 columns"></div>

        <div class="logo-lockup small-12 columns hide-for-medium-up">

          <div class="medium-6 footer-logos columns text-left">
          <?php $footerLogosMenu = wp_get_nav_menu_items( 'external-links', array(
            'theme_location' => 'external-links'
          ));

          //print_r($footerLogosMenu);
          foreach( $footerLogosMenu as $item ) { //print_r($item); ?>
            <a class="<?php echo implode(" ", $item->classes) ?>" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
              <?php
//              if (locate_template('partials/svgs/' . $item->classes[0] . '.php') != '') {
//                include 'partials/svgs/' . $item->classes[0] . '.php';
//              } else {
//                echo 'missing svg named the same as this menu items class';
//              }
              get_template_part('partials/svgs/' . $item->classes[0]);
              ?>
            </a>
          <?php } ?>
          </div>
        </div>
      </section>
    </nav>
  </div>
</header>
<!-- /header -->