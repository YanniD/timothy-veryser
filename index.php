<?php include('pages/header.php');?>
<?php include('pages/menu.php');?>
<?php include('pages/over.php');?>
<?php include('pages/videos.php');?>
<?php include('pages/contact.php');?>
<?php include('pages/footer.php');?>


<!-- email adres laten werken van deze website => https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form -->

<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */
 // an email address that will be in the From field of the email.
 $fromEmail = '';
 $fromName = '';

 // an email address that will receive the email with the output of the form
 $sendToEmail = 'schellens.tibo@outlook.com';
 $sendToName = 'Timothy';

// subject of the email
$subject = 'New message from contact form';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'Surname', 'need' => 'Need', 'email' => 'Email', 'message' => 'Message');

// message that will be displayed when everything is OK :)
$okMessage = 'Het is succesvol verzonden. Danku, Ik beantwoord uw vraag/bericht zo snel mogelijk!';

// If something goes wrong, we will display this message.
$errorMessage = 'Er is een fout opgetreden. Probeer het nog eens aub';

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');

foreach ($_POST as $key => $value) {
    // If the field exists in the $fields array, include it in the email
    if (isset($fields[$key])) {
        $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
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
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}
?>
