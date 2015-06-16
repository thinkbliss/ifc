<?php
/*
Template Name: Now Playing
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
          <h1 class="left"><?php _e('Now Playing', 'ifcfilms'); ?></h1>
          <span class="left">Currently available from IFC Films</span>
        </div>

        <div class="single-row row">
          <div class="medium-12">
            <?php if (have_posts()) : the_post(); ?>
              <?php
              //$date = date('Ymd');
              $now_playing = get_field('now_playing_films');
              $items = array();

              if ($now_playing):
                foreach ($now_playing as $now_playing_post) :

                  $acf_fields = get_fields($now_playing_post->ID);

                  foreach ($acf_fields as $key=>$value) :
                    if ($key) $now_playing_post->{$key} = $value;
                  endforeach;

                  $items[] = $now_playing_post;
                endforeach;

//              $args=array(
//                'post_type' => 'film',
//                'post_status' => 'publish',
//                'posts_per_page' => -1,
//                'numberposts'	=> -1,
//                'orderby' => 'meta_value',
//                'order' => 'ASC',
//                'meta_query' => array(
//                  'relation' => 'AND',
//                  array(
//                    'key' => 'release_start_date',
//                    'value' => $date,
//                    'compare' => '<='
//                  )
//                )
//              );

              //$query = new WP_Query($args);

              //if($query->have_posts()) : ?>
                <!-- sort into separate months here -->
                <?php //while ( $query->have_posts() ) : $query->the_post(); ?>
                <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                <?php foreach ($items as $key=>$item) : ?>
                  <li class="small-6 medium-4 large-3 columns">
                    <a href="<?php the_permalink($item->ID); ?>">
                      <img src="<?php echo $item->film_poster; ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                      <h3 class='text-smaller bold'><?php echo $item->post_title; ?></h3>
                      <p><?php echo $item->excerpt; ?></p>
                      <?php if($item->release_text_info) : ?><h4><?php echo $item->release_text_info; ?></h4><?php endif; ?>
                      <div class='button-container'>
                        <a class='learn button trailer-color' href='<?php echo get_the_permalink($item->ID); ?>'>See More</a>
                        <?php if($item->gowatchit_id) : ?>
                          <div class='watch button gwi-widget' data-id='<?php echo $item->gowatchit_id; ?>' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch Now</div>
                        <?php endif; ?>
                      </div>" alt="<?php echo $item->post_title; ?>"/>
                      <h3><?php echo $item->post_title; ?></h3>
                    </a>
                  </li>
                <?php //endwhile; ?>
                <?php endforeach; ?>
                </ul>
              <?php else : ?>
                <p>No Films Now Playing</p>
              <?php endif; ?>

            <?php endif; ?>

            <?php //get_template_part('pagination'); ?>

            <?php //wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
