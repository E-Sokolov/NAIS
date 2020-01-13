<?php

class router
{
	private $routes;
	
	function __construct()
	{
		$this -> routes = include HOME.'/core/routes.php';
	}
	
	// get route from URL
	function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) 
		{
			$uri = $_SERVER['REQUEST_URI'];
			$uri = trim($uri,'/');
			return $uri;
		}
	}
	// include file & run controller 
	function run()
	{

		$uri = $this->getURI();
	

		foreach ($this -> routes as $pattern => $value)
		{
		
			// --  compare route pattern with uri
			if(preg_match("~$pattern~",$uri))
			{
				
				// -- get array with parametres 
			    $intRoute = preg_replace("~$pattern~", $value, $uri);
				$route = explode('/', $intRoute);
				$controllerName = ucfirst(array_shift($route)).'Controller';
				
				$actionName = 'action'. ucfirst(array_shift($route));
				$controllerFile = HOME.'/controllers/'.$controllerName.'.php';
			    $parameters = $route;
				//  --- include controllerFile if exist
				if(file_exists($controllerFile))
				{
					include_once ($controllerFile);
				}
				// -- get controller object 
				$controllerObj = new $controllerName;
				// -- init controller
				$result = call_user_func_array(array($controllerObj, $actionName), $parameters);
				
				// -- exit if success 
				
				if($result != false)
				{
					break;
				}
			}
			
		}
	}
}