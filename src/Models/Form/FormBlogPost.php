<?php
namespace Models\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Models\Form\BlogPostType;
use Models\Entities\BlogPost;


class FormBlogPost
{
    public function __construct()
    {

    }

    public function createFormAdd($twig, $formFactory)
    {
		$blogPost = new BlogPost();
        
        $form = $formFactory->createBuilder(BlogPostType::class, $blogPost)
            ->getForm();
       
        return $form;
    }
	
	public function createFormEdit($twig, $formFactory, $blogPost)
    {
		
        $form = $formFactory->createBuilder(BlogPostType::class, $blogPost)
            ->getForm();
       
        return $form;
    }
	
	public function createFormDelete($twig, $formFactory, $blogPost)
    {
		
        $form = $formFactory->createBuilder(BlogPostDeleteType::class, $blogPost)
            ->getForm();
       
        return $form;
    }
	
}