<?php
function __autoload($class_name)
{
	// Class Dirs 
	$array_paths = array(
			'/models/',
			'/core/',
			'/controllers/',
	);
	

	foreach ($array_paths as $path) {
		
		// Form path of files 
		$path = HOME . $path . $class_name . '.php';
		
		// include file
		if (is_file($path)) {
			include_once $path;
		}
	}
}