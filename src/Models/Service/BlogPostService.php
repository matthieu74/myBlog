<?php
namespace Models\Service;


class BlogPostService
{
	public function getAllPosts($em)
	{
        $query = $em->createQueryBuilder();
        $query->select(array('b.id','b.title', 'b.dateUpdate', 'b.chapo'))
            ->from('Models\Entities\blogpost', 'b')
            ->orderBy('b.dateUpdate', 'DESC')
             ->setMaxResults(5);
		
		return $query->getQuery()->getResult();
	}
    
    public function getAllBy5Posts($em,$offset)
    {
		 $query = $em->createQueryBuilder();
        $query->select(array('b.id','b.title', 'b.dateUpdate', 'b.chapo'))
            ->from('Models\Entities\blogpost', 'b')
            ->orderBy('b.dateUpdate', 'DESC')
            ->setMaxResults(5)
            ->setFirstResult($offset);
		return $query->getQuery()->getResult();
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