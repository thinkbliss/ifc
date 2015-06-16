<?php get_header('single'); ?>

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
          <h1 class="small-12 columns"><?php _e('All Films', 'ifcfilms'); ?></h1>
        </div>

        <div class="single-row row">
          <div class="medium-3 columns">
            <?php get_template_part('/partials/filtering', 'sidebar'); ?>
          </div>

          <div class="medium-9 columns">
            <?php
            $filter = get_query_var('filter');
            if ($filter) :
              $args = array();

              switch ($filter) :
                case 'coming-soon':
                  $date = date('Ymd');

                  $args = array(
                    'post_type' => 'film',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
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

                  break;

                case 'now-playing':
                  $date = date('Ymd');

                  $args = array(
                    'post_type' => 'film',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_query' => array(
                      array(
                        'key' => 'release_start_date',
                        'value' => $date,
                        'compare' => '<='
                      )
                    )
                  );

                  break;
                default:
                  //echo '<p>Unrecognized filter</p>';
                  break;
              endswitch;

              $query = new WP_Query($args);

              if($query->have_posts()) : ?>
              <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">

                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <li class="small-6 medium-4 large-3 columns">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php the_field('film_poster'); ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
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

              <?php endwhile; wp_reset_query(); ?>

              </ul>

              <?php //get_template_part('pagination');

              else :
                echo '<p>No Posts found</p>';
              endif;
            else :

            if (have_posts()): ?>

            <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">

            <?php while (have_posts()) : the_post(); ?>

              <li class="small-6 medium-4 large-3 columns">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('film_poster') ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
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

            <?php endwhile; ?>

            </ul>

            <?php get_template_part('pagination'); ?>

            <?php endif; ?>
          <?php endif; ?>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
  

