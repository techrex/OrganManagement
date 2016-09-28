<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();

        require_once(APPPATH.'third_party/phpmailer/class.phpmailer.php');
        require_once(APPPATH.'third_party/phpmailer/class.smtp.php');
    }

    public function send($sendTo, $subject, $body, $debug = 0) {
        if (empty($sendTo) || empty($subject) || empty($body)) {
            return false;
        }
        if (!filter_var($sendTo, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = $debug;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = "smtp.qq.com";
        //Set the SMTP port number - likely to be 25, 465 or 587
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = "Username";
        //Password to use for SMTP authentication
        $mail->Password = "Password";
        //Set who the message is to be sent from
        $mail->setFrom('admin@hdussta.cn', 'TechRex');
        //Set who the message is to be sent to
        $mail->addAddress($sendTo);
        //Set the subject line
        $mail->Subject = $subject;
        //Set word wrap to the RFC2822 limit
        $mail->WordWrap = 78;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($body);
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            return false;
            // echo $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
