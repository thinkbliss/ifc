var $ = require('jquery');
var NProgress = require('nprogress');

var config = require('./globals/config');

module.exports = function(loadingSpinner, videoId, player) {
  loadingSpinner.show();

  player.catalog.getVideo(videoId, function(error, video) {
    config.myPlayer.catalog.load(video);
    config.myPlayer.play();

    NProgress.done();
  });
};
