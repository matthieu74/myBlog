<?php
namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;
use Framework\Config\Routes;


class App
{
    static public function run() 
	{
		
		$request = Request::createFromGlobals();
        $route = self::getRoute();
        list($controllerClass,$actionMethod) = explode("::",$route["_controller"]);
		
        $controllerClass = "\Controllers\\".$controllerClass;
		
        $controller = new $controllerClass(Request::createFromGlobals(), self::loadConfig(), array_pop($route));
		
		array_shift($route); //supp the first element of the route array
        call_user_func_array(array($controller,$actionMethod), $route);
    }
	
	static private function loadConfig()
    {
        $config = Yaml::parse(file_get_contents(__DIR__."/config/Config.yml"));
        return $config;
    }
	
    static private function getRoute()
    {
        $request = Request::createFromGlobals();
        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $locator = new FileLocator(array(__DIR__."/config"));
        $router = new Routing\Router(
            new Routing\Loader\YamlFileLoader($locator),
            'Routes.yml',
            array(),
            $context
        );
        return $router->match($request->getPathInfo());
    }
}