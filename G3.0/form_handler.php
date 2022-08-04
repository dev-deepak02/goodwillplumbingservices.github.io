<?php
include('phpmailer/PHPMailerAutoload.php');
// if (isset($_POST['sendMail'])){
$name = $_POST['name'];
$mobile_no = $_POST['mobile_no'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$email_from = 'deepaksaw763@gmail.com';
$site_name = 'Test website';
$host = 'smtp.gmail.com';

$email_subject = 'New Form Submission';

$email_body = "User Name: $name.\n".
                "User Number: $mobile_no.\n".
                "User Email: $email.\n".
                "Subject: $subject.\n".
                "User Message: $message.\n";

$to = 'goodwillplumbingservices@gmail.com';
$headers ="From: $email_from \r\n";
$headers = "Reply-To: $email \r\n";
// if (mail($to, $email_subject, $email_body, $headers)){
//     echo "Email successfully sent to $to";
// }else{
//     echo "Email sending failed....";
// }


//sender // password // reply // reciver//sender name //subject//message // attechment// attchmant_path
$res = smtpmailer('deepaksaw763@gmail.com', 'Deepak763@', 'deepaksaw763@gmail.com', 'deepaksaw763@gmail.com', $site_name, $subject, $message, '', '', true, $host); //send to admin

echo $res;

// }
header("Location: contact.html");

?>
