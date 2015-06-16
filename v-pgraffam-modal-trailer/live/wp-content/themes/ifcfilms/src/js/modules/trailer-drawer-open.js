var $ = require('jquery');
var velocity = require('velocity');
var rangeslider = require('rangeslider');

var config = require('./globals/config');

var videoPlayerStart = require('./video-player-start');

module.exports = function(handle, headerContainer, trailerDrawerBG, innerWrap, desktopDrawer, playerLightbox, leftOffCanvasMenu, loadingSpinner) {
  // hack for sticky header
  headerContainer.css({'right': 'inherit', 'left': 'inherit'});

  // stop trailerDrawerRotation
  trailerDrawerBG.velocity("stop").css('transform', 'translateX(0)');
  clearInterval(config.trailerDrawerInterval);

  $('.drawer-info-container .drawer-info').velocity({ opacity: 0 }, { duration: 200, display: 'none' });

  innerWrap.velocity({
    'left': '80vw'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing,
    complete: function() {

      var videoId = desktopDrawer.data('video-id');
      playerLightbox.removeClass('player-hide').addClass('player-show');
      playerLightbox.velocity('player-lightbox-show-desktop', {
        complete: function() {
          videoPlayerStart(loadingSpinner, videoId, "main");
        }
      });
    }
  });

  handle.velocity({
    'left': '80vw'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing
  });

  leftOffCanvasMenu.velocity({
    'left': '-10vw', 'width': '100%'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing
  });
}
