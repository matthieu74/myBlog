<?php
namespace Framework;

require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class MailFactory
{
	private $config;
	
	public function __construct()
	{
		$this->config = Yaml::parse(file_get_contents(__DIR__."/Config/mail.yml"));

	}
	
	public function create()
	{
		
		
		// Create the Transport
		$transport = \Swift_SmtpTransport::newInstance($this->config['smtp'], intval($this->config['port']), $this->config['protocole'])
		  ->setUsername($this->config['user'])
		  ->setPassword($this->config['password'])
		  ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
		  ;
		  
		$mailer = \Swift_Mailer::newInstance($transport);
		return $mailer;
	}
	
	
}
