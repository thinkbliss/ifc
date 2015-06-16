// Search animation for whole site
var $ = require('jquery');
var config = require('./globals/config');

module.exports = {
  init : function() {
    this.setEls();
    this.registerEvents();
  },

  setEls : function() {
    this.parent = $('.search-input-container');
    this.input = $('.search-input');
    this.form = $('.search-form');
    this.btn = $('.search-btn');
    this.openClass = 'search-open';
  },

  registerEvents : function() {
    var self = this;

    // for some reason this is already working in chrome?
    // and ignoring the below?
    this.form.on('submit',function(e) {
      e.preventDefault();
      //console.log('form submitted');
    });

    this.btn.on('click',function(e) {
      e.preventDefault();
      self.parent.toggleClass(self.openClass);
      if( self.parent.hasClass(self.openClass) ) {
        self.input.focus();
      }

    });
  },

  onScroll : function() {
    var self = this;
    // close search bar
    if( self.parent.hasClass(self.openClass) ) {
      self.parent.removeClass(self.openClass)
    }
  }
};
