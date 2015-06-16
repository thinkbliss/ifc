<?php get_header('single'); ?>

<?php $results_plural = _n('Result', 'Results', $wp_query->found_posts) ?>

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
          <h1 class="columns">Search Results</h1>
          <span class="columns">Searching IFC Films for "<?php echo get_search_query(); ?>"</span>
        </div>

        <div class="single-row row">
          <div class="medium-12">

          <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <div class="row">
              <div class="medium-4">
                <?php the_post_thumbnail() ?>
              </div>
              <div class="medium-8">
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="button">See More</a>
              </div>
            </div>

          <?php endwhile; ?>

            <?php get_template_part('pagination'); ?>

          <?php else: ?>

            <p>O Search Results Found - please try again</p>

          <?php endif; ?>
          </div>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
