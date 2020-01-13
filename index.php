<?php

// view errors
ini_set('error_reporting', '1');
error_reporting(E_ALL,E_NOTICE);
//error_reporting(E_ALL);
// home folder link 
define('HOME', dirname(__FILE__));

//include autoload scripts from 'core'
include HOME.'/core/autoload.php';
$router = new router();
echo $router -> run();

?>
