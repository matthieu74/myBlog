<?php

namespace Controllers;

use Framework\Controller;
use Framework\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Models\Service\PresentationService;
use Models\Service\BlogPostService;
use Models\Entities\BlogPost;
use Models\Form\FormBlogPost;

class BlogController extends Controller
{
	private $request;
	public function showAction()
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$bp = new BlogPostService();
		$blogPosts = $bp->getAllPosts($this->getDoctrine());
		
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
						'title' => 'visit my blog',
						'blogPosts' => $blogPosts,
					   	'modeBlog' => 1
						);
		
		$templateFile = 'posts_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
		
	}

	public function showDetailAction($idBlog)
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$bp = new BlogPostService();
		$postDetail = $bp->getPostDetail($this->getDoctrine(),$idBlog);

		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
						'title' => 'visit my blog',
						'post' => $postDetail,
					   	'modeBlog' => 1
						);
		
		$templateFile = 'post_detail_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
	}
	
	
	public function editAction($idBlog)
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$bp = new BlogPostService();
		$postDetail = $bp->getPostDetail($this->getDoctrine(),$idBlog);
		
		//Set up the symfony/form engine
		$formFactory = FormFactory::init($twig);

		//
		$formMgr = new FormBlogPost();
        $myForm = $formMgr->createFormEdit($twig, $formFactory, $postDetail);
		$myForm->handleRequest($this->request);
		$sendMailMessage = NULL;
		if ($myForm->isSubmitted() && $myForm->isValid()) {
			$bp->savePost($this->getDoctrine(),$postDetail);
			$this->showDetailAction($idBlog);
			return;
		}
		
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
					  	'form' => $myForm->createView(),
					   	'post' => $postDetail,
					   	'modeBlog' => 1);
		$templateFile = 'post_edit_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
		 
	}
	
	public function addAction()
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		//Set up the symfony/form engine
		$formFactory = FormFactory::init($twig);

		//
		$formMgr = new FormBlogPost();
        $myForm = $formMgr->createForm($twig, $formFactory);
		$myForm->handleRequest($this->request);
		$sendMailMessage = NULL;
		if ($myForm->isSubmitted() && $myForm->isValid()) {
			$bp = new BlogPostService();
			$postDetail = $myForm->getData();
			$bp->savePost($this->getDoctrine(),$postDetail);
			$this->showDetailAction($postDetail->getId());
		}
		
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
					  	'form' => $myForm->createView(),
					   	'addPost' => 1,
					  	'modeBlog' => 1);
		$templateFile = 'post_edit_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
	}
	
	public function deleteAction($idBlog)
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$bp = new BlogPostService();
		$postDetail = $bp->getPostDetail($this->getDoctrine(),$idBlog);
		
		//Set up the symfony/form engine
		$formFactory = FormFactory::init($twig);

		//
		$formMgr = new FormBlogPost();
        $myForm = $formMgr->createFormDelete($twig, $formFactory, $postDetail);
		$myForm->handleRequest($this->request);
		$sendMailMessage = NULL;
		if ($myForm->isSubmitted() && $myForm->isValid()) {
			$bp->deletePost($this->getDoctrine(),$postDetail);
			$this->showAction();
			return;
		}
		
		$myDescription = new PresentationService();
		$array = array('profil' => $myDescription->getTwigArray(),
					  	'form' => $myForm->createView(),
					   	'post' => $postDetail,
					   	'modeBlog' => 1);
		
		$templateFile = 'post_delete_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
	}
}