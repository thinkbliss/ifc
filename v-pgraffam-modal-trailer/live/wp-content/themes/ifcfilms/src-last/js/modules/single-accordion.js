// Accordion customizations on top of Foundation's accordion
// currently on mobile single
var velocity = require('velocity');

var config = require('./globals/config');

module.exports = function() {
  function init() {
    // only on mobile
    // bk todo: if only mobile, use transitions, not velocity, simplify
    if(config.theWindow.width() <= 640) {
      initAccordion();

      registerEvents();

      closeContent();
    } else {
      disableAccordion();
    }
  }

  // set up initial heights, to mimic slideToggle
  function initAccordion() {
    $('.collapsible').each(function() {
      $(this).addClass('accordion-navigation');

      var content = $('.content.active',this);
      // reset height, for resizing
      content.css('height','auto');

      var height = content.height();
      content.attr('data-height',height).css({
        'opacity': 1,
        'height': height,
        'display': 'block'
      });
    });
  }

  function disableAccordion() {
    $('.accordion a[role="tab"]').on('click',function(e) {
      e.preventDefault();
    });
  }

  function registerEvents() {
    // toggle click events
    $('.accordion li').on('click', 'a:eq(0)', function() {
      var li  = $(this).parent(),
        content = li.find('.content');
      if(li.hasClass('active')) {
        content.velocity({height: 0, opacity: 0}, {duration: config.animationTiming, easing: config.easing, display: 'none'});
      } else {
        content.velocity({height: content.data('height'), opacity: 1}, {duration: config.animationTiming, easing: config.easing, display: 'block'});
      }
    });

    // Throttled resize function
    $(window).on('resize', Foundation.utils.throttle(function() {
      initAccordion();
    }, 300));
  }

  function closeContent() {
    // close all but first
    $('.accordion a[role="tab"]:not(":first")').each(function() {
      $(this).trigger('click');
    });
  }

  init();
};
