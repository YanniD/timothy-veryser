console.log("js loaded");

$( document ).ready(function() {
    console.log( "jquery ready!" );
    init();
});



function init() {
  document.getElementById('contact-form').addEventListener('submit', function(ev) {
    ev.preventDefault();
    var formData = new FormData();
    formData.append('email', document.getElementById('form_email').value);
    formData.append('name', document.getElementById('form_name').value);
    formData.append('lName', document.getElementById('form_lastname').value);
    formData.append('need', document.getElementById('form_need').value);
    formData.append('message', document.getElementById('form_message').value);

    fetch('/mail/mail.php',
    {
      body: formData,
      method: "POST"
    }).then(function(response) {
      console.log(response);
      return response.json();
    }).then(function(body){
        if(body.isSuccess){
          var succesMessage = "Contact form successfully submitted. Thank you, I will get back to you soon!"
          $("#contact-form").find(".messages").addClass('alert alert-success').append("<p>"+ succesMessage +"</p>")
          $('#contact-form')[0].reset();
        }
        else{
          var failureMessage = "There was a error please try filling the form again"
          $("#contact-form").find(".messages").addClass('alert alert-danger').append("<p>"+ failureMessage +"</p>")
        }
    });
  });
}





// voor het email adres te laten werken => https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form
/*
function ajaxCall() {
  $(function () {

      // init the validator
      // validator files are included in the download package
      // otherwise download from http://1000hz.github.io/bootstrap-validator

      $('#contact-form').validator();


      // when the form is submitted
      $('#contact-form').on('submit', function (e) {

          // if the validator does not prevent form submit
          if (!e.isDefaultPrevented()) {
              var url = "../public/index.php";

              // POST values in the background the the script URL
              $.ajax({
                  type: "POST",
                  url: url,
                  data: $(this).serialize(),
                  success: function (data)
                  {
                      // data = JSON object that contact.php returns

                      // we recieve the type of the message: success x danger and apply it to the
                      var messageAlert = 'alert-' + data.type;
                      var messageText = data.message;

                      // let's compose Bootstrap alert box HTML
                      var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                      // If we have messageAlert and messageText
                      if (messageAlert && messageText) {
                          // inject the alert to .messages div in our form
                          $('#contact-form').find('.messages').html(alertBox);
                          // empty the form
                          $('#contact-form')[0].reset();
                      }
                  }
              });
              return false;
          }
      })
  });

}

*/
