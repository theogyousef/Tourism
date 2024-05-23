$(document).ready(function() {
    $('.btn-list').click(function(e) {
      e.preventDefault();
      $('.grid-container').addClass('list-view');
      $('.products').css('flex-direction', 'row');
    });
  
    $('.btn-grid').click(function(e) {
      e.preventDefault();
      $('.grid-container').removeClass('list-view');
      $('.products').css('flex-direction', 'column'); 
    });
  });