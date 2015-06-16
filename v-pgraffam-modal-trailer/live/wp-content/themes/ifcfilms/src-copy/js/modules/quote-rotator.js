 var $ = require('jquery');
 var config = require('./globals/config');

 module.exports = function() {

    function init() {
        showNextQuote();
    }
   

    var quotes = $('blockquote');
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(3000)
            .delay(5000)
            .fadeOut(3000, showNextQuote);
    }    
    init();
 }

