<?php

namespace Models\Entities;

/**
 * Created by PhpStorm.
 * User: perom
 * Date: 22/04/2017
 * Time: 15:26
 */

/**
 * @Entity 
 * @Table(name="PostDetail")
 **/
class PostDetail 
{
	/**
     * @var int
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
	
	
	/**
     * @var int
     * @Column(type="integer")
     */
	private $blogpost_idblogpost;
	
	
	/**
     * @var string
     * @Column(type="string")
     */
	private $author;
	
	/**
     * @var string
     * @Column(type="string")
     */
    protected $textPost;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getPost()
	{
		return $this->post;
	}
	
	public function getAuthor()
	{
		return $this->author;
	}
	
	public function getTextPost()
	{
		return $this->textPost;
	}
}
