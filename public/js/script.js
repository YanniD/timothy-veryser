console.log("js loaded");

$( document ).ready(function() {
    console.log( "jquery ready!" );
    $('body').scrollspy({ target: '#navbar' })
    $("#navbar a").on('click', function(event) {

    if (this.hash !== "") {

      event.preventDefault();
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top -0
      }, 800, function(){

        window.location.hash = hash;
      });
    }
  });
    init();
});



function init() {
  document.getElementById('contact-form').addEventListener('submit', function(ev) {
    ev.preventDefault();

    var formData = new FormData();

    var reCaptcha = grecaptcha.getResponse();
    console.log(reCaptcha);
    formData.append('email', document.getElementById('form_email').value);
    formData.append('name', document.getElementById('form_name').value);
    formData.append('lName', document.getElementById('form_lastname').value);
    formData.append('need', document.getElementById('form_need').value);
    formData.append('message', document.getElementById('form_message').value);
    formData.append("g-recaptcha-response",reCaptcha);

    fetch('/mail/mail.php',
    {
      body: formData,
      method: "POST"

    }).then(function(response) {
      return response.json();
    }).then(function(body){
    $("#contact-form").find("#messages").removeClass().children().remove();
        if(body.isSuccess){

          var succesMessage = "Je email is verstuurd. Bedankt, Ik neem spoedig contact met je op!"
          $("#contact-form").find("#messages").addClass('alert alert-success').append("<p>"+ succesMessage +"</p>")
          $('#contact-form')[0].reset();
        }
        else{
          var failureMessage = body.message;
          console.log(failureMessage);
          $("#contact-form").find("#messages").addClass('alert alert-danger').append("<p>"+ failureMessage +"</p>")
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
