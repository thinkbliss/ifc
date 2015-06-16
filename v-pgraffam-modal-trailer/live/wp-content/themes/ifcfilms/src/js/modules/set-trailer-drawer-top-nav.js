var config = require('./globals/config');
//var trailersJSON = require('./globals/trailers-json.js');

module.exports = function(leftTrailer, rightTrailer, currentNum) {
  //console.log(config.max);

  var next, prev;
  prev = currentNum == 0 ? config.max : currentNum - 1;
  next = currentNum == config.max ? 0 : currentNum + 1;

  //console.log(prev);

  var trailersJSON = config.featuredTrailersJSON;

  leftTrailer.data({'video-id': trailersJSON[prev].bc_trailer_id, 'position': prev}).find('.text .bottom').text(trailersJSON[prev].post_title);
  rightTrailer.data({'video-id': trailersJSON[next].bc_trailer_id, 'position': next}).find('.text .bottom').text(trailersJSON[next].post_title);
};
