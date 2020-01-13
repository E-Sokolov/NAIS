<?php
class MaintenanceController
{
	function actionIndex()
    {
		User::isAuth();
        User::isAccess(4,1,$_SESSION['uid']);
        $lang = Lang::getLang(4);
		$MaintenanceList = array();
		$MaintenanceList = Maintenance::getData(' * ', ' WHERE date LIKE \'%'.date("Y").'%\' ORDER BY date DESC');
        $statData = Maintenance::stat(' WHERE date LIKE \'%'.date("Y").'%\'');
		$clientTypeList = Calls::getClientTypeList();
		$user = User::getUser( 'WHERE dep = \'ing\' ');
		include HOME.'/views/maintenance/index.php';
		return true;
	}
	function actionAdd()
    {
		User::isAuth();
        User::isAccess(4,0,$_SESSION['uid']);
        $lang = Lang::getLang(4);
		$clientTypeList = Calls::getClientTypeList();
		$user = User::getUser(' WHERE dep =\'ing\' AND pass !=\'fired\' ');
		include HOME.'/views/maintenance/add.php';
		return true;
	}
	function actionAddScript()
    {
		User::isAuth();
        User::isAccess(4,0,$_SESSION['uid']);
        if ($_POST)
        {
            $maintenance = Maintenance::insertData($_POST);
            if($maintenance[0] == '0')
            {
            header("Location: /maintenance");
            }
            else
            {
                 print_r($maintenance);
            }
        }
        else
        {
             header("Location: /maintenance/add");
        }
        return true;
    } 
    function actionEdit($id)
    {
        User::isAuth();
        User::isAccess(4,0,$_SESSION['uid']);
        $lang = Lang::getLang(4);
        $clientTypeList = Calls::getClientTypeList();
        $user = User::getUser(' WHERE dep =\'ing\' AND pass !=\'fired\' ');
        $MaintenanceList = Maintenance::getData(' * ', 'WHERE id='.$id); 
        include HOME.'/views/maintenance/edit.php';
        return true;
    }
    function actionEditScript()
    {
        User::isAuth();
        User::isAccess(4,0,$_SESSION['uid']);
        if ($_POST)
        {
            $maintenance = Maintenance::updateData($_POST);
            if($maintenance[0] == '0')
            {
                 header("Location: /maintenance");
            }
            else
            {
                 print_r($maintenance);
            }
        }
        else
        {
             header("Location: /maintenance/edit/".$_POST['id']);
        }
        return true;
    }
    function actionAutofill($col)
    {
    	User::isAuth();
        User::isAccess(4,1,$_SESSION['uid']);
        $q = ' WHERE '.$col.'  LIKE \'%'.$_GET['q'].'%\'';
        if($col == 'client'){
            $MaintenanceList = Calls::getClientList($col,$q);
        }else{
            $MaintenanceList = Maintenance::getData($col,$q);
        }
        $MaintenanceListFinal = array();
        foreach ($MaintenanceList as $value) 
        {
            $count = 0;
            foreach ($MaintenanceListFinal as $value1) 
            {
                if($value[$col] == $value1[$col])
                {
                    $count++;
                }
            }
            if($count == 0)
            {
                $MaintenanceListFinal[] = $value;
            }
        }
        foreach ($MaintenanceListFinal as $value2) 
        {
            echo $value2[$col]."\n";
        }
        return true;
    }
    function actionDelete($id)
    {
        User::isAuth();
        User::isAccess(4,0,$_SESSION['uid']);
        $MaintenanceList = Maintenance::delete($id);
        header("Location: /maintenance");
        return true;
    }
    function actionFilter()
    {
        User::isAuth();
        User::isAccess(4,1,$_SESSION['uid']);
        $lang = Lang::getLang(4);
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
            if($key == 'date' AND $value != '')
            {
                $date = explode("//", $value);
                $date1 = date("Y-m-d",strtotime($date[0]));
                $date2 = date("Y-m-d",strtotime($date[1]));
                $where .= ' date BETWEEN \''.$date1.'\' AND \''.$date2.'\''; 
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
        $MaintenanceList = Maintenance::getData(' * ', $where.'ORDER BY date DESC');
        $statData = Maintenance::stat($whereStat);
        $clientTypeList = Calls::getClientTypeList();
        $user = User::getUser(' WHERE dep =\'ing\' ');
        include HOME.'/views/maintenance/index.php';
        return true;
    }
    function actionExport()
    {
         User::isAuth();
         User::isAccess(4,1,$_SESSION['uid']);
         $lang = Lang::getLang(4);
         if($_POST)
         {
            $fdate = $_POST['first-date'];
            $ldate = $_POST['last-date'];
            $ExcelFile = Export::maintenanceExportGenerate();
            header("Location: /views/export/maintenance.xls");
        }
        else
        {
         include_once HOME.'/views/maintenance/export.php';}
         return true;
     }
 }