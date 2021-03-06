<?php
$home_page_id = get_option('page_on_front');
$featured = get_field('film_carousel', $home_page_id);
$items = array();
?>

<?php if ($featured): ?>
<?php foreach ($featured as $featured_post) :

  $acf_fields = get_fields($featured_post->ID);

  foreach ($acf_fields as $key=>$value) :
    if ($key) $featured_post->{$key} = $value;
  endforeach;

  $items[] = $featured_post;
endforeach; ?>

<!-- Trailer Drawer -->
<aside class="left-off-canvas-menu">
  <section class="trailer-drawer closed">
    <!-- mobile section -->
    <div class="hide-for-medium-up">
      <h4 class="color-white text-center mobile-title">New and featured from IFC Films</h4>

      <?php foreach ($items as $item) : ?>
      <div class="trailer">
        <div class="trailer-poster" data-video-id="<?php echo $item->bc_trailer_id; ?>" data-title="<?php echo $item->post_title; ?>">
          <img src="<?php echo $item->trailer_drawer_image; ?>"/>
        </div>
        <div class="small-collapse row">
          <h3 class="small-7 columns"><?php echo $item->post_title; ?></h3>
          <div class="small-5 columns text-right button-container">
            <div class="button">See More</div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

<!--      <div class="trailer">-->
<!--        <div class="trailer-poster" data-video-id="4147491092001" data-title="The Duke of Burgundy">-->
<!--          <img src="--><?php //echo get_template_directory_uri(); ?><!--/images/drawer/drawer-duke-sm.jpg"/>-->
<!--        </div>-->
<!--        <div class="small-collapse row">-->
<!--          <h3 class="small-7 columns">The Duke of Burgundy</h3>-->
<!--          <div class="small-5 columns text-right button-container">-->
<!--            <div class="button">See More</div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
    </div>

    <?php foreach ($items as $key=>$item) : ?>
    <?php if ($key == 0) : ?>
    <!-- desktop -->
    <div class="hide-for-small">
      <section class="desktop-drawer" data-video-id="<?php echo $item->bc_trailer_id; ?>">
        <div class="drawer-bg"></div>
      </section>
    </div>

    <!-- video player section -->
    <section id="playerLightbox" class="player-lightbox player-hide hide-for-small">
      <video
        id="myDesktopPlayer"
        width="100%"
        height="100%"
        data-account="4132705219001"
        data-player="4893e0f3-f9e0-48ae-81e1-98a137b44896"
        data-embed="default"
        data-video-id=""
        class="video-js" controls></video>

      <div class="trailer-drawer-ui hide-for-small">
        <div class="trailer-drawer-info medium-12">
          <div class="row">
            <h2 id="drawerInfoTitle" class="text-color medium-5 columns text-left left"><?php echo $item->post_title; ?></h2>
            <div class="right medium-7 columns">
              <a class="learn button trailer-color" href="#">See More</a>
              <?php if ($item->release_text_info) : ?>
                <h4 class="right"><?php echo $item->realease_text_info; ?></h4>
              <?php endif; ?>
            </div>
          </div>

          <div class="columns">
            <div class="scrubber">
              <div class="progress">
                <input id="seekBar" class="foo" type="range" value="0"/>
                <span class="meter"></span>
              </div>
            </div>
            <div class="info video-controls trailer-color left">
              <span class="pause"><?php get_template_part( 'partials/svgs/video', 'pause' ); ?></span><span class="play hide"><?php get_template_part( 'partials/svgs/video', 'play' ); ?></span><span class="time"> <span class="current">00:00</span> / <span class="duration">00:00</span> </span><span class="mute"><?php get_template_part( 'partials/svgs/video', 'mute' ); ?></span><span class="unmute hide"><?php get_template_part( 'partials/svgs/video', 'unmute' ); ?></span>
              <a href="#" class="share"></a>
            </div>
          </div>

          <div class="trailer-drawer-nav medium-12 columns">
            <nav class="">
              <div class="left text-left medium-6">
                <a id="leftTrailer" href="#"><span class="left-arrow-icon left"><</span><div class="text"><h4 class="top">Previous Trailer</h4><h3 class="bottom"></h3></div></a>
              </div>
              <div class="right text-right medium-6">
                <a id="rightTrailer" href="#"><span class="right-arrow-icon right"></span><div class="text"><h4 class="top">Next Trailer</h4><h3 class="bottom"></h3></div></a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <?php endif; ?>
    <?php endforeach; ?>
  </section>
</aside>
<!-- End Trailer Drawer -->

<?php foreach ($items as $key=>$item) : ?>
    <?php if ($key == 0) : ?>
<!-- desktop -->
<div class="drawer-info-container hide-for-small">
  <div class="drawer-info">
    <h2><?php echo $item->post_title; ?></h2>
    <h4>Play Trailer</h4>
  </div>
</div>

<div class="handle open">
  <a class="left-off-canvas-toggle">
    <h4 class="text-upperclass">Trailers</h4>
    <div class="handle-icon"></div>
  </a>
</div>

<div id="videoModal" class="reveal-modal full hide-for-medium-up" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">Video Modal</h2>
  <div class="flex-video widescreen">
    <video
      id="myMobilePlayer"
      data-account="4132705219001"
      data-player="4893e0f3-f9e0-48ae-81e1-98a137b44896"
      data-embed="default"
      data-video-id=""
      class="video-js" controls></video>
  </div>

  <a class="close-modal" href="#" aria-label="Close">&#215;</a>
</div>

<a class="exit-off-canvas" href="#"></a>
<!-- end desktop -->
<?php endif; ?>
<?php endforeach; ?>

<script src="//players.brightcove.net/4132705219001/4893e0f3-f9e0-48ae-81e1-98a137b44896_default/index.min.js"></script>

<?php endif; ?>