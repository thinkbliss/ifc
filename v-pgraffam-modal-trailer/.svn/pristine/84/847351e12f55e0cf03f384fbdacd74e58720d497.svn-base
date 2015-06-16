// Gallery on top of Foundation's Clearing Lightbox
// currently on mobile single
var velocity = require('velocity');
var config = require('./globals/config');

module.exports = function(moreBtn, parent) {

  // pass these in
  //var moreBtn = $('.single-photo-gallery-more');
  //var parent = $('.single-photo-gallery');

  function init() {
    registerEvents();
  }

  function registerEvents() {
    moreBtn.on('click',function(e) {
      e.preventDefault();
      // make ajax request for json, more photos
      // or read json printed into page, dynamically create new imgs ;)
      // cant be that many, only load 6 more at a time
      var allPhotos = getData(), photosToAdd = [];
      while(allPhotos.length > 0 && photosToAdd.length < 6) {
        photosToAdd.push(allPhotos.shift());
      }
      setData(allPhotos);
      addPhotos(photosToAdd);
      if(allPhotos.length == 0) {
        hideShowMore();
      }
    });
  }

  function getData() {
    return parent.data('more-photos');
  }

  function setData(photos) {
    return parent.data('more-photos', photos);
  }

  // to DOM
  function addPhotos(photos) {
    for( i in photos) {
      moreBtn.before($('<li><a href="'+ photos[i].lg +'"><img src="'+ photos[i].thmb +'"></a></li>'));
    }
  }

  function hideShowMore() {
    moreBtn.fadeOut();
  }

  init();
};
