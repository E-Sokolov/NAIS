<?php
class MailController
{
	function actionIndex()
  {
    User::isAuth();
		$mailtypeList = array();
		$mailTypeList = Mail::getMailTypeList();
    User::isAccess(2,1,$_SESSION['uid']);
    $lang = Lang::getLang(2);
		include_once HOME.'/views/mail/index.php';
		return true;
	}
	function actionType($id)
  {
    User::isAuth();
    User::isAccess(2,1,$_SESSION['uid']);
    $lang = Lang::getLang(2);
    $mailStat = array();
    $mailStat = Mail::statMail($id);
		$mailTypeList = array();
		$mailTypeList = Mail::getMailTypeList();
		$mailList = array();
		$mailList = Mail::getMailByType($id);
    //print_r($mailList);
		include HOME.'/views/mail/type.php';
		return true;
	}
	function actionAdd()
  {
    User::isAuth();
		$mailTypeList = array();
		$mailTypeList = Mail::getMailTypeList(); 
    User::isAccess(2,0,$_SESSION['uid']);
    $lang = Lang::getLang(2);
		include HOME.'/views/mail/add.php';
		return true;
	}
	function actionAddScript()
  {
    User::isAuth();
    User::isAccess(2,0,$_SESSION['uid']);
			if ($_POST)
      {
             	$mail = Mail::insertMail($_POST);
            if($mail[0] == '0')
            {
                 header("Location: /mail");
            }
            else
            {
                  print_r($mail);
            }
         }
         else
         {
             header("Location: /mail/add");
         }
			return true;
		}
		function actionEdit($id)
    {
      User::isAuth();
      User::isAccess(2,0,$_SESSION['uid']);
      $lang = Lang::getLang(2);
			$mailTypeList = array();
			$mailTypeList = Mail::getMailTypeList();
			$mail = array();
			$mail = Mail::getMailById($id); 
			include HOME.'/views/mail/edit.php';
			return true;
		}
		function actionEditScript()
    {
        User::isAuth();
        User::isAccess(2,0,$_SESSION['uid']);
        if($_POST)
        {
            $mail = Mail::editMail($_POST);
            if($mail[0] == '0')
            {
                header("Location: /mail");
             }
             else
             {
                 print_r($mail);
            }  
         }
         else
         {
          header("Location: /mail/edit");
         }
        return true;
    }
    function actionFilter()
    {
      User::isAuth();
      User::isAccess(2,1,$_SESSION['uid']);
      $lang = Lang::getLang(2);
      $data = $_POST;
      $date1 = $data['date1'];
      $date2 = $data['date2'];
      unset($data['date1'],$data['date2']);
      $where ='';
      $i=0;
      foreach($data as $key => $value)
      {
            if($where == '' AND $value != '')
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
        if($date1 == '0')
        {
            $where .= ' ORDER BY date1 ASC'; 
        }
        else
        {
            $where .= ' ORDER BY date1 DESC';
        }
        if($date1 != '' AND $date2 == '0')
        {
            $where .= ' , date2 ASC';
        }
        else
        {
            $where .= ' , date2 DESC';
        }
        //echo $where;
        $mailList = array();
        $mailList = Mail::getMailByFilter($where);
        $mailTypeList = Mail::getMailTypeList();
        include_once HOME.'/views/mail/type.php';
        return true;
    }
    function actionExport()
    {
      User::isAuth();
      User::isAccess(2,1,$_SESSION['uid']);
      $lang = Lang::getLang(2);
      $MailTypeList = Mail::getMailTypeList();
      if($_POST)
      {
          $id = $_POST['id'];
          $ExcelFile = Export::MailExportGenerate($id);
      }
      include_once HOME.'/views/mail/export.php';
      return true;
    }
    function actionDelete($id)
    {
      User::isAuth();
      User::isAccess(2,0,$_SESSION['uid']);
      $errors = Mail::deleteMail($id);
      if($errors[0] == '0')
      {
          header("Location: /mail");
      }
      else
      {
        print_r($errors);
      }
    }
    function actionMerge()
    {
        $mail = Mail::merge();
        print_r($mail);
    }
    function actionAutofill($col)
    {
      User::isAuth();
      User::isAccess(2,1,$_SESSION['uid']);
      $q = ' WHERE '.$col.'  LIKE \'%'.$_GET['q'].'%\'';
      if($col == 'client')
      {
          $mailList = Calls::getClientList($col,$q);
      }
      else
      {
          $mailList = Mail::getMailByFilter($q);
      }
      $mailListFinal = array();
      foreach ($mailList as $value) 
      {
        $count = 0;
          foreach ($mailListFinal as $value1) 
          {
                if($value[$col] == $value1[$col])
                {
                    $count++;
                }
          }
          if($count == 0)
          {
                $mailListFinal[] = $value;
          }
        }
        foreach ($mailListFinal as $value2) 
        {
            echo $value2[$col]."\n";
        }
        return true;
    }
    function actionAddNote($mailId)
    {
      User::isAuth();
      User::isAccess(2,0,$_SESSION['uid']);
      $noteArr = Mail::addNote($mailId,$_POST['note']);
      if($noteArr[0] == 0)
      {
        $mailArr = Mail::getMailById($mailId);
        header("Location: /mail/type/".$mailArr[0]['orgtype']."#mailid".$mailId);
      }
      else
      {
        print_r($noteArr);
      }
      return true;
    }
    function actionDeleteNote($note)
    {
      User::isAuth();
      User::isAccess(2,0,$_SESSION['id']);
      $noteArr = Mail::getNoteById($note);
      $errors = Mail::deleteNote($note);
      if($errors[0] == 0)
      {
        $mailArr = Mail::getMailById($noteArr[0]['mail_id']);
        header("Location: /mail/type/".$mailArr[0]['orgtype']."#mailid".$mailArr[0]['id']);
      }
      else
      {
        print_r($errors);
      } 
      return true;
    }
}
?>
