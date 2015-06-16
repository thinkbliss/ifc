<?php
/*
Template Name: Home Page
*/

get_header('home'); ?>

<?php
$home_page_id = get_option('page_on_front');
$featured = get_field('film_carousel', $home_page_id);
$items = array();
?>

<?php if ($featured):
  foreach ($featured as $featured_post) :

    $acf_fields = get_fields($featured_post->ID);

    foreach ($acf_fields as $key=>$value) :
      if ($key) $featured_post->{$key} = $value;
    endforeach;

    $items[] = $featured_post;
  endforeach; ?>

  <?php //print_r($items) ?>

  <!-- mobile section -->
  <section class="trailers-mobile hide-for-medium-up">
    <div class="row">
      <div class="small-12">
        <div class="flexslider">
          <ul class="slides">
            <?php foreach ($items as $key=>$item) : ?>
            <li>
              <div class="trailer-bg trailer-bg-<?php echo $key +  1; ?>"></div>
              <section class="trailer-info color-1">
                <h1><?php echo $item->post_title; ?></h1>
                <ul class="small-block-grid-3">
                  <li><a class="button" href="#">Trailer</a></li>
                  <li><a class="button" href="<?php get_permalink($item->ID); ?>">See More</a></li>
                  <li><a class="watch button hide-force gwi-widget" data-id="<?php echo $item->gowatchit_id; ?>" data-type="movie" data-render="button" data-flavor="availability" data-layout="tabs" data-categories="3" data-tv-selectors="true">Watch Now</a></li>
                </ul>
              </section>
            </li>

            <style type="text/css">
              .trailer-bg-<?php echo $key + 1; ?> {
                background-image: url('<?php echo $item->home_film_mobile; ?>');
              }
            </style>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <div id="overlay"></div>

  <!-- Start of Brightcove Player -->
  <video id="myDesktopPlayer"
         width="100%"
         height="100%"
         data-account="4132705219001"
         data-player="50847ee4-9a0e-4f4f-b303-8b16a73c5ae6"
         data-embed="default"
         data-video-id=""
         class="video-js hide-for-small" controls></video>

  <script src="//players.brightcove.net/4132705219001/50847ee4-9a0e-4f4f-b303-8b16a73c5ae6_default/index.min.js"></script>
  <!-- End of Brightcove Player -->

  <!-- desktop section -->
  <section id="trailersSection" class="trailers-desktop hide-for-small">
    <nav id="trailersNav" class="trailers-nav">
      <ul id="trailersSlices" class="trailers-scroll">
        <?php foreach ($items as $item) :
          $color = $item->color;
          ?>
        <li class="color-<?php echo $color; ?><?php if($item === reset($items)) : {echo " active first";} elseif($item === end($items)) : {echo " end";} endif; ?>" data-color="1" data-video-id="<?php echo $item->bc_trailer_id; ?>">
          <a class="text-center<?php if($item === reset($items)) echo " first-a"; ?>" href="#">
            <?php if ($item->presented) : ?>
              <p class="release-info opacity-0"><?php echo $item->presented; ?></p>
            <?php endif; ?>
            <h1><?php echo $item->post_title; ?></h1>
            <div class="trailer-drawer-ui">
              <div class="scrubber hide">
                <div class="progress">
                  <input class="scrubber-input" type="range" value="0" title="Scrubber Input">
                  <span class="meter"></span>
                </div>
              </div>
              <div class="video-controls trailer-color info hide">
                <span class="pause"><?php get_template_part( 'partials/svgs/video', 'pause' ); ?></span><span class="play hide"><?php get_template_part( 'partials/svgs/video', 'play' ); ?></span><span class="time"> <span class="current">00:00</span> / <span class="duration">00:00</span> </span><span class="mute"><?php get_template_part( 'partials/svgs/video', 'mute' ); ?></span><span class="unmute hide"><?php get_template_part( 'partials/svgs/video', 'unmute' ); ?></span>
              </div>
            </div>
            <div class="button-container">
              <div data-href="<?php the_permalink($item->ID); ?>" class="learn button opacity-0">See More</div>
              <div class="watch button hide-force gwi-widget" data-id="<?php echo $item->gowatchit_id; ?>" data-type="movie" data-render="button" data-flavor="availability" data-layout="tabs" data-categories="3" data-tv-selectors="true">Watch Now</div>
            </div>
          </a>
        </li>
        <?php endforeach; ?>

<!--          <li class="color-2" data-color="2" data-video-id="4147491092001">-->
<!--            <a class="text-center" href="#">-->
<!--              <p class="release-info opacity-0">A Sundance Selects Release</p>-->
<!--              <h1>The Duke of Burgundy</h1>-->
<!--              <div class="trailer-drawer-ui">-->
<!--                <div class="scrubber hide">-->
<!--                  <div class="progress">-->
<!--                    <input class="scrubber-input" type="range" value="0" title="Scrubber Input"/>-->
<!--                    <span class="meter"></span>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <div class="video-controls trailer-color info hide">-->
<!--                  <span class="pause">--><?php //get_template_part( 'partials/svgs/video', 'pause' ); ?><!--</span><span class="play hide">--><?php //get_template_part( 'partials/svgs/video', 'play' ); ?><!--</span><span class="time"> <span class="current">00:00</span> / <span class="duration">00:00</span> </span><span class="mute">--><?php //get_template_part( 'partials/svgs/video', 'mute' ); ?><!--</span><span class="unmute hide">--><?php //get_template_part( 'partials/svgs/video', 'unmute' ); ?><!--</span>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="button-container">-->
<!--                <div class="learn button opacity-0">See More</div>-->
<!--                <div class="watch button hide-force gwi-widget" data-id="267277" data-type="movie" data-render="button" data-flavor="availability" data-layout="tabs" data-categories="3" data-tv-selectors="true">Watch Now</div>-->
<!--              </div>-->
<!--            </a>-->
<!--          </li>-->

      </ul>
    </nav>
  </section>

<?php endif; ?>

<?php get_footer(); ?>
