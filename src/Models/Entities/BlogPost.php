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
 * @Table(name="BlogPost")
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
	

	public function getDataSecurisee()
	{
		$this->name = htmlspecialchars($this->name);
		$this->message = htmlspecialchars($this->message);
		$this->emailAddress = str_replace(array("\n","\r",PHP_EOL),'',$this->emailAddress);
	}
}


