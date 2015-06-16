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
          <h1 class="small-12 columns"><?php single_cat_title(); ?></h1>
        </div>

        <div class="single-row row">
          <div class="medium-3 columns">
            <?php get_template_part('/partials/filtering', 'sidebar'); ?>
          </div>

          <div class="medium-9 columns">

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <div class="medium-4 columns">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_field('film_poster') ?>" alt="<?php the_title(); ?>"/>
                <h3><?php the_title(); ?></h3>
              </a>
            </div>

            <?php endwhile; ?>

              <?php get_template_part('pagination'); ?>

            <?php else : ?>

              <p>No Films to display.</p>

            <?php endif; ?>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
