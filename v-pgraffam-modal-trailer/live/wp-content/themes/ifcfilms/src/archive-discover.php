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
        <div class="single-row row border-bottom titleHead">
          <h1 class="left titleHead"><?php _e('Discover', 'ifcfilms'); ?></h1>
          <span class="left">Featured collections compiled by IFC Films</span>
          <div class="clearfix"></div>
          <a href="/featured-discover"><span class="left-arrow-icon"></span>Return to featured collections</a>
        </div>

        <div class="single-row row">
          <ul class="small-block-grid-1">

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <li class="small-6 medium-4 large-3 columns">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_field('discover_small_image') ?>" data-tooltip aria-haspopup="true" class="has-tip" title="
                <h3 class='text-smaller bold'><?php the_title(); ?></h3>
                <p><?php the_field('discover_group_excerpt'); ?></p>
                <div class='button-container'>
                  <a class='learn button trailer-color' href='<?php the_permalink(); ?>'>See Collection</a>
                </div>" alt="<?php the_title(); ?>"/>
                <h3><?php the_title(); ?></h3>
              </a>
            </li>

            <?php endwhile; ?>

            <?php get_template_part('pagination'); ?>

            <?php endif; ?>
          </ul>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
