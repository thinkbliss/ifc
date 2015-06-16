var $ = require('jquery');
var velocity = require('velocity');
var rangeslider = require('rangeslider');

var config = require('./globals/config');

module.exports = function(headerLi, footerLi, trailersSlicesA, logo, first, firstCont, videoCont, overlay) {
  if(config.theWindow.width() > 640) {
    //animation section
    headerLi.css({'margin-top': '-2em'});
    //footerLi.css({'margin-top': '2em'});
    footerLi.css('opacity', 0);
    trailersSlicesA.css({'opacity': 0, 'margin-left': '2em'});

    logo.velocity({
      opacity: 1
    }, {
      duration: 500,
      delay: 500,
      complete: function() {

        overlay.velocity({
          opacity: 0
        }, {
          duration: 3000,
          display: "none",
          complete: function() {

            first.velocity({opacity: 1}, {duration: 500});
            firstCont.velocity({left: 0}, {
              duration: 500,
              complete: function() {

                videoCont.velocity('homepage-video-enter');
                trailersSlicesA.velocity('trailers-slices-intro', {
                  stagger: 150,
                  complete: function() {
                    config.isIntroDone = true;
                  }
                });
                headerLi.velocity('top-bar-intro', {stagger: 150});
                footerLi.velocity('footer-intro', {stagger: 100});
              }
            });
          }
        });
      }
    });
  } else {
    logo.velocity({
      opacity: 1
    }, {
      duration: 500,
      delay: 500,
      complete: function() {

        overlay.velocity({
          opacity: 0
        }, {
          duration: 3000,
          display: "none"
        });
      }
    });
  }
};
