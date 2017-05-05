<?php
namespace Models\Service;


class BlogPostService
{
	public function getAllPosts($em)
	{
		$query = $em->createQuery('SELECT b.id,b.title, b.dateUpdate, b.chapo FROM Models\Entities\blogpost b order by b.dateUpdate desc');
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
		$post->setDateUpdate(new \DateTime());
			
		$em->persist($post);
		$em->flush();
	}
	
	public function deletePost($em,$post)
	{
		// save the contact into database
		
		$em->remove($post);
		$em->flush();
	}
	
	
}