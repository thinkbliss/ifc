var velocity = require('velocity');
var Velocity = require('velocity-ui');

var mediumTiming = 400;
var fastTiming = 200;

module.exports = function() {
  $.Velocity.RegisterUI('player-lightbox-show-desktop', {
    defaultDuration: fastTiming,
    calls: [
      [{opacity: 1, 'width': '90vw'}, 1, {display: 'block'}]
    ]
  });
  $.Velocity.RegisterUI('player-lightbox-show', {
    defaultDuration: fastTiming,
    calls: [
      [{opacity: 1, 'width': '100%', 'height': '395px'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('player-lightbox-hide', {
    defaultDuration: fastTiming,
    calls: [
      [{opacity: 0, 'width': '0'}, 1, {display: 'none'}]
    ]
  });

  $.Velocity.RegisterUI('top-bar-intro', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 1, 'margin-top': '1em'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('top-bar-exit', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 0, 'margin-top': '-2em'}, 1, {}]
    ]
  });

  $.Velocity.RegisterUI('footer-intro', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 1}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('footer-exit', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 0}, 1, {}]
    ]
  });

  $.Velocity.RegisterUI('trailers-slices-intro', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 1, 'margin-left': '0em'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('trailers-slices-exit', {
    defaultDuration: mediumTiming,
    calls: [
      [{opacity: 0, 'bottom': '30%'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('trailers-slices-enter', {
    defaultDuration: fastTiming,
    calls: [
      [{opacity: 1, 'bottom': '25%'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('trailers-slices-active-enter', {
    defaultDuration: fastTiming,
    calls: [
      [{opacity: 1, 'bottom': '18%'}, 1, {}]
    ]
  });

  $.Velocity.RegisterUI('homepage-video-enter', {
    defaultDuration: mediumTiming,
    calls: [
      //[{opacity: 0.66, 'width': '185%', 'height': '185%', 'top': '-42%', 'left': '-42%'}, 1, {}]
      [{opacity: 0.66, 'scale': '1.85'}, 1, {}]
    ]
  });
  $.Velocity.RegisterUI('homepage-video-exit', {
    defaultDuration: mediumTiming,
    calls: [
      //[{opacity: 1, 'width': '100%', 'height': '100%', 'top': '0', 'left': '0'}, 1, {}]
      [{opacity: 1, 'scale': '1'}, 1, {}]
    ]
  });
};
