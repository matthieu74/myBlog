<?php
namespace Framework;

require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class MailFactory
{
	public static function create()
	{
		// Create the Transport
		$transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
		  ->setUsername('peromatthieu@gmail.com')
		  ->setPassword('sophie75')
		  ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
		  ;
		  
		$mailer = \Swift_Mailer::newInstance($transport);
		return $mailer;
	}
	
	
}