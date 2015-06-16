<?php
/*
Template Name: Sectioned Info
*/

?>

<?php get_header('single'); ?>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <a class="enter-on-canvas hide-for-small" href="#"></a>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php get_template_part('partials/trailer', 'drawer'); ?>

    <section class="single-page generic">
      <div class="header-container row">
        <?php get_template_part('partials/header-nav'); ?>
      </div>
      <!-- end header container -->

      <?php get_template_part('partials/share', 'fixed'); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="single-row row border-bottom">
          <h1 class="small-12 columns"><?php the_title(); ?></h1>
        </div>

        <?php the_content(); ?>

        <?php
        $sections = get_field('sections');
        if (count($sections) > 0) : ?>
        <div class="single-row row">
          <ul>
            <?php foreach($sections as $key=>$section) : ?>
              <li class="large-6 columns">
                <?php if($section['section_title']): ?>
                  <h3><?php echo strip_tags($section['section_title']) ?></h3>
                <?php endif; ?>
                <?php echo $section['section_content'] ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
      </article>

      <?php get_footer('single'); ?>
    </section>

    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
