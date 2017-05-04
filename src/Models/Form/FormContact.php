<?php
namespace Models\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Models\Form\ContactType;
use Models\Entities\Contact;


class FormContact
{
    public function __construct()
    {

    }

    public function createForm($twig, $formFactory)
    {
		$contact = new Contact();
        
        $form = $formFactory->createBuilder(ContactType::class, $contact)
            ->getForm();
       
        return $form;
    }	
}