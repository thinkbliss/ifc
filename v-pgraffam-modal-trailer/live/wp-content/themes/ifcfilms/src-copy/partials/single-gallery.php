<?php $images = get_field('photo_gallery'); ?>

<ul class="single-photo-gallery clearing-thumbs small-block-grid-2 medium-block-grid-3" data-clearing data-more-photos='[{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-1.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-1.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-2.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-2.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-3.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-3.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-1.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-1.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-2.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-2.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-3.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-3.jpg"},{"thmb":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-thmb-3.jpg","lg":"<?php echo get_template_directory_uri(); ?>/images/single/gallery-3.jpg"}]'>

<!--  <li class="single-featured-photo"><a href="--><?php //echo get_template_directory_uri(); ?><!--/images/single/gallery-poster.jpg"><img src="--><?php //echo get_template_directory_uri(); ?><!--/images/single/gallery-thmb-poster.jpg"></a></li>-->
  <?php foreach( $images as $image ): ?>
  <li>
    <a href="<?php echo $image['url']; ?>">
      <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"/>
    </a>
  </li>
  <?php endforeach; ?>


<!--  <li><a href="--><?php //echo get_template_directory_uri(); ?><!--/images/single/gallery-2.jpg">
        <img data-tooltip aria-haspopup="true" class="has-tip" title="<h5 class='text-smaller bold'>Viaje Acido</h5>-->
<!--    <p>Tooltips are awesome, you should totally use them!</p>-->
<!--    <div class='button-container'>-->
<!--      <a class='learn button trailer-color' href='http://www.ifc.com/movies/baseketball'>See More</a>-->
<!--      <a class='watch button gwi-widget trailer-color button-fill' href='http://gowatchit.com/movies/viaje-acido-36768' data-id='267277' data-type='movie' data-render='button' data-flavor='availability' data-layout='tabs' data-categories='3' data-tv-selectors='true'>Watch More</a>-->
<!--    </div>" src="--><?php //echo get_template_directory_uri(); ?><!--/images/single/gallery-thmb-2.jpg"></a>-->
<!--  </li>-->

  <a href="#" class="single-photo-gallery-more button trailer-color button-fill">Show More</a>
</ul>
