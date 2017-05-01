<?php

namespace Controllers;

//twig
require_once __DIR__.'/../../vendor/autoload.php';
use Framework\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Models\Presentation\Presentation;
use Models\Entities\BlogPost;

class BlogController extends Controller
{
	
	public function showAction()
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$em = $this->getDoctrine();
		$blogposts = $em->getRepository('Models\Entities\BlogPost')->findBy(array(),array('dateMaj' => 'DESC'));
		
		$myDescription = new Presentation();
		$array = array('profil' => $myDescription->getTwigArray(),
						'title' => 'visit my blog',
						'blogPosts' => $blogposts,
						);
		
		$templateFile = 'myblog_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
		
	}

	public function showDetailAction($id)
	{
		//Set up the twig engine
        $twig = $this->initTwig();
		
		$em = $this->getDoctrine();
		
		$idBlog = 2;
		
		$postEntete = $em->getRepository('Models\Entities\BlogPost')->findBy(
								array('id' => $idBlog));
		$postDetail = $em->getRepository('Models\Entities\PostDetail')->findBy(
								array('blogpost_idblogpost' => $idBlog));
		
		return $this->debugResponse(var_dump($postEntete));
		$myDescription = new Presentation();
		$array = array('profil' => $myDescription->getTwigArray(),
						'title' => 'visit my blog',
						'post' => $postDetail,
						);
		
		$templateFile = 'blog_detail_page.html.twig';
		$this->renderTwig($twig, $templateFile, $array);
		
	}
}