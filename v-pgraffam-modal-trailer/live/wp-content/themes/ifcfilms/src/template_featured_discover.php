<?php
/*
Template Name: Featured Discover
*/

get_header('single'); ?>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <a class="enter-on-canvas hide-for-small" href="#"></a>

    <?php get_template_part('partials/trailer', 'drawer'); ?>

    <section class="single-page generic">
      <div class="header-container row">
        <?php get_template_part('partials/header-nav'); ?>
      </div>
      <!-- end header container -->

      <?php get_template_part('partials/share', 'fixed'); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="single-row row border-bottom">
          <h1 class="left"><?php _e('Discover', 'ifcfilms'); ?></h1>
          <span class="left">Featured collections compiled by IFC Films</span>
          <div class="clearfix"></div>
        </div>

        <div class="single-row row">

          <div class="medium-12">

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

              <?php
              $featured_discover = get_field('featured_discover_groups_list');
              $items = array();

              if ($featured_discover):
                foreach ($featured_discover as $featured_discover_post) :

                  $acf_fields = get_fields($featured_discover_post->ID);

                  foreach ($acf_fields as $key=>$value) :
                    if ($key) $featured_discover_post->{$key} = $value;
                  endforeach;

                  $items[] = $featured_discover_post;
                endforeach;
              ?>

              <ul>
                <?php foreach ($items as $key=>$item) : ?>
                  <li class="small-12 columns">
                    <h3><?php echo $item->post_title; ?></h3>
                    <a href="<?php echo get_the_permalink($item->ID); ?>" class="left">
                      <img src="<?php echo $item->discover_large_image; ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                      <h3 class='text-smaller bold'><?php echo $item->post_title; ?></h3>
                      <p><?php echo $item->discover_group_excerpt; ?></p>
                      <div class='button-container'>
                        <a class='learn button trailer-color' href='<?php echo get_the_permalink($item->ID); ?>'>See Collection</a>
                      </div>" alt="<?php echo $item->post_title; ?>"/>
                    </a>
                    <p><?php echo $item->post_content; ?></p>
                    <a class='learn button trailer-color' href='<?php echo get_the_permalink($item->ID); ?>'>See Collection</a>
                  </li>
                <?php endforeach; ?>
              </ul>

            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>

            <a href="/discover" class="text-uppercase">View all collections <span class="right-arrow-icon"></span></a>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
