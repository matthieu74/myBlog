<?php
namespace Framework;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Translation\Translator;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;

class FormFactory
{
	
	public static function init($twig)
	{
		// Set up the CSRF Token Manager
        $csrfTokenManager = new CsrfTokenManager();
        
		// Set up the Validator component
        $validator = Validation::createValidator();
        
		// Set up the Translation component
        $translator = new Translator('en');
        $formEngine = new TwigRendererEngine(array('form_div_layout.html.twig'), $twig);
        $formEngine->setEnvironment($twig);
        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
				TwigRenderer::class => function () use ($formEngine, $csrfTokenManager) {
					return new TwigRenderer($formEngine, $csrfTokenManager);
				},
		)));
		
		// add the FormExtension to Twig
		$twig->addExtension(new FormExtension());
		$twig->addExtension(new TranslationExtension($translator));
		
		// Set up the Form component
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new CsrfExtension($csrfTokenManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();
			
		return $formFactory;
	}
	
}