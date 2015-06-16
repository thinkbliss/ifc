var flexslider = require('flexslider');
var NProgress = require('nprogress');

module.exports = function(flexsliderCont, body) {
  flexsliderCont.flexslider({
    directionNav: false,
    animation: "slide",
    start: function(slider) {
      NProgress.done();

      var slideNum = slider.currentSlide + 1;

      body.addClass('trailer' + slideNum);
    },
    before: function(slider) {
      var slideNum = slider.currentSlide + 2;
      if (slideNum > slider.count)
        slideNum = 1;

      body.removeClass(function (index, css) {
        return (css.match(/(^|\s)trailer\S+/g) || []).join(' ');
      }).addClass('trailer' + slideNum);
    }
  });
};
