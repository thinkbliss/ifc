var velocity = require('velocity');

var config = require('./globals/config');
//var trailersJSON = require('./globals/trailers-json');

module.exports = function(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop) {
  var currentTrailer = config.featuredTrailersJSON[config.currentTrailerNum];

  console.log(currentTrailer);

  // set and reveal trailer drawer bg again
  trailerDrawerBG.css({'background-image': 'url(' + currentTrailer.trailer_drawer_image + ')'}).velocity({ opacity: 1 }, { duration: 300, complete: function() {} });

  // set drawer title and reveal
  trailerDrawerTitle.text(currentTrailer.title).velocity({ opacity: 1 }, { duration: 300 });

  // set drawer title inside drawer info
  trailerDrawerInfoTitle.text(currentTrailer.title);

  // set video id to data
  trailerDrawerDesktop.data('video-id', currentTrailer.videoId);
};
