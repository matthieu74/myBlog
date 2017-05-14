<?php
namespace Models\Service;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class PresentationService
{
	
	private $presentation;
    public function __construct()
    {
		$this->presentation = Yaml::parse(file_get_contents(__DIR__."/Config/presentation.yml"));
    }

    /**
     * @return string
     */
    private function getName()
    {
		if (array_key_exists('name', $this->presentation))
		{
        	return $this->presentation['name'];
		}
		else
		{
			return 'John Doe';
		}
    }

    /**
     * @return string
     */
    private function getDescription()
    {
		if (array_key_exists('description', $this->presentation))
		{
        	return $this->presentation['description'];
		}
		else
		{
			return 'Web Developer - Graphic Artist - User Experience Designer';
		}
    }
	
	private function getPicture()
	{
		if (array_key_exists('picture', $this->presentation))
		{
			return $this->presentation['picture'];
		}
		else
		{
			return 'profile.png';
		}
	}
	public function getTwigArray()
	{
		return array(
							'name' => $this->getName(),
							'description' => $this->getDescription(),
							'facebook' => $this->getSocialNetwork('faceBook'),
							'googlePlus' => $this->getSocialNetwork('googlePlus'),
							'twitter' => $this->getSocialNetwork('twitter'),
							'linkedin' => $this->getSocialNetwork('linkedin'),
							'dribbble' => $this->getSocialNetwork('dribbble'),
							'github' => $this->getSocialNetwork('github'),
							'picure' => $this->getPicture(),
							);
	}
	
	private function getSocialNetwork($socialNetwork)
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