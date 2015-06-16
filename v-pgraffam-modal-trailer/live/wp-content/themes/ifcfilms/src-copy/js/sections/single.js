// bower lib requires
var $ = require('jquery');
var NProgress = require('nprogress');
var foundation = require('foundation');

// global requires
var config = require('./../modules/globals/config');
var universal = require('./../modules/globals/universal');
var velocityAnims = require('./../modules/globals/velocity-animations');

// module requires
var headerScroll = require('./../modules/header-scroll');
var search = require('./../modules/search');
var trailerDrawerRotation = require('./../modules/trailer-drawer-rotation');
var trailerDrawerClose = require('./../modules/trailer-drawer-close');
var trailerDrawerOpen = require('./../modules/trailer-drawer-open');
var hideAndLoadVideo = require('./../modules/hide-load-video');
var videoEvents = require('./../modules/video-events');
var videoPlayerStart = require('./../modules/video-player-start');
var singleAccordion = require('./../modules/single-accordion');
var photoGallery = require('./../modules/single-gallery');
var socialFB = require('./../modules/social-facebook');
var socialTW = require('./../modules/social-twitter');
var quoteRotator = require('./../modules/quote-rotator');


/*
local vars
 */
var $document = $(document),
    body = $('body'),
    mainTitle = $('.title h1'),
    trailerDrawer = $('.trailer-drawer'),
    trailerDrawerDesktop = trailerDrawer.find('.desktop-drawer'),
    trailerDrawerBG = trailerDrawer.find('.drawer-bg'),
    trailerDrawerTitle = $('.drawer-info h2'),
    trailerDrawerInfoTitle = $('#drawerInfoTitle'),
    leftTrailer = $('#leftTrailer'),
    rightTrailer = $('#rightTrailer'),
    singlePage = $('.single-page'),
    innerWrap = $('.inner-wrap'),
    leftOffCanvasMenu = $('.left-off-canvas-menu'),
    leftOffCanvasToggle = $('.left-off-canvas-toggle'),
    handle = $('.handle'),
    enterOnCanvas = $('.enter-on-canvas'),
    exitOffCanvas = $('.exit-off-canvas'),
    desktopDrawer = $('.desktop-drawer'),
    offCanvasWrap = $('.off-canvas-wrap'),
    playerLightbox = $('#playerLightbox'),
    loadingSpinner = $('.vjs-loading-spinner'),
    headerContainer = $('.header-container'),
    trailerPoster = $('.trailer-poster'),
    videoModal = $('#videoModal'),
    videoModalTitle = $('#videoModalTitle'),
    closeModal = $('.close-modal'),
    inputRange = $('input[type="range"]');

/*
startup
 */
// start foundation responsive
$document.foundation();

NProgress.configure({ showSpinner: false });

var universalInit = new universal;
var isMobile = universalInit.isMobileDevice();

// start top nprogress bar in desktop
if(config.theWindow.width() > 640) {
  NProgress.start();
}

config.currentPage = 'single';

// set up velocity ui registrations
var velocityAnimationsInit = new velocityAnims();

if(config.theWindow.width() <= 640) {
  // set font-size and margin of title
  var chars = mainTitle.text().length;
  if(chars >= 26) {
    mainTitle.parent().addClass('smaller-text');
  } else if(chars >= 15) {
    // only set smaller during scrolling
    mainTitle.parent().addClass('scroll-smaller-text');
  }
}

// set up trailer drawer interval rotation
if(config.theWindow.width() > 640) {
  $.get(window.location.origin + "/?__api=1&films=featured", function( response ) {
    config.featuredTrailersJSON = response.data;
    config.max = response.data.length - 1;

    // initial call to drawer rotation to get started
    trailerDrawerRotation(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);

    inputRange.rangeslider({polyfill: false});

    playerLightbox.css('width', '0');

    config.trailerDrawerInterval = setInterval(function () {
      trailerDrawerRotation(trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);
    }, config.intervalTiming + config.animationTiming);
  });
}

search.init();

/*
Click events
 */
$('.toggle-topbar.mobile-menu-icon').on('click', function(e) {
  e.preventDefault();

  $(this).toggleClass('active');

  // toggle pause of flexslider if mobile menu expanded
  if($('.top-bar').hasClass('expanded')) {
    handle.show();
  } else {
    handle.hide();
  }
});

