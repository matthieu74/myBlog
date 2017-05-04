<?php

namespace Models\Entities;

/**
 * @Entity 
 * @Table(name="blogpost")
 **/
class BlogPost
{
	
	/**
     * @var int
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

	/**
     * @var string
     * @Column(type="string")
     */
    protected $title;
	
	/**
     * @var datetime
     * @Column(type="datetime")
     */
    protected $dateMaj;
	
	/**
     * @var string
     * @Column(type="string")
     */
    protected $chapo;
	
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
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getDateMaj()
	{
		return $this->dateMaj;
	}
	
	public function getChapo()
	{
		return $this->chapo;
	}
	
	public function getAuthor()
	{
		return $this->author;
	}
	
	public function getTextPost()
	{
		return $this->textPost;
	}
	
	public function setTitle($t)
	{
		$this->title  =$t;
	}
	
	public function setDateMaj($d)
	{
		$this->dateMaj = $d;
	}
	
	public function setChapo($c)
	{
		$this->chapo = $c;
	}
	
	public function setAuthor($a)
	{
		 $this->author = $a;
	}
	
	public function setTextPost($t)
	{
		$this->textPost = $t;
	}

	public function getSecureData()
	{
		$this->title = htmlspecialchars($this->title);
		$this->chapo = htmlspecialchars($this->chapo);
		$this->author = htmlspecialchars($this->author);
		$this->textPost = htmlspecialchars($this->textPost);
	}
}


