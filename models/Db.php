<?php
class Db
{
    public static function getConnect($dbname)
    {
    	//$dbname = strtolower($dbname);
    	//echo $dbname;
        $paramsPath = HOME . '/core/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$dbname}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        //print_r($db -> errorInfo());
        $db->exec("set names utf8");
        
        return $db;
    }
}
?>