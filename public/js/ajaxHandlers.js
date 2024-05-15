$(document).ready(function() {
  $('#submitMailButton').click(function() {
    $.ajax({
      type: "POST",
      url: "../controller/indexMail.php", 
      data: {
        email: $('#email').val(),
        firstname: 'Friend', 
        submitemail: true 
      },
      success: function(response) {
        $('#message').text(response);
      },
      error: function() {
        $('#message').text('An error occurred while sending the email.');
      }
    });
  });
});