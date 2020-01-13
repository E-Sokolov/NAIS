<?php
class GauthController
{
	function actionIndex()
	{	
		 User::isAuth();
         User::isAccess(6,1,$_SESSION['uid']);
         $lang = Lang::getLang(0);
         $user = User::getUser( 'WHERE dep = \'ing\' ');
         $Gautharr = Gauth::getData();
		include_once HOME.'/views/gauth/index.php';
		return true;
	}
	function actionAdd(){
		User::isAuth();
		User::isAccess(6,0,$_SESSION['uid']);
		$lang = Lang::getLang(0);
		$user = User::getUser( 'WHERE dep = \'ing\' AND pass != \'fired\' ');
		include_once HOME.'/views/gauth/add.php';
		return true;
	}
	function actionEdit($id){
		User::isAuth();
		User::isAccess(6,0,$_SESSION['uid']);
		$lang = Lang::getLang(0);
		$user = User::getUser( 'WHERE dep = \'ing\' AND pass != \'fired\' ');
		$gauthArr = Gauth::getData(' WHERE id='.$id);
		include_once HOME.'/views/gauth/edit.php';
		return true;
	}
	function actionAddScript()
	{
		User::isAuth();
        User::isAccess(6,0,$_SESSION['uid']);
        if ($_POST)
        {
            $gauth = Gauth::insertData($_POST);
            if($gauth[0] == '0')
            {
            	header("Location: /gauth");
            }
            else
            {
                 print_r($gauth);
            }
        }
        else
        {
             header("Location: /gauth/add");
        }
        return true;
	}
	function actionEditScript()
	{
		User::isAuth();
        User::isAccess(6,0,$_SESSION['uid']);
        if ($_POST)
        {
            $gauth = Gauth::updateData($_POST);
            if($gauth[0] == '0')
            {
            	header("Location: /gauth");
            }
            else
            {
                 print_r($gauth);
            }
        }
        else
        {
             header("Location: /gauth/edit/".$_POST['id']);
        }
        return true;
	}
	function actionDelete($id){
	    User::isAuth();
        User::isAccess(6,0,$_SESSION['uid']);
        $gauth = Gauth::delete($id);
        header("Location: /gauth");
        return true;	
	}
	function actionFilter()
	{
        User::isAuth();
        User::isAccess(6,1,$_SESSION['uid']);
        $lang = Lang::getLang(0);
        $MaintenanceList = array();
        $data = $_POST;
        $where = '';
        foreach($data as $key => $value)
        {
            if($where == ''  AND $value != '')
            {
                $where .=' WHERE';
            }
            else
            {
                if($value != '')
                {
                    $where .=' AND';
                }
            }
            if($key == 'date1' AND $value != '')
            {
                $date = explode("//", $value);
                $date1 = date("Y-m-d",strtotime($date[0]));
                $date2 = date("Y-m-d",strtotime($date[1]));
                $where .= ' date1 BETWEEN \''.$date1.'\' AND \''.$date2.'\''; 
            }
            else
            {
                if($value != '')
                {
                    if(is_numeric($value) == true)
                    {
                            $where .= ' '.$key.' = \''.$value.'\'';
                    }
                    else
                    {  
                        if(substr_count($value,',') > 2){
                            $valuearr = explode(',',$value);
                            $c = 0;
                            foreach ($valuearr as $valuearr) {
                                if($c != 0){ $where .= ' OR ';} else { $where .= ' (';}
                                $where .= ' '.$key.' = \''.$valuearr.'\'';
                                $c++;
                            }
                            $where .= ')';
                        }else{
                            $where .= ' '.$key.' LIKE \'%'.$value.'%\'';
                        }
                    }
                }
            }
        $whereStat = $where;
        }
        //echo $where;
        $Gautharr = Gauth::getData($where.' ORDER BY date1 DESC');
        $clientTypeList = Calls::getClientTypeList();
        $user = User::getUser(' WHERE dep =\'ing\' ');
        include HOME.'/views/gauth/index.php';
		return true;
	}
	function actionAutofill($col)
	{
		User::isAuth();
		User::isAccess(6,1,$_SESSION['uid']);
        $q = ' WHERE '.$col.'  LIKE \'%'.$_GET['q'].'%\'';
        if($col == 'client'){
            $GauthList = Calls::getClientList($col,$q);
        }else{
            $GauthList = Gauth::getData($q);
        }
        $GauthListFinal = array();
        foreach ($GauthList as $value) 
        {
            $count = 0;
            foreach ($GauthListFinal as $value1) 
            {
                if($value[$col] == $value1[$col])
                {
                    $count++;
                }
            }
            if($count == 0)
            {
                $GauthListFinal[] = $value;
            }
        }
        foreach ($GauthListFinal as $value2) 
        {
            echo $value2[$col]."\n";
        }
        return true;
	}
}
?>