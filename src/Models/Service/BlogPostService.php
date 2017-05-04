<?php
namespace Models\Service;


class BlogPostService
{
	public function getAllPosts($em)
	{
		$query = $em->createQuery('SELECT b.id,b.title, b.dateMaj, b.chapo FROM Models\Entities\blogpost b order by b.dateMaj desc');
		return $query->getResult();
		
	}
	
	public function getPostDetail($em,$idBlog)
	{
		return $em->getRepository('Models\Entities\BlogPost')->findOneBy(
								array('id' => $idBlog));
	}
	
	public function savePost($em,$post)
	{
		// save the contact into database
		$post->getSecureData();
		$post->setDateMaj(new \DateTime());
			
		$em->persist($post);
		$em->flush();
	}
}