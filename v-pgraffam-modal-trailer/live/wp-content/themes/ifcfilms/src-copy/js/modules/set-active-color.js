var $ = require('jquery');

var config = require('./globals/config');

module.exports = function(body, trailersSlices) {
  var active = trailersSlices.find('.active');
  config.activeTrailer = active;

  var trailerNum = active.data('color');
  var activeColor = "trailer" + trailerNum;

  body.removeClass(function (index, css) {
    return (css.match(/(^|\s)trailer\S+/g) || []).join(' ');
  }).addClass(activeColor);
};
