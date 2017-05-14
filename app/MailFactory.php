<?php
namespace Framework;

require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class MailFactory
{
	static public function create()
	{
		$config = Yaml::parse(file_get_contents(__DIR__."/Config/Mailer.yml"));
		
		// Create the Transport
		$transport = \Swift_SmtpTransport::newInstance($config['smtp'], intval($config['port']), $config['protocole'])
		  ->setUsername($config['user'])
		  ->setPassword($config['password'])
		  ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
		  ;
		  
		$mailer = \Swift_Mailer::newInstance($transport);
		return $mailer;
	}
	
	
}
