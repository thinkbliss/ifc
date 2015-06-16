// bower lib requires
var $ = require('jquery');
var NProgress = require('nprogress');
var foundation = require('foundation');
var velocity = require('velocity');
var rangeslider = require('rangeslider');

// global requires
var config = require('./../modules/globals/config');
var universal = require('./../modules/globals/universal');
var velocityAnims = require('./../modules/globals/velocity-animations');

// local module requires
var search = require('./../modules/search');
var flexsliderStart = require('./../modules/flexslider-start');
var videoPlayerStart = require('./../modules/video-player-start');
var setActiveColor = require('./../modules/set-active-color');
var trailerSlicesMove = require('./../modules/trailer-slices-move');
var animate = require('./../modules/animate');
var videoLoad = require('./../modules/video-load');
var homepageAnimations = require('./../modules/homepage-animations');
var videoEvents = require('./../modules/video-events');

// trailer scroll start

// local vars
var $document = $(document),
    body = $('body'),
    overlay = $('#overlay'),
    logo = $('.name h1'),
    flexsliderCont = $('.flexslider');

// desktop only vars
var trailersNav = $('#trailersNav'),
    navWidth = trailersNav.outerWidth(),
    navScrollWidth = trailersNav[0].scrollWidth,
    trailersSlices = $('#trailersSlices'),
    trailersSlice = trailersSlices.find('li'),
    first = $('.first'),
    firstCont = first.find('a'),
    footer = $('footer'),
    footerLi = footer.find('ul li, .footer-logos a'),
    header = $('header'),
    headerLi = header.find('.top-bar-section ul li'),
    trailersSlicesA = trailersSlices.find('a').not('.first-a'),
    trailersSlicesB = trailersSlices.find('a'),
    videoCont = $('.video-js'),
    loadingSpinner = $('.vjs-loading-spinner'),
    widthDiff = navScrollWidth / navWidth - 1,
    area = navWidth - 2 * config.mouseMovePadding,
    areaRatio = navWidth / area,
    inputRange = $('input[type="range"]');

/*
  Startup
 */
// start foundation responsive
$document.foundation();

// nprogress
NProgress.configure({ showSpinner: false });
NProgress.start();

config.currentPage = 'homepage';

// determine current active trailer color
setActiveColor(body, trailersSlices);

// set up velocity ui registrations
velocityAnims();

homepageAnimations(headerLi, footerLi, trailersSlicesA, logo, first, firstCont, videoCont, overlay);

if(config.theWindow.width() <= 640) {
  // initiate flexslider for mobile
  flexsliderStart(flexsliderCont, body);
} else {
  inputRange.rangeslider({polyfill: false});

  // start animate and bind trailer slice movements
  trailerSlicesMove(body, trailersSlicesB, headerLi, footerLi, videoCont, area, areaRatio);
  animate(widthDiff, trailersSlices);

  // brightcove
  var videoId = $('.active').data('video-id');
  videoPlayerStart(loadingSpinner, videoId);
}

//trailersSlices.css({'width': (trailersSlice.width() * trailersSlice.length)});

search.init();


/*
  Events
 */
// click events
$('.toggle-topbar.mobile-menu-icon').on('click', function(e) {
  e.preventDefault();

  $(this).toggleClass('active');

  // toggle pause of flexslider if mobile menu expanded
  if($('.top-bar').hasClass('expanded')) {
    flexsliderCont.flexslider("play");
  } else {
    flexsliderCont.flexslider("pause");
  }
});

trailersSlice.on('click', function(e) {
  e.preventDefault();

  if($(this).hasClass('active')) {
    return;
  } else {


    NProgress.start();

    var active = trailersSlices.find('.active');
    active.removeClass('active').find('a').css('bottom', '');

    var nextActive = $(this);
    nextActive.addClass('active').find('a').css('bottom', '');

    nextActive.find('.pause, .mute').removeClass('hide');
    nextActive.find('.play, .unmute').addClass('hide');

    setActiveColor(body, trailersSlices);

    var videoId = nextActive.data('video-id');

    setTimeout(function() {
      videoLoad(loadingSpinner, videoId);

      var myPlayerEvents = new videoEvents();
      myPlayerEvents.unmutePlayer();
    }, 1000);
  }
});

// listen events
// rangeslider input listen
$document.on('input', inputRange, function(e) {
  var value = e.target.value;
  var myPlayerEvents = new videoEvents();
  myPlayerEvents.seek(value);
});
