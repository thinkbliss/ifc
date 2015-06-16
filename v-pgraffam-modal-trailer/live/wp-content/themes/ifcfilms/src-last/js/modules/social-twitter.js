// Social Share - Twitter
// popup that uses OG tags' content

module.exports = function(btn) {

  function init() {
    registerEvents();
  }

  function registerEvents() {
    btn.on('click',function(e) {
      e.preventDefault();

      var url = encodeURIComponent(window.location.href);
      var text = encodeURIComponent($("meta[name='twitter:description']").attr('content'));
      var shareUrl = 'https://twitter.com/intent/tweet?text='+ text +'&url=' + url;
      myWindow = window.open(shareUrl, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, width=530, height=290");
    });
  }

  init();
}
