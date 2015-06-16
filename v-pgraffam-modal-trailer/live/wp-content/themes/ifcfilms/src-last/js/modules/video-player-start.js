var $ = require('jquery');

var config = require('./globals/config');
//var trailersJSON = require('./globals/trailers-json');

var videoLoad = require('./video-load');
var videoEvents = require('./video-events');
var videoInteract = require('./video-interact');

var videoControls = $('.video-controls');

module.exports = function(loadingSpinner, videoId) {
  if(config.myPlayer == null) {
    if(config.theWindow.width() > 640) {
      videojs("myDesktopPlayer").ready(function() {
        var myPlayerEvents = new videoEvents();

        if(config.currentPage == 'homepage') {
          this.volume(0);
        }

        this.on('ended', function() {
          myPlayerEvents.setNextActive();
        });
        this.on('timeupdate', function() {
          myPlayerEvents.setCurrentTime();
        });
        this.on('durationchange', function() {
          loadingSpinner.hide();
          myPlayerEvents.setDurationTime();
        });
        this.on('loadeddata', function() {
          loadingSpinner.hide();
          myPlayerEvents.setDurationTime();
        });
        this.on('waiting', function() {
          loadingSpinner.show();
        });
        this.on('seeking', function() {
          loadingSpinner.show();
        });
        this.on('seeked', function() {
          loadingSpinner.hide();
        });
        this.on('progress', function() {
          loadingSpinner.hide();
        });

        this.on('pause', function() {
          var pause = videoControls.find('.pause');

          pause.addClass('hide');
          pause.parent().find('.play').removeClass('hide');
        });
        this.on('play', function() {
          var play = videoControls.find('.play');

          play.addClass('hide');
          play.parent().find('.pause').removeClass('hide');
        });

        var trailersJSON = config.featuredTrailersJSON;

        var options = {
          "title": trailersJSON[config.currentTrailerNum].post_title,
          "description": trailersJSON[config.currentTrailerNum].post_excerpt,
          "url": "http://area51.bigspaceship.com/private/ifc/main/",
          "deeplinking": true,
          "offset": "00:00:00",
          "services": {
            "facebook": true,
            "google": true,
            "twitter": true,
            "tumblr": true,
            "pinterest": true,
            "linkedin": true
          }
        };
        this.social(options);

        config.myPlayer = this;

        videoLoad(loadingSpinner, videoId);

        videoInteract(videoControls);
      });
    } else {
      videojs("myMobilePlayer").ready(function() {
        config.myPlayer = this;

        //config.myPlayer.volume(0);

        config.myPlayer.on('loadeddata', function() {
          loadingSpinner.hide();
        });

        videoLoad(loadingSpinner, videoId);
      });
    }
  } else {
    videoLoad(loadingSpinner, videoId);
  }
};
