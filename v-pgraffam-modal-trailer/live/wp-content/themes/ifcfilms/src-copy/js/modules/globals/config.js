var $ = require('jquery');
var trailersJSON = require('./trailers-json');

module.exports = {
  theWindow: $(window),
  currentPage: '',
  activeTrailer: null,
  featuredTrailersJSON: null,
  mouseMovePadding: 10,
  mouseMoveSoftness: 5,
  mousePos: 0,
  mousePosMod: 0,
  posX: 0,
  scrollX: -1,
  isIntroDone: false,
  isReady: false,
  currentTrailerNum: 0,
  intervalTiming: 10000,
  animationTiming: 1000,
  drawerSlideTiming: 500,
  //easing: 'cubic-bezier(0.645, 0.045, 0.355, 1)', //ease-in-out-cubic
  easing: 'cubic-bezier(0.770, 0.000, 0.175, 1.000)', //ease-in-out-quart
  max: trailersJSON.length - 1,
  myPlayer: null,
  trailerDrawerInterval: null,
  trailerSlicesInterval: null,
  offsetVal: $(window).width() > 640 ? 220 : 180
};
