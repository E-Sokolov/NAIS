<?php
class SiteController 
{
	function actionIndex()
	{
		User::isAuth();
		$lang = Lang::getLang(5);
		include HOME.'/views/site/index.php';
		return true;
	}
}