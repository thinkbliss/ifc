<?php
/*
Template Name: Coming Soon
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
          <h1 class="left"><?php _e('Coming Soon', 'ifcfilms'); ?></h1>
          <span class="left">Upcoming releases from IFC Films</span>
        </div>

        <div class="single-row row">
          <?php if (have_posts()) : the_post(); ?>
          <?php
          $date = date('Ymd');
          $args = array(
            'post_type' => 'film',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'numberposts'	=> -1,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'release_start_date',
                'value' => $date,
                'compare' => '>='
              )
            )
          );

          $query = new WP_Query($args);

          if($query->have_posts()) :
          $current_month = '';
          $post_month = '';
          ?>
          <div class="medium-3 columns">
            <ul>
              <?php
              while ( $query->have_posts() ) : $query->the_post();

              $date = get_field('release_start_date');
              $date_time = DateTime::createFromFormat("Ymd", $date);

              if (is_object($date_time)) {
                $post_month = $date_time->format('F');
              }
              if ($post_month != $current_month) :
                $current_month = $post_month; ?>
              <li><a href="?filter=<?php echo $post_month; ?>"><?php echo $post_month; ?></a></li>
              <? endif;
              endwhile; ?>
              <li><a href="?filter=acquisitions">Acquisitions</a></li>
            </ul>
          </div>

          <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

          <?php $filter = get_query_var('filter');

          if ($filter) {
            if ($filter == 'acquisitions') {
              $args = array(
                'post_type' => 'film',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'numberposts' => -1,
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                  'relation' => 'and',
                  array(
                    'key' => 'release_start_date',
                    'value' => array(''),
                    'compare' => 'IN'
                  ),
                  array(
                    'key' => 'recent_acquisition',
                    'value' => true,
                    'compare' => '='
                  )
                )
              );
            } else {
              $filter_month = date("m", strtotime($filter));
              $date = date('Ymd');

              $args = array(
                'post_type' => 'film',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'numberposts' => -1,
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                  'relation' => 'and',
                  array(
                    'key' => 'release_start_date',
                    'value' => '[0-9]{4}' . $filter_month . '[0-9]{2}',
                    'compare' => 'REGEXP'
                  ),
                  array(
                    'key' => 'release_start_date',
                    'value' => $date,
                    'compare' => '>='
                  )
                )
              );
            }

          } else {
            $date = date('Ymd');

            $args = array(
              'post_type' => 'film',
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'numberposts'	=> -1,
              'orderby' => 'meta_value',
              'order' => 'ASC',
              'meta_query' => array(
                array(
                  'key' => 'release_start_date',
                  'value' => $date,
                  'compare' => '>='
                )
              )
            );
          }

          $query = new WP_Query($args);
          ?>

          <div class="medium-9 columns">

            <!-- sort into separate months here -->
            <?php
            $current_month = '';
            $post_month = '';
            $post_day = '';

            if ($query->have_posts()) :

            while ( $query->have_posts() ) : $query->the_post(); ?>

            <?php $date = get_field('release_start_date');
            $date_time = DateTime::createFromFormat("Ymd", $date);

            if (is_object($date_time)) {
              $post_month = $date_time->format('F');
              $post_day = $date_time->format('d');
            }

            if ($post_month != $current_month) :
              $current_month = $post_month;
            ?>
            </ul>
            <ul class="row border-bottom">
              <li class="medium-4 columns">
                <h2><?php echo $post_month . " " . $post_day; ?></h2>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('film_thumb'); ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                  <h3 class='text-smaller bold'><?php the_title(); ?></h3>
                  <p><?php the_field('excerpt'); ?></p>
                  <?php if(get_field('release_text_info')) : ?><h4><?php the_field('release_text_info'); ?></h4><?php endif; ?>
                  <div class='button-container'>
                    <a class='learn button trailer-color' href='<?php the_permalink(); ?>'>See More</a>
                    <?php if(get_field('gowatchit_id')) : ?>
                      <div class='watch button gwi-widget' data-id='<?php the_field('gowatchit_id'); ?>' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch Now</div>
                    <?php endif; ?>
                  </div>" alt="<?php the_title(); ?>"/>
                  <h3><?php the_title(); ?></h3>
                </a>
              </li>

            <?php else : ?>

              <li class="medium-4 columns">
                <h2><?php echo $post_day; ?></h2>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('film_thumb'); ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                    <h3 class='text-smaller bold'><?php the_title(); ?></h3>
                    <p><?php the_field('excerpt'); ?></p>
                    <?php if(get_field('release_text_info')) : ?><h4><?php the_field('release_text_info'); ?></h4><?php endif; ?>
                    <div class='button-container'>
                      <a class='learn button trailer-color' href='<?php the_permalink(); ?>'>See More</a>
                      <?php if(get_field('gowatchit_id')) : ?>
                        <div class='watch button gwi-widget' data-id='<?php the_field('gowatchit_id'); ?>' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch Now</div>
                      <?php endif; ?>
                    </div>" alt="<?php the_title(); ?>"/>
                  <h3><?php the_title(); ?></h3>
                </a>
              </li>

            <?php endif; ?>

            <?php
            //$formatted_date = date('M jS, Y', strtotime(get_field('release_start_date'))); ?>
            <?php endwhile; endif;
            ?>

            <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

            <?php
            if (!$filter) :
            $args = array(
              'post_type' => 'film',
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'numberposts' => -1,
              'orderby' => 'meta_value',
              'order' => 'ASC',
              'meta_query' => array(
                'relation' => 'and',
                array(
                  'key' => 'release_start_date',
                  'value' => array(''),
                  'compare' => 'IN'
                ),
                array(
                  'key' => 'recent_acquisition',
                  'value' => true,
                  'compare' => '='
                )
              )
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
            ?>
            </ul>
            <ul class="row border-bottom">
              <h2 class="columns">Recent Acquisitions</h2>
            <?php
            while ( $query->have_posts() ) : $query->the_post(); ?>

              <li class="medium-4 columns">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('film_thumb'); ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                    <h3 class='text-smaller bold'><?php the_title(); ?></h3>
                    <p><?php the_field('excerpt'); ?></p>
                    <?php if(get_field('release_text_info')) : ?><h4><?php the_field('release_text_info'); ?></h4><?php endif; ?>
                    <div class='button-container'>
                      <a class='learn button trailer-color' href='<?php the_permalink(); ?>'>See More</a>
                      <?php if(get_field('gowatchit_id')) : ?>
                        <div class='watch button gwi-widget' data-id='<?php the_field('gowatchit_id'); ?>' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch Now</div>
                      <?php endif; ?>
                    </div>" alt="<?php the_title(); ?>"/>
                  <h3><?php the_title(); ?></h3>
                </a>
              </li>

            <?php endwhile; endif; endif;

            wp_reset_query();
            ?>
            </ul>

          <?php else : ?>
            <p>No Films Coming Soon</p>
          <?php endif; ?>

          <?php endif; ?>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
