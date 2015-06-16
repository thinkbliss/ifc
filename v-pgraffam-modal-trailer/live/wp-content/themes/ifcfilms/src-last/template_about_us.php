<?php
/*
Template Name: About Us
*/

?>

<?php get_header('single'); ?>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <a class="enter-on-canvas hide-for-small" href="#"></a>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php get_template_part('partials/trailer', 'drawer'); ?>

    <section class="single-page">
      <div class="header-container row">
        <?php get_template_part('partials/header-nav'); ?>
      </div>
      <!-- end header container -->

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h1 class="single-row row"><?php the_title(); ?></h1>

        <?php
        $sections = get_field('sections');
        if (count($sections) > 0) : ?>
          <ul>
            <?php foreach($sections as $key=>$section) : ?>
              <li class="single-row row">
                <?php if($section['section_title']): ?>
                  <h3><?php echo $section['section_title'] ?></h3>
                <?php endif; ?>
                <p><?php echo $section['section_content'] ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </article>
      <?php get_footer(); ?>
    </section>

    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
