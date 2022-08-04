<?php

function smtpmailer($from, $password, $reply_to, $to, $from_name, $subject, $message, $attachment,$attachment_path, $is_gmail = true,$host) {

if($host==''){
	$host = 'smtp.gmail.com';
}
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2;                               // Enable SMTP authentication
$mail->Username = $from;                 // SMTP username
$mail->Password = $password;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

		$mail->isHTML(true);    
		$mail->From = $from;                              // Set email format to HTML
		$mail->AddAddress($to);
		if($reply_to)
		{
		$mail->AddReplyTo($reply_to, $from_name);
		}
		$mail->FromName = $from_name;
		$mail->Subject = $subject;
		$mail->Body = $message;
		if ($attachment) {

			foreach($attachment as $file_name)
			{
			$target_folder = $attachment_path.$file_name;
			$mail->AddAttachment($target_folder);
			}

		} 
   if (!$mail->Send()) {
     //   $error = 'Mail error: ' . $mail->ErrorInfo;
    return false;
    } else {
      //  $error = 'Message sent!';
     return true;
    }
}

function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'class.'.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('PHPMailerAutoload', true, true);
    } else {
        spl_autoload_register('PHPMailerAutoload');
    }
} else {
    /**
     * Fall back to traditional autoload for old PHP versions
     * @param string $classname The name of the class to load
     */
    function __autoload($classname)
    {
        PHPMailerAutoload($classname);
    }
}
