var $ = require('jquery');
var NProgress = require('nprogress');
var velocity = require('velocity');

var config = require('./globals/config');
var setTrailerDrawerInfo = require('./set-trailer-drawer-info');
var setTrailerDrawerTopNav = require('./set-trailer-drawer-top-nav');

module.exports = function(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer) {
  NProgress.done();

  var max = config.max;
  var currentTrailerNum = config.currentTrailerNum;
  var timing = config.intervalTiming;

  trailerDrawerBG.velocity({
    translateX: '35%'
  }, {
    duration: timing,
    easing: 'linear',
    begin: function() {

    },
    complete: function() {

      trailerDrawerTitle.velocity('stop').velocity({ opacity: 0 }, { duration: 300 });

      $(this).velocity('stop').velocity({ opacity: 0 }, { duration: 600,

        complete: function() {
          $(this).velocity({
            translateX: '0%'
          }, {
            duration: 0
          });

          setTrailerDrawerInfo(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop);
        }
      });
    }
  });

  setTrailerDrawerTopNav(leftTrailer, rightTrailer, currentTrailerNum);

  currentTrailerNum++;
  if (currentTrailerNum > max)
    currentTrailerNum = 0;

  config.currentTrailerNum = currentTrailerNum;
};
