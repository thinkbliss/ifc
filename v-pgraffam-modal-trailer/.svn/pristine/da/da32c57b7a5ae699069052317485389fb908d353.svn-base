var config = require('./globals/config');

module.exports = function(x, trailersSlices) {
  config.scrollX != x && (config.scrollX = x, x = x.toFixed(2),
    trailersSlices.css({
      "-webkit-transform": "translateX(-" + x + "px)",
      "-moz-transform": "translateX(-" + x + "px)",
      "-ms-transform": "translateX(-" + x + "px)",
      "-o-transform": "translateX(-" + x + "px)",
      transform: "translateX(-" + x + "px)"
    })
  )
};
