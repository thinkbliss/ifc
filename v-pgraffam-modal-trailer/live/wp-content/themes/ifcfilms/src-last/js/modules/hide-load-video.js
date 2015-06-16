var NProgress = require('nprogress');
var velocity = require('velocity');

var config = require('./globals/config');
var setTrailerDrawerInfo = require('./set-trailer-drawer-info');
var videoLoad = require('./video-load');
var setTrailerDrawerTopNav = require('./set-trailer-drawer-top-nav');

module.exports = function(playerLightbox, videoId, currentNum, trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, loadingSpinner, leftTrailer, rightTrailer) {
  playerLightbox.velocity({
    opacity: 0
  }, {
    duration: config.animationTiming,
    easing: config.easing,
    complete: function() {

      setTrailerDrawerInfo(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop);
      videoLoad(loadingSpinner, videoId);
      setTrailerDrawerTopNav(leftTrailer, rightTrailer, currentNum);

      playerLightbox.velocity({
        opacity: 1
      }, {
        duration: config.animationTiming,
        easing: config.easing,
        delay: config.animationTiming + 250,
        complete: function() { NProgress.done(); }
      });
    }
  })
}
