  <footer class="single-row row hide-for-small">

    <div class="medium-5 large-6 footer-desktop-right">
      <ul class="inline-list text-right">
        <?php wp_nav_menu(array('theme_location' => 'social-links', 'items_wrap' => '<li class="newsletter menu-item menu-item-type-custom menu-item-object-custom"><a href="#" class="letter-spacing">Newsletter</a></li>%3$s')); ?>
      </ul>
      <ul class="inline-list footer-links text-right">
        <?php wp_nav_menu(array('theme_location' => 'footer-links')); ?>
      </ul>
    </div>

    <div class="medium-7 footer-logos text-left">
    <?php $footerLogosMenu = wp_get_nav_menu_items( 'external-links', array(
      'theme_location' => 'external-links'
      ));
    foreach( $footerLogosMenu as $item ) { ?>
      <a class="<?php echo implode(" ",$item->classes) ?>" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
        <?php
          if (locate_template('partials/svgs/' . $item->classes[0] . '.php') != '') {
            include 'partials/svgs/' . $item->classes[0] . '.php';
          } else {
            error_log('missing svg named the same as this menu items class');
          }
        ?>
      </a>
    <?php } ?>
    </div>
  </footer>

  <?php wp_footer(); ?>

  <script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
      assets: '<?php echo get_template_directory_uri(); ?>',
      tests: {}
    });
  </script>

  <!-- analytics -->
  <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
      (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
      l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
    ga('send', 'pageview');
  </script>

  <!-- gowatchit api -->
  <script>
    (function (d, t, id) {
      GWI = {config: {}};
      var js, _s = d.getElementsByTagName(t)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(t);
      js.id = id;
      js.src = 'https://superwidget.gowatchit.com/gwi.js';

      GWI.config.apiKey = '65f5e51160f31fe314a7598b';
      GWI.config.theme = 'default';

      _s.parentNode.insertBefore(js, _s);
    }(document, 'script', 'gwijslib'));
  </script>

  </body>
</html>
