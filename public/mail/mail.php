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

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
    if(isset($_POST['submit'])){
      $emailText = "Je hebt een nieuw bericht van je contact form\n=============================\n";

      foreach ($_POST as $key => $value) {
          // If the field exists in the $fields array, include it in the email
          if (isset($fields[$key])) {
              $emailText .= "$fields[$key]: $value\n";
          }
      }

      // All the neccessary headers for the email.
      $headers = array('Content-Type: text/plain; charset="UTF-8";',
          'From: ' . $from,
          'Reply-To: ' . $from,
          'Return-Path: ' . $from,
      );

      // Send email
      mail($sendTo, $subject, $emailText, implode("\n", $headers));

      $responseArray = array('type' => 'success', 'message' => $okMessage);
  }
}
  catch (\Exception $e)
  {
      $responseArray = array('type' => 'danger', 'message' => $errorMessage);
  }
