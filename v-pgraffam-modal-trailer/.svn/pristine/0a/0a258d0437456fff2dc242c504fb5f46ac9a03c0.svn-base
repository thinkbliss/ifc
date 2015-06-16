var config = require('./globals/config');

var setScrollX = require('./set-scroll-x');

module.exports = function(widthDiff, trailersSlices) {
  function animate() {
    window.requestAnimationFrame(animate);
    navigation();

    function navigation() {
      if(config.isIntroDone) {
        config.posX += (config.mousePosMod - config.posX) / config.mouseMoveSoftness;

        var translatePos = config.posX * widthDiff;
        setScrollX(translatePos, trailersSlices);
      }
    }
  }

  animate();
};
