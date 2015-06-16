var velocity = require('velocity');

var config = require('./globals/config');

module.exports = function(body, trailersSlicesB, headerLi, footerLi, videoCont, area, areaRatio) {
  function calPx(e) {
    clearTimeout(config.trailerSlicesInterval);

    if(config.isIntroDone) {
      body.addClass("move");

      if(config.isReady) {
        config.isReady = false;

        var nonActiveSlices = trailersSlicesB.not('.active');
        var activeSlice = $('.active').find('a');

        headerLi.velocity('top-bar-intro', {stagger: 200});
        videoCont.velocity('homepage-video-enter');
        nonActiveSlices.velocity('trailers-slices-enter', {stagger: 200, complete: function() {  }});
        activeSlice.velocity('trailers-slices-active-enter', {});
        footerLi.velocity('footer-intro', {stagger: 100});
      }
    }

    config.trailerSlicesInterval = setTimeout(function() {
      removeMove();
    }, 5000);

    var mousePos = e.pageX - body[0].offsetLeft;
    config.mousePosMod = Math.min(Math.max(0, mousePos - config.mouseMovePadding), area) * areaRatio;
    e.preventDefault();
  }

  body.mousemove(function(e) {
    calPx(e, false);
  });

  body.mouseleave(function() {
    //clearTimeout(config.trailerSlicesInterval);
    //removeMove();
  });

  function removeMove() {
    body.removeClass("move");

    headerLi.velocity('top-bar-exit', {stagger: 100});
    trailersSlicesB.velocity('trailers-slices-exit', {stagger: 150, complete: function() { config.isReady = true; }});
    videoCont.velocity('homepage-video-exit', {});
    footerLi.velocity('footer-exit', {stagger: 100});
  }
};
