<?php
/**
 * Created by PhpStorm.
 * User: perom
 * Date: 22/04/2017
 * Time: 14:13
 */
namespace Models\Presentation;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class Presentation
{
	
	private $presentation;
    public function __construct()
    {
		$this->presentation = Yaml::parse(file_get_contents(__DIR__."/presentation.yml"));
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->presentation['name'];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->presentation['description'];
    }
	
	public function getTwigArray()
	{
		return array(
							'name' => $this->getNom(),
							'description' => $this->getDescription(),
							'facebook' => $this->socialNetwork('faceBook'),
							'googlePlus' => $this->socialNetwork('googlePlus'),
							'twitter' => $this->socialNetwork('twitter'),
							'linkedin' => $this->socialNetwork('linkedin'),
							'dribbble' => $this->socialNetwork('dribbble'),
							'github' => $this->socialNetwork('github'),
							);
	}
	
	private function socialNetwork($socialNetwork)
	{
		if (array_key_exists($socialNetwork, $this->presentation))
		{
			return $this->presentation[$socialNetwork];
		}
		else
		{
			return null;
		}
	}
}