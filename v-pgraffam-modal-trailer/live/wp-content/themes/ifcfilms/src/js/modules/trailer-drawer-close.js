var velocity = require('velocity');

var config = require('./globals/config');
var videoEvents = require('./video-events');
var trailerDrawerRotation = require('./trailer-drawer-rotation');

module.exports = function(handle, playerLightbox, innerWrap, headerContainer, leftOffCanvasMenu, trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer) {
  var myPlayerEvents = new videoEvents(config.myPlayer);

  handle.removeClass('close');
  myPlayerEvents.stopVideoPlayer();

  playerLightbox.velocity('player-lightbox-hide', {
    complete: function() {
      $('.vjs-social-cancel').click();
    }
  });

  innerWrap.velocity({
    'left': '0'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing,
    complete: function() {
      headerContainer.velocity({'right': '0', 'left': '7em'});

      $('.drawer-info-container .drawer-info').velocity({ opacity: 1 }, {duration: 300, display: 'block'});
      $('.drawer-info-container').velocity({ 'margin-left': '-26.7em' }, {duration: 300 });

      trailerDrawerRotation(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);
      config.trailerDrawerInterval = setInterval(function() {
        trailerDrawerRotation(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);
      }, config.intervalTiming + config.animationTiming);
    }
  });

  handle.velocity({
    'left': '0'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing
  });

  leftOffCanvasMenu.velocity({
    'left': '-24.28em', 'width': '500px'
  }, {
    duration: config.drawerSlideTiming,
    easing: config.easing
  });
};
