<?php

define("MAIL", "crikey@crikeyaccounting.com.au");
define('REPLACE_FLAGS', ENT_QUOTES | ENT_XHTML);

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $from = MAIL;
    $sendTo = MAIL;
    $subject = 'New message from contact form';
    $fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
    $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
    $errorMessage = 'There was an error while submitting the form. Please try again later';
    $headers = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: Site <" . MAIL . ">\r\n";

    try {
        $emailText = "";

        foreach ($_POST as $key => $value) {

            if (isset($fields[$key])) {
                $emailText .= "$fields[$key] : " . htmlspecialchars($value, REPLACE_FLAGS) . "<br>";
            }
        }

        mail($sendTo, $subject, $emailText, $headers);

        $responseArray = array('type' => 'success', 'message' => $okMessage);
    } catch (\Exception $e) {
        $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $encoded = json_encode($responseArray);

        header('Content-Type: application/json');

        echo $encoded;
    } else {
        echo $responseArray['message'];
    }
}
