<?php
class KnowController
{
	function actionIndex()
	{
	    User::isAuth();
	    User::isAccess(3,1,$_SESSION['uid']);
	    $lang = Lang::getLang(1);
		$resource = array();
		$resource = Know::getResources(); 
		include HOME.'/views/know/index.php';
		return true;
	}
	function actionResource($resource)
	{
	    User::isAuth();
	    User::isAccess(3,1,$_SESSION['uid']);
	    $lang = Lang::getLang(1);
		$imgbig = array();
		$knows = array();
		$knows = Know::getKnowsByResource($resource);
		$imgbig = Know::getKnowsByResource($resource);
		include HOME.'/views/know/resource.php';
		return true;
	}
	function actionSee($id)
	{
	    User::isAuth();
	    User::isAccess(3,1,$_SESSION['uid']);
	    $lang = Lang::getLang(3);
		$knows = array();
		$knows = Know::getKnowsById($id);
		include HOME.'/views/know/see.php';
		return true;
	}

	function actionAdd()
	{
	    User::isAuth();
	    User::isAccess(3,0,$_SESSION['uid']);
	    $lang = Lang::getLang(3);
		$resource = Know::getResources(); 
		include HOME.'/views/know/add.php';
		return true;
	}
	function actionAddScript()
	{
	    User::isAuth();
	    User::isAccess(3,0,$_SESSION['uid']);
		if ($_POST){
             $know = Know::insertKnow($_POST);
            if($know[0] == '0'){
                 echo "<script> history.go('-2'); </script>";
            }else{
                  print_r($know);
            }
         }else{
             header("Location: /know/add");
         }
		return true;
	}
	function actionEdit($id)
	{
		User::isAuth();
		User::isAccess(3,0,$_SESSION['uid']);
		$lang = Lang::getLang(3);
		$resource = Know::getResources();
		$know = Know::getKnowsById($id); 
		$ex = explode('/',$know['zip']);
		$substr = substr($ex[4],10);
		$zip = $substr;
		include HOME.'/views/know/edit.php';
		return true;
	}
	function actionEditScript()
	{
	    User::isAuth();
	    User::isAccess(3,0,$_SESSION['uid']);
		if ($_POST)
		{
             $know = Know::updateKnow($_POST);
            if($know[0] == '0')
            {
                 echo "<script> history.go('-2'); </script>";
            }
            else
            {
                 print_r($know);
            }
         }
         else
         {
             header("Location: /know/edit");
         }
		return true;
	}
	function actionFilter()
	{
		User::isAuth();
	    User::isAccess(3,1,$_SESSION['uid']);
	    $lang = Lang::getLang(3);
	    $imgbig = array();
		$knows = array();
		$imgbig = Know::getKnowByFilter($_POST);
		$knows = Know::getKnowByFilter($_POST);
		include HOME.'/views/know/resource.php';
		return true;
	}
}
?>