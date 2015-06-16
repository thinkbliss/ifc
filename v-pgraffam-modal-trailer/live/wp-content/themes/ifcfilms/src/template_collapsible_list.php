<?php
/*
Template Name: Collapsible List
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

          <div class="single-row row">
          <?php the_content(); ?>
          </div>

          <?php
          $sections = get_field('collapsible_list');
          if (count($sections) > 0) : ?>
          <ul class="accordion" data-accordion role="tablist">
            <?php foreach($sections as $key=>$section) : ?>
            <li class="collapsible border-bottom single-row row active" role="tab">
              <a href="#item-<?php echo $key; ?>" role="tab">
                <h2 class="text-color"><?php echo $section['collapsible_title']; ?></h2>
              </a>

              <div id="item-<?php echo $key; ?>" class="content active" role="tabpanel">
                <?php echo $section['collapsible_content'] ?>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </article>

        <?php get_footer('single'); ?>
      </section>

    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
