module.exports = function() {
  // request animation polyfill
  var lastTime = 0;
  var vendors = ['ms', 'moz', 'webkit', 'o'];
  for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
      || window[vendors[x] + 'CancelRequestAnimationFrame'];
  }

  if(!window.requestAnimationFrame)
    window.requestAnimationFrame = function(callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function() {
          callback(currTime + timeToCall);
        },
        timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };

  if(!window.cancelAnimationFrame)
    window.cancelAnimationFrame = function(id) {
      clearTimeout(id);
    };

  // user agent tests
  this.isMobileDevice = function() {
    return navigator.userAgent.indexOf("Mobile") > -1;
  };

  this.isiPhone = function() {
    return navigator.platform.indexOf("iPhone") > -1 || navigator.platform.indexOf("iPod") > -1;
  };

  this.isiPad =  function() {
    return navigator.platform.indexOf("iPad") > -1;
  }
};
