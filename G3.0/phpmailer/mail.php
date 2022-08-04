<?php
ini_set('display_errors', 0);
include "class.phpmailer.php";

function smtpmailer($from, $password, $reply_to, $to, $from_name, $subject, $message, $attachment, $is_gmail = true) {
    global $error;
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->SMTPAuth = true;
    $mail->SMTPDebug =0;  // debugging: 1 = errors and messages, 2 = messages only
    if ($is_gmail) {
        //$mail->SMTPSecure = "tls";
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = $from;
        $mail->Password = $password;
    } else {
        $mail->Host = "smtp.gmail.com";
        // $mail->Username = "info@dsfsdfsd.com";
        // $mail->Password = "bhujbank@1234";
    }
    $mail->IsHTML(true);
    $mail->From = $from;
    if($reply_to)
    {
    $mail->AddReplyTo($reply_to, $from_name);
}
    $mail->FromName = $from_name;
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    if ($attachment) {

		foreach($attachment as $file_name)
		{
		 $target_folder = "../customer_panel/app/webroot/file_attech/" . $file_name;
         $mail->AddAttachment($target_folder);
		}
      
    }
    if (!$mail->Send()) {
        $error = 'Mail error: ' . $mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}
?>
