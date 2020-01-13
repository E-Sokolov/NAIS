<?php
 class CallsController
 {
     function actionIndex()
     {
         User::isAuth();
         User::isAccess(0,1,$_SESSION['uid']);
         $lang = Lang::getLang(0);
         $statData = array();
         $statData = Calls::statCall( ' ' );
         $callsList = array();
         $callsList = Calls::getCallsList('*','WHERE date LIKE \'%'.date("Y").'%\' ORDER BY date DESC, time DESC ');
         $clientTypeList = Calls::getClientTypeList();
         $resource = Calls::getResource();
         $user = User::getUser('WHERE dep = \'ing\' ');
         include_once HOME.'/views/calls/index.php';
         return true;
     }
     function actionExport()
     {
         User::isAuth();
         User::isAccess(0,1,$_SESSION['uid']);
         $lang = Lang::getLang(0);
         if($_POST)
         {
            $fdate = $_POST['first-date'];
            $ldate = $_POST['last-date'];
            $ExcelFile = Export::ExcelCallsGenerate();
            header("Location: /views/export/calls.xls");
        }
        else
        {
         include_once HOME.'/views/calls/export.php';
        }
         return true;
     }
     function actionAddCall($copy = null)
     {
        User::isAuth();
        User::isAccess(0,0,$_SESSION['uid']);
        if($copy != null)
        {
            $call = Calls::getCallsList(' * ',' WHERE id=\''.$copy.'\'');
        }
        $lang = Lang::getLang(0);
         $clientTypeList = array();
         $clientTypeList = Calls::getClientTypeList();
         $resource = array();
         $resource = Calls::getResource();
         $user = array();
         $user = User::getUser('WHERE dep = \'ing\'');
         include_once HOME.'/views/calls/addCall.php';
        return true;
     }
     function actionAddCallScript()
     {
        User::isAuth();
        User::isAccess(0,0,$_SESSION['uid']);
         if ($_POST)
         {
             $call = Calls::insertCall($_POST);
             if($call[0] == '0'){
                 header("Location: /calls");
             }
             else
             {
                  print_r($call);
             }
         }
         else
         {
             header("Location: /calls/add");
         }
         //include_once HOME.'/views/calls/addCallScript.php';
         return true;
     }
     function actionEdit($id)
     {
         User::isAuth();
         User::isAccess(0,0,$_SESSION['uid']);
         $lang = Lang::getLang(0);
         $call = array();
         $call = Calls::getCallsList(' * ',' WHERE id=\''.$id.'\'');
         //print_r($call[0]);
         $clientTypeList = array();
         $clientTypeList = Calls::getClientTypeList();
         $user = array();
         $user = User::getUser('WHERE dep = \'ing\' ');
         $resource = array();
         $resource = Calls::getResource();
         //print_r($descriptionList);
         include_once HOME.'/views/calls/editCall.php';
         return true;
     }
    function actionEditCallScript()
    {
        User::isAuth();
        User::isAccess(0,0,$_SESSION['uid']);
        if($_POST)
        {
            $call = Calls::editCall($_POST);
            if($call[0] == '0')
            {
                header("Location: /calls");
             }
             else
             {
                 print_r($call);
            }  
         }
         else
         {
          header("Location: /calls/edit");
        }
         //include_once HOME.'/views/calls/editCallScript.php';
        return true;
    }
    function actionFilter()
    {
        User::isAccess(0,1,$_SESSION['uid']);
        User::isAuth();
        $lang = Lang::getLang(0);
        $data = $_POST;
        //print_r($data);
        $where ='';
        $i=0;
        $date = $data['date'];
        foreach($data as $key => $value)
        {
            //echo $key.' => '.$value.' <br>';
            if($where == '' AND $value != '')
            {
                $where .=' WHERE';
            }
            else
            {
                if($value != '' AND $key !='date')
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
                        $where .= ' '.$key.' LIKE \'%'.$value.'%\'';
                    }
                }
            }
        }
        $whereStat = $where;
            
        $callsList = array();
        $callsList = Calls::getCallsList(' * ',$where);
        $statData = Calls::statCall($whereStat);
        $clientTypeList = Calls::getClientTypeList();
        $resource = Calls::getResource();
        $user = User::getUser('WHERE dep = \'ing\' ');
        include_once HOME.'/views/calls/index.php';
        return true;
    }
    function actionAutofill($col)
    {
        User::isAuth();
        $q = ' WHERE '.$col.'  LIKE \'%'.$_GET['q'].'%\'';
        //echo $q;
        if($col == 'client')
        {
            $callsList = Calls::getClientList($col,$q);
        }
        else
        {
            $callsList = Calls::getCallsList($col, $q);
        }
        //print_r($callsList);
        $callsListFinal = array();
        foreach ($callsList as $value) 
        {
            $count = 0;
            foreach ($callsListFinal as $value1) 
            {
                if($value[$col] == $value1[$col])
                {
                    $count++;
                }
            }
            if($count == 0)
            {
                $callsListFinal[] = $value;
            }
        }
        foreach ($callsListFinal as $value2) 
        {
            echo $value2[$col]."\r\n";
        }
        return true;
    }
    function actionDelete($id)
    {
        User::isAuth();
        User::isAccess(0,0,$_SESSION['uid']);
        $errors = Calls::Delete($id);
        if($errors[0] == '0')
            {
                header("Location: /calls");
             }
             else
             {
                 print_r($call);
            } 
        return true;
    }
 }
