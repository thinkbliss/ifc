var $ = require('jquery');

var config = require('./globals/config');

module.exports = function(player, location) {
  var trailerDrawerUI = location == 'main' ? $('.trailer-drawer-ui') : $('#trailerModal .trailer-drawer-ui');
  var currentTimeUI = trailerDrawerUI.find('.time .current'),
      durationTimeUI = trailerDrawerUI.find('.time .duration'),
      progress = trailerDrawerUI.find('.progress'),
      meter = trailerDrawerUI.find('.meter');

  this.seek = function(value) {
    var time = player.duration() * (value / 100);
    player.currentTime(time);
  };

  this.setCurrentTime = function() {
    var currentTime = Math.floor(player.currentTime());
    var durationTime = player.duration();

    var minutes = "0" + Math.floor(currentTime / 60);
    var seconds = "0" + (currentTime - minutes * 60);

    if(config.currentPage == 'homepage') {
      config.activeTrailer.find('.time .current').text(minutes.substr(-2) + ':' + seconds.substr(-2));
      config.activeTrailer.find('.meter').css({'width': (player.currentTime() / durationTime) * 100 + '%'});
    } else {
      currentTimeUI.text(minutes.substr(-2) + ':' + seconds.substr(-2));
      meter.css({'width': (player.currentTime() / durationTime) * 100 + '%'});
    }
  };

  this.setDurationTime = function() {
    var durationTime = Math.floor(player.duration());
    var minutes = "0" + Math.floor(durationTime / 60);
    var seconds = "0" + (durationTime - minutes * 60);

    if(config.currentPage == 'homepage') {
      config.activeTrailer.find('.time .duration').text(minutes.substr(-2) + ':' + seconds.substr(-2));
    } else {
      durationTimeUI.text(minutes.substr(-2) + ':' + seconds.substr(-2));
    }
  };

  this.stopVideoPlayer = function() {
    player.pause();
  };

  this.unmutePlayer = function() {
    player.volume(1);
  };

  this.setNextActive = function() {
    if(config.currentPage == 'homepage') {
      var active = $('#trailersSlices').find('.active');
      var next = config.activeTrailer.next().length > 0 ? config.activeTrailer.next() : $($('#trailersSlices li')[0]);

      next.trigger('click');
    } else if(config.currentPage == 'single') {
      $('#rightTrailer').trigger('click');
    }
  };
};
