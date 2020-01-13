<?php
class profileController
{
	function actionIndex()
	{
		User::isAuth();
		User::isAccess(5,1,$_SESSION['uid']);
		$profileListAdm = User::getuser(' WHERE dep=\'adm\' AND pass !=\'fired\'');
		$profileListInf = User::getuser(' WHERE dep=\'inf\' AND pass !=\'fired\'');
		$profileListEcp = User::getuser(' WHERE dep=\'ecp\' AND pass !=\'fired\'');
		$profileListIng = User::getuser(' WHERE dep=\'ing\' AND pass !=\'fired\'');
		$birthday['day'] = User::birthday('%-m-d');
		$birthday['month'] = User::birthday('%-m-%');
		$lang = Lang::getLang(6);
		include HOME.'/views/profile/index.php';
		return true;
	}
	function actionUser($id)
	{
		User::isAuth();
		User::isAccess(5,1,$_SESSION['uid']);
		$lang = Lang::getLang(6);
		$user = User::getUserById($id);
		include HOME.'/views/profile/user.php';
		return true;
	}
	function actionAdd()
	{
		User::isAuth();
		User::isAccess(5,0,$_SESSION['uid']);
		$lang = Lang::getLang(6);
		include HOME.'/views/profile/add.php';
		return true;
	}
	function actionAddScript()
	{
		User::isAuth();
		User::isAccess(5,0,$_SESSION['uid']);
		$lang = Lang::getLang(6);
		if ($_POST)
		{
             $user = User::addUser($_POST);
             if($user[0] == '0')
             {
                 header("Location: /profile");
             }
             else
             {
                  print_r($user);
             }
         }
         else
         {
             header("Location: /profile/add");
         }
		return true;
	}
	function actionEdit($id)
	{
		User::isAuth();
		User::isAccess(5,0,$_SESSION['uid']);
		$user = User::getUserById($id);
		$lang = Lang::getLang(6);
		include HOME.'/views/profile/edit.php';
		return true;
	}
	function actionEditScript()
	{
		User::isAuth();
		User::isAccess(5,0,$_SESSION['uid']);
		$lang = Lang::getLang(6);
		if ($_POST)
		{
             $user = User::editUser($_POST);
             if($user[0] == '0')
             {
                 header("Location: /profile");
             }
             else
             {
                  print_r($user);
             }
         }
         else
         {
             header("Location: /profile/edit/".$id);
         }
		return true;
	}

}
?>