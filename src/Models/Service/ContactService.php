<?php
namespace Models\Service;

use Framework\MailFactory;
class ContactService
{
	public function sendContact($data, $em)
	{
		// save the contact into database
		$data->getSecureData();
			
		$em->persist($data);
		$em->flush();
		
		//send mail
		$mailMessage = 'message from ' . $data->getName() . PHP_EOL .
							'is mail : ' . $data->getEmailAddress() . PHP_EOL .
							'the message : ' . PHP_EOL . $data->getMessage(); 
		return;
		$sm = MailFactory::create();
		$message = \Swift_Message::newInstance();
		$message->setSubject('msg myBlog')
				->setFrom('peromatthieu@gmail.com')
				->setTo('matthieu_pero@yahoo.fr')
				->setBody($mailMessage); 
		$sm->send($message);
	}
}