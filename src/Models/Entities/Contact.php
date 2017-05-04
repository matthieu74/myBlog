<?php

namespace Models\Entities;

/**
 * @Entity 
 * @Table(name="contact")
 **/
class Contact
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
    protected $name;
	
	/**
     * @var string
     * @Column(type="string")
     */
    protected $emailAddress;
	
	/**
     * @var string
     * @Column(type="string")
     */
    protected $message;
	
	
    /**
     * @return emailAddress
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
    /**
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
	
	public function getSecureData()
	{
		$this->name = htmlspecialchars($this->name);
		$this->message = htmlspecialchars($this->message);
		$this->emailAddress = str_replace(array("\n","\r",PHP_EOL),'',$this->emailAddress);
	}
}