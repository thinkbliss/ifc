var $ = require('jquery');

var config = require('./globals/config');

module.exports = function(videoControls, player) {
  videoControls.find('.pause').on('click', function () {
    player.pause();
  });
  videoControls.find('.play').on('click', function () {
    player.play();
  });

  videoControls.find('.mute').on('click', function () {
    player.muted(true);
    $(this).addClass('hide');
    $(this).parent().find('.unmute').removeClass('hide');
  });
  videoControls.find('.unmute').on('click', function () {
    player.volume(1);
    player.muted(false);
    $(this).addClass('hide');
    $(this).parent().find('.mute').removeClass('hide');
  });
  videoControls.find('.share').on('click', function(e) {
    e.preventDefault();

    $('.vjs-share-control').click();
  });
};
