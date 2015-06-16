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

      <!-- article -->
      <article id="post-404">

        <h1><?php _e( 'Page not found', 'ifcfilms' ); ?></h1>
        <h2>
          <a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'ifcfilms' ); ?></a>
        </h2>

      </article>
      <!-- /article -->

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
