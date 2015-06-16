<?php get_header('single'); ?>

<?php if ( in_category( 'midnight' ) || post_is_in_descendant_category( 'midnight' ) ) {
  $parentCat = 'midnight';
} else {
  $parentCat = 'ifc-films';
}
?>

<div class="off-canvas-wrap<?php if ($parentCat == 'midnight') {?> midnight<?php } ?>" data-offcanvas>
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
          <?php if ($parentCat == 'midnight') {?><img class="logo-ifc-midnight left" src="<?php get_template_directory(); ?>"/></span><span class="left">A leading distributor of genre entertainment</span><?php } else { ?>
          <h1 class="small-12 columns"><?php single_cat_title(); ?></h1>
          <?php } ?>
        </div>

        <div class="single-row row">
          <?php if ($parentCat == 'midnight') : ?>
          <div class="medium-12 columns">
            <?php get_template_part('/partials/filtering', 'midnight'); ?>
          </div>
          <?php else : ?>
          <div class="medium-3 columns">
            <?php get_template_part('/partials/filtering', 'sidebar'); ?>
          </div>
          <?php endif; ?>

          <ul class="<?php if ($parentCat == 'midnight') {?>medium-12<?php } else { ?>medium-9<?php } ?> columns">

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <li class="small-6 medium-4 large-3">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_field('film_poster') ?>" alt="<?php the_title(); ?>"/>
                <h3><?php the_title(); ?></h3>
              </a>
            </li>

            <?php endwhile; ?>

              <?php get_template_part('pagination'); ?>

            <?php else : ?>

              <p>No Films to display.</p>

            <?php endif; ?>
          </ul>
        </div>
      </article>

      <?php get_footer('single'); ?>
    </section>
  </div>
</div>
