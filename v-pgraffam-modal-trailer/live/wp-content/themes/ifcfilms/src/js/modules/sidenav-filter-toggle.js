  $('.filterToggle').on('click', function(){
    $(this).next('ul').slideToggle('slow');
    $(this).toggleClass('active');
    event.preventDefault();
  });