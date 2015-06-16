// Social Share - Facebook
// popup that scrapes OG tags

module.exports = function(btn) {

  function init() {
    registerEvents();
  }

  function registerEvents() {
    btn.on('click',function(e) {
      e.preventDefault();

      var url = encodeURIComponent(window.location.href);
      var shareUrl = 'https://www.facebook.com/sharer/sharer.php?u='+url;
      myWindow = window.open(shareUrl, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, width=530, height=290");
    });
  }

  init();
}
