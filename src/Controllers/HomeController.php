<?php

namespace Controllers;

use Framework\Controller;
use Framework\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Models\Service\PresentationService;
use Models\Service\ContactService;
use Models\Form\FormContact;

class HomeController extends Controller
{
	
	private $request;
	
    /**
     * @return Response
     */
    public function showAction()
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		//Set up the symfony/form engine
		$formFactory = FormFactory::init($twig);

		//
		$formMgr = new FormContact();
        $myForm = $formMgr->createForm($twig, $formFactory);
		$myForm->handleRequest($this->request);
		$sendMailMessage = NULL;
		if ($myForm->isSubmitted() && $myForm->isValid()) {
			$contactService = new ContactService();
			$contactService->sendContact($myForm->getData(),$this->getDoctrine());
			$sendMailMessage = "Your message has been sent.";
		}
		
		// 
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
						'form' => $myForm->createView(),
					   	'mailMessage' => $sendMailMessage
            );
		$templateFile = 'home_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
	}
	
	public function show404Action()
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		$templateFile = '404_page.html.twig';
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),);
		$this->renderTwig($twig, $templateFile, $array);
		
	}
}
?>