// enter canvas and off canvas toggle link click
if(config.theWindow.width() > 640) {
  // enter canvas link click
  enterOnCanvas.on('click', function(e) {
    e.preventDefault();

    offCanvasWrap.addClass('move-right');
    handle.addClass('close');
  });

  $.merge(leftOffCanvasToggle, enterOnCanvas).on('click', function () {
    body.toggleClass('drawer-open');

    if (body.hasClass('drawer-open')) {
      trailerDrawerOpen(handle, headerContainer, trailerDrawerBG, innerWrap, desktopDrawer, playerLightbox, leftOffCanvasMenu, loadingSpinner);
    } else {
      trailerDrawerClose(handle, playerLightbox, innerWrap, headerContainer, leftOffCanvasMenu, trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);
    }
  });
}

// exit off canvas link click
exitOffCanvas.on('click', function() {
  if(config.theWindow.width() <= 640) {
    constrainSinglePage();
  } else {
    body.removeClass('drawer-open');

    trailerDrawerClose(handle, playerLightbox, innerWrap, headerContainer, leftOffCanvasMenu, trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, leftTrailer, rightTrailer);
  }
});

// mobile + desktop handle click
handle.on('click', function() {
  if(!$(this).hasClass('close')) {
    if(config.theWindow.width() <= 640) {
      // set single-page height and overflow to stop sideways scrolling
      singlePage.css({'top': '0', 'height': config.theWindow.height(), 'overflow-y': 'hidden'});
    }

    $(this).addClass('close');
  } else {
    constrainSinglePage();
  }
});

function constrainSinglePage() {
  handle.removeClass('close');

  if(config.theWindow.width() <= 640) {
    // wait for close trailer css transition to end to reset single page height and overflow
    innerWrap.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
      singlePage.css({'overflow-y': 'auto', 'height': '100%'});

      // apparently stil keeps listening so turn it off
      innerWrap.off("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
    });
  }
}

// left and right trailer click inside desktop trailer drawer
$.merge(leftTrailer, rightTrailer).on('click', function() {
  NProgress.start();

  var videoId = $(this).data('video-id');
  var pos = $(this).data('position');

  // set the current trailer number to clicked trailer
  config.currentTrailerNum = pos;

  // hide trailer drawer player lightbox, then load new video and info, then reveal again
  hideAndLoadVideo(playerLightbox, videoId, pos, trailerDrawerBG, trailerDrawerTitle, trailerDrawerInfoTitle, trailerDrawerDesktop, loadingSpinner, leftTrailer, rightTrailer);
});

// mobile trailer poster click
trailerPoster.on('click', function(e) {
  e.preventDefault();

  var videoId = $(this).data('video-id');
  var title = $(this).data('title');

  // open foundation modal with video player
  videoModal.foundation('reveal', 'open', {
    data: {videoId: videoId, title: title }
  });
});
closeModal.on('click', function(e) {
  e.preventDefault();

  var myPlayerEvents = new videoEvents();
  myPlayerEvents.stopVideoPlayer();

  setTimeout(function() {
    //myPlayer.dispose();

    // reset myPlayer
    config.myPlayer = null;

    // recreate foundation close modal so that display doesn't get set ot none and cause player issues
    videoModal.velocity({opacity: 0}, {duration: config.animationTiming, easing: config.easing, complete: function() {
      $(this).css({visibility: 'hidden'}).removeClass('open');
    }});
    $('.reveal-modal-bg').velocity({opacity: 0}, {duration: config.animationTiming, easing: config.easing, display: 'none'});
  }, 0);
});

// Accordion
singleAccordion();

// Photo Gallery
photoGallery($('.single-photo-gallery-more'), $('.single-photo-gallery'));

// Social Buttons
socialFB($('.fb-share'));
socialTW($('.tw-share'));

/*
listen events
 */
// modal open listen
$document.on('opened', '[data-reveal]', function () {
  var modal = $(this);

  // grab video id and title from passed in data params
  var videoId = modal.data('revealInit').data.videoId;
  var videoTitle = modal.data('revealInit').data.title;

  videoModalTitle.text(videoTitle);
  videoPlayerStart(loadingSpinner, videoId);
});

// rangeslider input listen
$document.on('input', inputRange, function(e) {
  var value = e.target.value;
  var myPlayerEvents = new videoEvents();
  myPlayerEvents.seek(value);
});

/*
scroll events
 */
config.theWindow.scroll(headerScroll);

headerScroll();
