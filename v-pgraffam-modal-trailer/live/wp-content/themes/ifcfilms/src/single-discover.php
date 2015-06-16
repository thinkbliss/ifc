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
          <h1 class="left"><?php the_title(); ?></h1>
          <span class="left">Featured collections compiled by IFC Films</span>
          <div class="clearfix"></div>
          <a href="/featured-discover"><span class="left-arrow-icon"></span>Return to featured collections</a>
        </div>

        <div class="single-row row">

          <div class="medium-12">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php
            $films = get_field('films');
            ?>

            <?php if ($films): ?>

            <ul class="small-block-grid-6 medium-block-grid-3 large-block-grid-4"></ul>

            <?php foreach ($films as $film_post) : ?>

              <?php $acf_fields = get_fields($film_post->ID); ?>

              <?php foreach ($acf_fields as $key=>$value) :
                if ($key) $film_post->{$key} = $value;
              endforeach; ?>

              <li class="small-2 medium-3 large-4 columns">
                <a href="<?php echo get_the_permalink($film_post->ID); ?>">
                  <img src="<?php echo $film_post->film_poster; ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                  <h3 class='text-smaller bold'><?php echo $film_post->post_title; ?></h3>
                  <p><?php echo $film_post->excerpt; ?></p>
                  <?php if($film_post->release_text_info) : ?><h4><?php echo $film_post->release_text_info; ?></h4><?php endif; ?>
                  <div class='button-container'>
                    <a class='learn button trailer-color' href='<?php echo get_the_permalink($film_post->ID); ?>'>See More</a>
                    <?php if($film_post->gowatchit_id) : ?>
                      <div class='watch button gwi-widget' data-id='<?php echo $film_post->gowatchit_id; ?>' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch Now</div>
                    <?php endif; ?>
                  </div>" alt="<?php echo $film_post->post_title ?>" />
                  <h3><?php echo $film_post->post_title; ?></h3>
                </a>
              </li>

            <?php endforeach; ?>

            </ul>

            <?php endif; ?>

            <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="clearfix"></div>
          <?php
          $next_post = get_next_post();
          $prev_post = get_previous_post();

          if ($prev_post) : ?>
            <div class="left"><?php previous_post_link(); ?></div>
          <?php endif; ?>

          <?php if ($next_post) : ?>
            <div class="right"><?php next_post_link(); ?></div>
          <?php endif; ?>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
