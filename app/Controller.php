<?php
namespace Framework;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Controller
{
	
	private $twig;
    private $doctrine;
    private $request;
    private $routeName;
	private $assetPath;
    public function __construct($request, $config, $routeName)
    {
        $this->request = $request;
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../src/views');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'host'     => $config["doctrine"]["host"],
            'user'     => $config["doctrine"]["user"],
            'password' => $config["doctrine"]["password"],
            'dbname'   => $config["doctrine"]["dbname"],
        );
        $configDoctrine = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/models/entities"), true);
        $this->doctrine = EntityManager::create($dbParams, $configDoctrine);
		
		$this->assetPath = $config["asset"];
    }
    protected function getRequest()
    {
        return $this->request;
    }
    protected function getDoctrine()
    {
        return $this->doctrine;
    }
    
    protected function getAssetPath()
    {
        return $this->assetPath;
    }
	
    //Twig template engine initialization function
	protected function initTwig()
	{
		$twig_bridge_dir = realpath(__DIR__ . '/../vendor/twig-bridge/Resources/views/Form');
		$loader = new \Twig_Loader_Filesystem(array(
            realpath(__DIR__ . '/../src/views'),
            $twig_bridge_dir,
        ));
		$twig = new \Twig_Environment($loader, array('debug' => true));
							$twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
							// implement whatever logic you need to determine the asset path
							return sprintf($this->assetPath . '/%s', ltrim($asset, '/'));
					}));

		return $twig;
	}
	
	//useful for twig template rendering
	protected function renderTwig($twig, $templateFile, $array)
	{
		$template = $twig->loadTemplate($templateFile);
        $response = new Response(($template->render($array)));
		$response->send();
	}
	
	//useful for debug
	protected function debugResponse($msg)
	{
		$response = new Response($msg);
		$response->send();
	}
}