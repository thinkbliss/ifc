<ul class="small-block-grid-2 medium-block-grid-3">
<?php while( have_rows('video_gallery') ): the_row();
  $videoID = get_sub_field('video_id'); ?>

  <li>
    <video
      data-account="4132705219001"
      data-video-id="<?php echo $videoID; ?>"
      data-player="50f47a08-1c86-421b-8d4b-31bf3cfe16ba"
      data-embed="default"
      class="video-js flex-video" controls></video>
  </li>

<?php endwhile; ?>
</ul>

<script src="//players.brightcove.net/4132705219001/50f47a08-1c86-421b-8d4b-31bf3cfe16ba_default/index.min.js"></script>