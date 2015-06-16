<!-- 
06-02: h2 for main copy header changed to h4 using global style and to match the comp.
Sidebar modules have been grouped. A new row created for top content, including sidebar.
2 new columns added, 1 to control left side main content the other to control sidebar content.
Classes added to sidebar modules to control positon.
-->

<?php get_header('single'); ?>

<?php if (get_field('presented_by_label') == 'midnight') { $isMidnight = true; } ?>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <a class="enter-on-canvas hide-for-small" href="#"></a>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <?php get_template_part('partials/trailer', 'drawer'); ?>

      <section class="single-page color-<?php the_field('color'); ?>">
        <div class="header-container row">

          <?php get_template_part('partials/header-nav'); ?>

          <div class="single-top-bg">
            <div class="small-12 text-center">
              <div class="title single-row">
                <h1><?php the_title(); ?></h1>
              </div>

              <div class="single-trailer trailer-color button button-fill"><?php get_template_part('partials/svgs/video', 'play') ?> Trailer</div>
            </div>

            <div class="top-bg-gradient"></div>
          </div>
          <style type="text/css">
            .single-top-bg {
              background-image: url("<?php the_field('film_header_mobile'); ?>");
            }

            @media all and (min-width: 641px) {
              .single-top-bg {
                background-image: url("<?php the_field('film_header'); ?>");
              }
            }
          </style>
        </div>
        <!-- end header container -->

        <?php get_template_part('partials/share', 'fixed'); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('first-row'); ?>>
          <!-- starring -->
          <?php if( have_rows('starring') ): ?>
            <div class="starring single-row row">
              <div class="text-center small-12">

                <h4><?php _e('Starring', 'ifcfilms'); ?></h4>

                <ul class="starring-list inline-list">
                  <?php while( have_rows('starring') ): the_row(); ?>
                    <li><?php the_sub_field('name'); ?></li>
                  <?php endwhile; ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <!-- /starring -->

          <!-- coming soon section -->
          <?php if( get_field('release_start_date') > date('Ymd')) : ?>
            <div class="coming-soon row single-row">
              <div class="small-12">
                <?php the_field('release_text_info'); ?>
              </div>
            </div>
          <?php endif; ?>
          <!-- end coming soon -->

          <!-- go watch it -->
          <?php if(get_field('gowatchit_id')) : ?>
          <div class="row single-row">
            <a class="watch button gwi-widget" data-id="<?php the_field('gowatchit_id'); ?>" data-type="movie" data-render="button" data-flavor="availability" data-layout="tabs" data-categories="3" data-tv-selectors="true">Watch Now</a>
          </div>
          <?php endif; ?>
          <!-- end go watch it -->

        <!-- creating a row that wraps main content and sidebar -->
        
        <div class="full-row single-row">
          <!-- quotes -->
          <div class="columns large-9 column-divider"> <!-- this column is for main content -->
          <?php if( have_rows('quotes') ):
            $quotes = get_field('quotes'); ?>
            <div class="quote row">
              <div class="small-12">
                <?php foreach ($quotes as $quote): ?>
                  <blockquote class="textItem">
                    <h3><?php echo strip_tags($quote['content']); ?></h3>
                      <p>&mdash; <?php echo $quote['author']; ?>, <?php if($quote['link']) : ?><a href="<?php echo $quote['link']; ?>" target="_blank"><?php echo $quote['publication_site'] ?></a><?php else : ?><?php echo $quote['publication_site'] ?><?php endif; ?></p>
                  </blockquote>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
          <!-- /quotes -->

              <!-- film details -->
              <div class="info border-bottom single-row row">
                <div class="small-12">
                  <?php $date = get_field('release_start_date'); ?>
                  <h4><?php if (get_field('presented_by_label')) : if (get_field('presented_by_label') == 'ifc_films') : echo "Presented by Sundance Selects | "; elseif ($isMidnight) : echo "<a href='/category/midnight'>An IFC Midnight Release</a>"; endif; endif; ?>
                  <?php if (get_field('country')) : the_field('country'); ?> | <?php endif; ?>
                  <?php if ($date) { echo date('M jS, Y', strtotime($date)) . " | "; } ?>
                  <?php if (get_field('feature_length')) : the_field('feature_length'); ?> MINS | <?php endif; ?>
                  <?php if (get_field('rating')) { the_field('rating'); } ?></h4>

                  <?php the_content(); ?>
                </div>
              </div>
              <!-- /film details -->


              <!-- awards -->
              <?php if( have_rows('traditional_awards') ):
              $trad_awards = get_field('traditional_awards'); ?>

              <ul class="accordion" data-accordion role="tablist">
                <li class="awards collapsible border-bottom single-row row active" role="tab" id="awards-heading" aria-controls="awards">
                  <!-- h2 inside a for foundation to work -->
                  <a href="#awards" role="tab"><h4 class="text-color">Awards</h4></a>

                  <div id="awards" class="content active clearfix" role="tabpanel" aria-labelledby="awards-heading">
                    <?php foreach ($trad_awards as $key=>$award) :
                    if($award['won']):
                      $won_num = count(array_filter($award['won']));
                    else:
                      $won_num = 0;
                    endif;

                    if($award['nominated']):
                      $nom_num = count(array_filter($award['nominated']));
                    else:
                      $nom_num = 0;
                    endif;

                    if ($won_num > 0 || $nom_num > 0) : ?>
                    <section class="medium-6 columns">
                      <h3><?php echo $award['award_name']; ?></h3>

                      <?php if ($won_num > 0): ?>
                        <h4><?php _e('Won', 'ifcfilms'); ?></h4>
                        <ul>
                          <?php foreach ($award['won'] as $won) : ?>
                            <li><?php echo $won['category']; ?></li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>

                      <?php if ($nom_num > 0): ?>
                        <h4><?php _e('Nominated', 'ifcfilms'); ?></h4>
                        <ul>
                          <?php foreach ($award['nominated'] as $nom) : ?>
                            <li><?php echo $nom['category']; ?></li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </section>
                    <?php endif;
                    endforeach; ?>
                  </div>
                </li>
              </ul>
              <?php endif; ?>
              <!-- /awards -->

              <!-- festivals -->
              <?php
              if( have_rows('festival_awards') ):
              $fest_awards = get_field('festival_awards'); ?>
              <div class="festival-awards collapsible border-bottom single-row row">
                <div class="small-12">
                  <ul>
                    <?php foreach ($fest_awards as $key=>$award) : ?>
                    <li>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/icons/icon-award.png ?>" class="left" alt="<?php echo $award['festival_name'] ?> logo">
                      <h4><?php echo $award['award_name'] ?></h4>
                      <p><?php echo $award['festival_name'] ?></p>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <?php endif; ?>
              <!-- /festivals -->
          
          
          <?php if(have_rows('video_gallery')) : ?>
            <ul class="accordion" data-accordion role="tablist">
              <li class="video collapsible border-bottom single-row row active" role="tab" id="video-heading" aria-controls="video">
                <a href="#video" role="tab"><h4>Video Clips &amp; Features</h4></a>
                <div id="video" class="content active" role="tabpanel" aria-labelledby="video-heading">
                  <?php get_template_part('partials/video', 'gallery'); ?>
                </div>
              </li>
            </ul>
          <?php endif; ?>

          <?php if(have_rows('photo_gallery')) : ?>
            <ul class="accordion" data-accordion role="tablist">
              <li class="gallery collapsible border-bottom single-row row active" role="tab" id="gallery-heading" aria-controls="gallery">
                <a href="#gallery" role="tab"><h4 class="text-color">Photo Gallery</h4></a>
                <div id="gallery" class="content active" role="tabpanel" aria-labelledby="gallery-heading">
                  <?php get_template_part('partials/single', 'gallery'); ?>
                </div>
              </li>
            </ul>
          <?php endif; ?>
                    
          <?php if(get_field('twitter_page')) : ?>
            <div class="follow border-bottom single-row row">
              <div class="small-12">
                <p>Stay up to date on <a class="text-color" href="http://twitter.com/<?php the_field('twitter_page'); ?>" target="_blank">@<?php the_field('twitter_page'); ?></a><?php if(get_field('twitter_hashtag')) : ?> / <a class="text-color" href="#">#<?php the_field('twitter_hashtag'); ?></a><?php endif ?></p>
              </div>
            </div>
          <?php endif; ?>

          </div> 
          <!-- end main content column -->

          <!-- sidebar -->
          <div class="columns large-3"> <!-- 06-02 this columns is for sidbar -->
          <div class="sidebar">
            <div class="cast single-row small-collapse row"> <!-- 06-02 removed bottom border class -->
              <?php
              $film_credits = array(
                'directors' => 'Director',
                'producers' => 'Producer',
                'executive_producers' => 'Executive Producer',
                'writers' => 'Writer'
              );

              foreach($film_credits as $key => $personnel_title) :
                $field_values = get_field($key);
                $num_values = count(array_filter($field_values));

                if ($num_values > 0) : ?>
                  <h4><?php echo _n($personnel_title, $personnel_title."s", $num_values, 'ifcfilms'); ?></h4>
                  <ul>
                    <?php foreach($field_values as $person) : ?>
                      <li><?php echo $person['name']; ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif;
              endforeach; ?>
            </div>

              <div class="links">
                <?php if (get_field('official_site')) : ?><a href="<?php the_field('official_site'); ?>" target="_blank" class="button share-button trailer-color site">Official Site</a><?php endif; ?>
                <?php if (get_field('facebook_page')) : ?><a href="https://www.facebook.com/<?php the_field('facebook_page'); ?>" target="_blank" class="button share-button trailer-color fb">Official Facebook</a><?php endif; ?>
                <?php if (get_field('twitter_page')) : ?><a href="https://www.twitter.com/<?php the_field('twitter_page'); ?>" target="_blank" class="button share-button trailer-color twitter">Official Twitter</a><?php endif; ?>
              </div>

              <ul class="accordion exhibitor-resources" data-accordion role="tablist"><!-- 06-02 removed bottom border class -->
                <li class="resources collapsible single-row row active" role="tab" id="resources-heading" aria-controls="resources">
                  <a href="#exhibitor" role="tab"><h4 role="tab">Exhibitor Resources</h4></a>
                  <div id="exhibitor" class="content active" role="tabpanel" aria-labelledby="resources-heading">
                    <p><a href="/contact-us">Contact Us</a> for screening information or log in to the <a href="http://extranet.ifcfilms.com/" target="_blank">IFC Extranet</a> for artwork, etc.</p>
                  </div>
                </li>
              </ul>              
          <!-- sidebar -->
            </div>
          </div>
          <!-- end row wrapper -->


        <!-- This is where the video clips list was. It's now int he sidebar - DR -->
          
        <!-- This is where the photo gallery was. It's now int he sidebar - DR -->

        <!-- This is where the exhibiter list was. It's now int he sidebar - DR -->



          <!-- films-like-this -->
          <?php $films = get_field('films_like_this');
          if ($films) :
            ?>
            <div class="related single-row row">
              <div class="small-12 columns">
                <h4><?php _e('More Films Like This', 'ifcfilms') ?></h4>

                <ul class="medium-8 small-block-grid-2 medium-block-grid-3 columns">
                  <?php foreach ($films as $film) : ?>
                    <li>
                      <a href="<?php echo get_permalink($film->ID); ?>">
                        <img src="<?php echo $film->film_thumb; ?>" alt="<?php echo $film->post_title; ?>" />
                        <h4><?php echo $film->post_title; ?></h4>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <!-- /films-like-this -->

              <!-- discover-links -->
              <?php
              $discovers = get_posts(array(
                'post_type' => 'discover',
                'posts_per_page' => 2,
                'meta_query' => array(
                  array(
                    'key' => 'films',
                    'value' => '"' . $post->ID . '"',
                    'compare' => 'LIKE'
                  )
                )
              ));

              if (count(array_filter($discovers)) > 0) : ?>
                <div class="small-12 medium-4 columns">
                  <h3>Discover More</h3>

                  <ul>
                    <?php foreach ($discovers as $key=>$disc) : ?>

                      <li>
                        <a href="<?php echo get_permalink($disc->ID); ?>"><?php echo $disc->post_title; ?></a>
                      </li>

                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <!-- /discover-links -->`

        </article>
        <!-- /article -->
          <?php get_footer('single'); ?>

          <div id="trailerModal" class="reveal-modal large<?php if($isMidnight) {?> midnight<?php } ?>" data-reveal aria-labelledby="trailerModalTitle" aria-hidden="true" role="dialog">
            <section class="">
              <a class="close-modal" href="#" aria-label="Close">&#215;</a>

              <video
                id="trailerPlayer"
                width="100%"
                height="100%"
                data-account="4132705219001"
                data-player="73e1ae66-c3ce-432c-9990-1ce9a3ad63d5"
                data-embed="default"
                class="flex-video widescreen video-js" controls></video>

              <div class="trailer-drawer-ui">
                <div class="trailer-drawer-info medium-12">
                  <div class="row">
                    <h2 id="drawerInfoTitle" class="text-color medium-5 columns text-left left"><?php the_title(); ?></h2>
                    <div class="right medium-7 columns">
                      <?php if (get_field('release_text_info')) : ?>
                      <h4 class="right"><?php the_field('release_text_info'); ?></h4>
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
                </div>
              </div>
            </section>
          </div>
          <!-- /trailer modal -->

        </section>
      </div>
    </div>

    <?php endwhile; ?>
    <?php endif; ?>

<script src="//players.brightcove.net/4132705219001/73e1ae66-c3ce-432c-9990-1ce9a3ad63d5_default/index.min.js"></script>

<script type="text/javascript">
(function() {

    var quotes = $('blockquote');
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(3000)
            .delay(5000)
            .fadeOut(3000, showNextQuote);
    }

    showNextQuote();

})();


</script>