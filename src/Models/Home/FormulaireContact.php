<?php
namespace Models\Home;


require __DIR__ . '/../../../vendor/autoload.php';

use Symfony\Component\Form\Forms;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Models\Home\ContactType;
use Models\Entities\Contact;
use Framework\MailFactory;

/**
 * Created by PhpStorm.
 * User: perom
 * Date: 22/04/2017
 * Time: 19:58
 */
class FormulaireContact
{
    public function __construct()
    {

    }

     public function createFormulaire($twig, $formFactory)
    {
		$contact = new Contact();
        // Create our first form!
        $form = $formFactory->createBuilder(ContactType::class, $contact)
			//->setAction('front.php/postContact')
			//->setMethod('POST')
            ->getForm();
       
        return $form;
    }
	
	public function sendContact($data, $em)
	{
		$data->getDataSecurisee();
			
		$em->persist($data);
		$em->flush();
		
		
		$sm = MailFactory::create();
		$message = \Swift_Message::newInstance();
		$message->setSubject('msg myBlog')
				->setFrom('peromatthieu@gmail.com')
				->setTo('matthieu_pero@yahoo.fr')
				->setBody('msg de ' . $data->getName() . '\n' .
							'mail : ' . $data->getEmailAddress() . '\n' .
							'message : ' . $data->getMessage()); 
		$sm->send($message);
	}

}