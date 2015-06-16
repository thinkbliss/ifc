    var quotes = $('blockquote');
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(1500)
            .delay(2000)
            .fadeOut(1500, showNextQuote);
    }
    showNextQuote();
  
    $('.filterToggle').on('click', function(){
      $(this).next('ul').slideToggle('slow');
      $(this).toggleClass('active');
      event.preventDefault();
    });