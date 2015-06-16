var $ = require('jquery');

var config = require('./globals/config');

module.exports = function(videoControls) {
  videoControls.find('.pause').on('click', function () {
    config.myPlayer.pause();
  });
  videoControls.find('.play').on('click', function () {
    config.myPlayer.play();
  });

  videoControls.find('.mute').on('click', function () {
    config.myPlayer.muted(true);
    $(this).addClass('hide');
    $(this).parent().find('.unmute').removeClass('hide');
  });
  videoControls.find('.unmute').on('click', function () {
    config.myPlayer.volume(1);
    config.myPlayer.muted(false);
    $(this).addClass('hide');
    $(this).parent().find('.mute').removeClass('hide');
  });
  videoControls.find('.share').on('click', function(e) {
    e.preventDefault();

    $('.vjs-share-control').click();
  });
};
