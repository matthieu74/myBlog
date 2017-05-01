<?php

namespace Controllers;

//twig
require_once __DIR__.'/../../vendor/autoload.php';
use Framework\Controller;
use Framework\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Models\Presentation\Presentation;
use Models\Home\FormulaireContact;

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
		$formulaire = new FormulaireContact();
        $monFomulaire = $formulaire->createFormulaire($twig, $formFactory);
		$monFomulaire->handleRequest($this->request);
		
		if ($monFomulaire->isSubmitted() && $monFomulaire->isValid()) {
			$formulaire->sendContact($monFomulaire->getData(),$this->getDoctrine());
		}
		
		// 
		$myDescription = new Presentation();
		$array = array('profil' => $myDescription->getTwigArray(),
						'form' => $monFomulaire->createView(),
            );
		$templateFile = 'home_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
	}
}
?>