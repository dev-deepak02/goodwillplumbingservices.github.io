<?php
$name = $_POST['name'];
$mobile_no. = $_POST['mobile_no.'];
$email_id = $_POST['email'];
$message = $_POST['message'];

$email_form = 'goodwillplumbingservices@gmail.com';

$email_subject = 'New Form Submission';

$email_body = "User Name: $name.\n".
                "User Number: $mobile_no..\n"
                "User Email: $email_id.\n"
                "User Message: $message.\n"

$to = 'goodwillplumbingservices@gmail.com';
$headers ="From: $email_from \r\n";
$headers . = "Reply-To: $email_id \r\n";
mail($to, $email_subject, $email_body,$headers);

header("Location: contact.html");

?>