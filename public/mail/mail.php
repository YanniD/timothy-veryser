<?php
/*

// email adres laten werken van deze website => https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form -->
 *  CONFIGURE EVERYTHING HERE
 */

// an email address that will be in the From field of the email.
$from = 'Website Timothy Veryser <timothy.veryser@domain.com>';

// an email address that will receive the email with the output of the form
$sendTo = 'yanniderous2009@hotmail.com';

// subject of the email
$subject = 'Nieuwe email website';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Voor naam', 'surname' => 'Familie naam','need' => 'Optie', 'email' => 'Email', 'message' => 'Bericht');

// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);
function validateEmail($email) {
      return filter_var($email, FILTER_VALIDATE_EMAIL);
   }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
return $data;
}
try
{
  //  var_dump($_POST);

      $firstNameForm = test_input($_post['form_name']);
      $lastNameForm = test_input($_post['form_lastname']);
      $needForm = test_input($_post['form_need']);
      $emailForm = test_input(validateEmail($_post['form_email']));
      $messageForm = test_input($_post['form_message']);


      $secret = "6LfjvHEUAAAAAP8atlw8zM6wDEiT3wOYoNHs8DIr";
      $responseKey = $_POST["g-recaptcha-response"];

      if (!isset($responseKey)) {
           throw new Exception('Gelieve de captcha in te vullen');
       }

      $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);


       if(!$response['success'] == true){
         throw new \Exception('Gelieve de reCaptcha in te vullen');
       }
         // if put on false it works

        $emailText = "Je hebt een nieuw bericht van jouw website\n=============================\n";

        /*foreach ($_POST as $key => $value) {
            // If the field exists in the $fields array, include it in the email
            if (isset($fields[$key])) {
                $emailText .= "$fields[$key]: $value\n";
            }
        }*/

        if(isset($firstNameForm)){
          $emailText .= "Voornaam : " + $firstNameForm + "\n";
        }
        else{
          throw new Exception('Voornaam is niet ingevulgd');
        }

        if(isset($lastNameForm)){
          $emailText .= "achternaam : " + $lastNameForm + "\n";
        }
        else{
          throw new Exception('achternaam is niet ingevuld');
        }

        if(isset($needForm)){
          $emailText .= "categorie : " + $needForm + "\n";
        }
        else{
          throw new Exception('categorie is niet ingevuld');
        }

        if(isset($emailForm)){
          $emailText .= "email : " + $emailForm + "\n";
        }
        else{
          throw new Exception('email is niet ingevuld');
        }

        if(isset($messageForm)){
          $emailText .= "bericht : " + $messageForm;
        }
        else{
          throw new Exception('bericht is niet ingevuld');
        }

        // All the neccessary headers for the email.
        $headers = array('Content-Type: text/plain; charset="UTF-8";',
            'From: ' . $from,
            'Reply-To: ' . $from,
            'Return-Path: ' . $from,
        );

        mail($sendTo, $subject, $emailText, implode("\n", $headers));

        $responseArray = array('isSuccess' => true);
              header("Content-Type: application/json");
              echo json_encode($responseArray);

      }
      // Send email
  catch (\Exception $e)
  {
      $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
      echo json_encode($responseArray);
      return;
  }
?>
