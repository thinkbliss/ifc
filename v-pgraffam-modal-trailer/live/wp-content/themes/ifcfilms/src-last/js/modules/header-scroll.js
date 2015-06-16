var config = require('./globals/config');

var search = require('./search');

var headerContainer = $('.header-container');

module.exports = function() {
  var scrollTop = config.theWindow.scrollTop();

  if (scrollTop >= config.offsetVal) {
    headerContainer.addClass('smaller');
  } else {
    headerContainer.removeClass('smaller');
  }

  search.onScroll();
};
