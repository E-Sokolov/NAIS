<?php
class Mail
{
	function getMailTypeList()
    {
        $Db = Db::getConnect('glb');
        $mailTypeList = array();
        $q = 'SELECT * FROM mail_type';
        //print_r($q);
        $result = $Db -> query($q);
        $i=0;
        while($row = $result -> fetch())
        {
            $mailTypeList[$i]['id'] = $row['id'];
            $mailTypeList[$i]['alias'] = $row['alias'];
            $mailTypeList[$i]['fullname'] = $row['fullname'];
            $i++;
        }
        return $mailTypeList;
    }
    function getMailByType($id)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $mailList = array();
        $noteList = array();
        $q = 'SELECT id,client,fio,email,status,email_type,erk,date1,date2,coment1,coment2,orgtype,position,nid,date,note FROM mail LEFT JOIN mail_notes ON mail.id = mail_notes.mail_id WHERE orgtype=\''.$id.'\' ORDER BY mail.id, date DESC, nid DESC';
        //$q = 'SELECT * FROM mail  WHERE orgtype=\''.$id.'\'';
        $result = $Db -> query($q);
        $i = 0;
        $k = 0;
        while($row = $result -> fetch())
        {   
            if($row['id'] == $mailList[$i-1]['id'])
            {   
                $mailList[$i-1]['notes'][$k]['nid'] = $row['nid'];
                $mailList[$i-1]['notes'][$k]['date'] = date("d.m.Y", strtotime($row['date']));
                $mailList[$i-1]['notes'][$k]['note'] = $row['note'];
                $k++;
            }
            else
            {   
                $k = 0;
                $mailList[$i]['id'] = $row['id'];
                $mailList[$i]['client'] = $row['client'];
                $mailList[$i]['fio'] = $row['fio'];
                $mailList[$i]['position'] = $row['position'];
                $mailList[$i]['email'] = $row['email'];
                $mailList[$i]['status'] = $row['status'];
                $mailList[$i]['email_type'] = $row['email_type'];
                $mailList[$i]['erk'] = $row['erk'];
                $mailList[$i]['date1'] = $row['date1'];
                $mailList[$i]['coment1'] = $row['coment1'];
                if($row['date2'] != '0000-00-00')
                {
                  $mailList[$i]['date2'] = date("Y-m-d", strtotime($row['date2']));
                }
                else
                {
                  $mailList[$i]['date2'] = '';
                }
                $mailList[$i]['coment2'] = $row['coment2'];
                $mailList[$i]['orgtype'] = $row['orgtype'];
                $mailList[$i]['note'] = $row['note'];
                $mailList[$i]['notes'][$k]['nid'] = $row['nid'];
                $mailList[$i]['notes'][$k]['date'] = date("d.m.Y", strtotime($row['date']));
                $mailList[$i]['notes'][$k]['note'] = $row['note']; 
                $i++;
                $k++;
            }
        }
        return $mailList;
    }
     function getMailById($id)
     {
        $Db = Db::getConnect($_SESSION['filial']);
        $contractList = array();
        $q = 'SELECT * FROM mail WHERE id=\''.$id.'\'';
        $result = $Db -> query($q);
        $i = 0;
        while($row = $result -> fetch())
        {
            $mailList[$i]['id'] = $row['id'];
            $mailList[$i]['client'] = $row['client'];
            $mailList[$i]['fio'] = $row['fio'];
            $mailList[$i]['position'] = $row['position'];
            $mailList[$i]['email'] = $row['email'];
            $mailList[$i]['status'] = $row['status'];
            $mailList[$i]['email_type'] = $row['email_type'];
            $mailList[$i]['erk'] = $row['erk'];
            $mailList[$i]['date1'] = $row['date1'];
            $mailList[$i]['coment1'] = $row['coment1'];
            if($row['date2'] != '0000-00-00')
            {
       			$mailList[$i]['date2'] = date("Y-m-d", strtotime($row['date2']));
       		}
            else
            {
       			$mailList[$i]['date2'] = '';
       		}
            $mailList[$i]['date2'] = $row['date2'];
            $mailList[$i]['coment2'] = $row['coment2'];
            $mailList[$i]['orgtype'] = $row['orgtype'];
            $i++;
        }
        return $mailList;
    }

    function insertMail($data = array())
    {
    	$client = $data['client'];
    	$fio = $data['fio'];
    	$position = $data['position'];
    	$email = $data['email'];
        $email_type = $data['email_type'];
        if($data['date1'] != '')
        {
       		$date1   = date("Y-m-d", strtotime($data['date1']));
       	}
        else
        {
       		$date1 = '0000-00-00';
       	}
        $coment1 .= $data['coment1'];
        if($data['date2'] != '')
        {
       		$date2   = date("Y-m-d", strtotime($data['date2']));
       	}
        else
        {
       		$date2 = '0000-00-00';
       	}
        $coment2 .= $data['coment2'];
        $type = $data['orgtype'];

       // print_r($data);
        $Db = Db::getConnect($_SESSION['filial']);
        
        $q = "INSERT INTO mail VALUES('',:client, :fio, :email,:status,:email_type,:erk,:date1,:coment1,:date2,:coment2,:orgtype,:position)";
        $result = $Db->prepare($q);
        $result->bindParam(':client', $client, PDO::PARAM_STR);
        $result->bindParam(':fio', $fio, PDO::PARAM_STR);
        $result->bindParam(':position', $position, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':status', $data['status'], PDO::PARAM_STR);
        $result->bindParam(':email_type', $email_type, PDO::PARAM_STR);
        $result->bindParam(':erk', $data['erk'], PDO::PARAM_STR);
        $result->bindParam(':date1', $date1);
        $result->bindParam(':coment1', $coment1, PDO::PARAM_STR);
        $result->bindParam(':date2', $date2);
        $result->bindParam(':coment2', $coment2, PDO::PARAM_STR);
        $result->bindParam(':orgtype', $type, PDO::PARAM_INT);
        $result -> execute();
        return $result -> errorInfo();
    }
    function editMail($data = array())
    {
    	//print_r($data);
    	$id = $data['id'];
    	$client = $data['client'];
    	$fio = $data['fio'];
    	$position = $data['position'];
    	$email = $data['email'];
        $email_type = $data['email_type'];
        if($data['date1'] != '')
        {
       		$date1   = date("Y-m-d", strtotime($data['date1']));
       	}
        else
        {
       		$date1 = '0000-00-00';
       	}
        $coment1 = $data['coment1'];
        if($data['date2'] != '')
        {
       		$date2   = date("Y-m-d", strtotime($data['date2']));
       	}
        else
        {
       		$date2 = '0000-00-00';
       	}
        $coment2 = $data['coment2'];
        $type = $data['orgtype'];;

        $Db = Db::getConnect($_SESSION['filial']);
        
        $q = "UPDATE mail SET client=:client, fio=:fio, email=:email, status=:status, email_type=:email_type, erk=:erk, date1=:date1, coment1=:coment1, date2=:date2, coment2=:coment2,orgtype=:orgtype, position=:position WHERE id=:id";
        $result = $Db->prepare($q);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':client', $client, PDO::PARAM_STR);
        $result->bindParam(':fio', $fio, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':status', $data['status'], PDO::PARAM_STR);
        $result->bindParam(':email_type', $email_type, PDO::PARAM_STR);
        $result->bindParam(':erk', $data['erk'], PDO::PARAM_STR);
        $result->bindParam(':date1', $date1);
        $result->bindParam(':coment1', $coment1, PDO::PARAM_STR);
        $result->bindParam(':date2', $date2);
        $result->bindParam(':coment2', $coment2, PDO::PARAM_STR);
        $result->bindParam(':orgtype', $type, PDO::PARAM_INT);
        $result->bindParam(':position',$position, PDO::PARAM_STR);
        $result -> execute();
        return $result -> errorInfo();
    }
    function getMailByFilter($data)
    {
    	$Db = Db::getConnect($_SESSION['filial']);
        $mailList = array();
        //$q = 'SELECT * FROM mail '.$data;
        $q = 'SELECT id,client,fio,email,status,email_type,erk,date1,date2,coment1,coment2,orgtype,position,nid,date,note FROM mail LEFT JOIN mail_notes ON mail.id = mail_notes.mail_id '.$data;
        //echo $q;
        $result = $Db -> query($q);
        $i = 0;
        
        while($row = $result -> fetch())
        {   
            if($row['id'] == $mailList[$i-1]['id'])
            {   
                $mailList[$i-1]['notes'][$k]['nid'] = $row['nid'];
                $mailList[$i-1]['notes'][$k]['date'] = date("d.m.Y", strtotime($row['date']));
                $mailList[$i-1]['notes'][$k]['note'] = $row['note'];
                $k++;
            }
            else
            {   
                $k = 0;
                $mailList[$i]['id'] = $row['id'];
                $mailList[$i]['client'] = $row['client'];
                $mailList[$i]['fio'] = $row['fio'];
                $mailList[$i]['position'] = $row['position'];
                $mailList[$i]['email'] = $row['email'];
                $mailList[$i]['status'] = $row['status'];
                $mailList[$i]['email_type'] = $row['email_type'];
                $mailList[$i]['erk'] = $row['erk'];
                $mailList[$i]['date1'] = $row['date1'];
                $mailList[$i]['coment1'] = $row['coment1'];
                if($row['date2'] != '0000-00-00')
                {
                  $mailList[$i]['date2'] = date("Y-m-d", strtotime($row['date2']));
                }
                else
                {
                  $mailList[$i]['date2'] = '';
                }
                $mailList[$i]['coment2'] = $row['coment2'];
                $mailList[$i]['orgtype'] = $row['orgtype'];
                $mailList[$i]['note'] = $row['note'];
                $mailList[$i]['notes'][0]['nid'] = $row['nid'];
                $mailList[$i]['notes'][0]['date'] = date("d.m.Y", strtotime($row['date']));;
                $mailList[$i]['notes'][0]['note'] = $row['note']; 
                $i++;
                $k++;
            }
        }
        return $mailList;
    }
    function deleteMail($id)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $error = array();
        $q = 'DELETE FROM mail WHERE id =\''.$id.'\'';
        $qn = 'DELETE FROM mail_notes WHERE mail_id ==\''.$id.'\'';
        $result1 = $Db -> query($qn);
        $result = $Db -> query($q);
        return $result -> errorInfo();
    }
    function statMail($type)
    {
        $obj = new Mail;
        $data = Mail::getMailByType($type);
        $num = count($data);
        return $num;
    }
    function getNotesByMailId($mailId)
    {   
        $note = array();
        $Db = Db::getConnect($_SESSION['filial']);
        $q = 'SELECT * FROM mail_notes WHERE mail_id = \''.$mailId.'\'';
        $result = $Db -> query($q);
        $i = 0;
        while ($row = $result -> fetch())
        {
            $note[$i]['nid'] = $row['nid'];
            $note[$i]['date'] = $row['date'];
            $note[$i]['note'] = $row['note'];
            $i++;
        }
        return $note;
    }
    function addNote($mailId,$note)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $q = "INSERT INTO mail_notes VALUES('', '".date("Y-m-d",time())."', :note, :mailid ) ";
        $result = $Db -> prepare($q);
        $result -> bindParam(':note',$note, PDO::PARAM_STR);
        $result -> bindParam(':mailid',$mailId, PDO::PARAM_INT);
        $result -> execute();
        return $result -> errorInfo();
    }
    function deleteNote($note)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $q = "DELETE FROM mail_notes WHERE nid = '".$note."'";
        $result = $Db -> query($q);
        return $result -> errorInfo();
    }
    function getNoteById($note)
    {
        $noteArr = array();
        $Db = Db::getConnect($_SESSION['filial']);
        $q = 'SELECT * FROM mail_notes WHERE nid = \''.$note.'\'';
        $result = $Db -> query($q);
        $i = 0;
        while ($row = $result -> fetch())
        {
            $noteArr[$i]['nid'] = $row['nid'];
            $noteArr[$i]['date'] = date("d.m.Y", strtotime($row['date']));
            $noteArr[$i]['note'] = $row['note'];
            $noteArr[$i]['mail_id'] = $row['mail_id'];
            $i++;
        }
        return $noteArr;
    }
    
  /*  
    function merge()
    {
        $mailArray = array();
        $Db = Db::getConnect('od');
        $q = 'SELECT * FROM mail_notes ';
        $result = $Db -> query($q);
        $i = 0;
        while ($row = $result -> fetch()) {
            $mailArray[$i]['id'] = $row['id'];
            $mailArray[$i]['note'] = $row['note'];
            $i++;
        }
        foreach($mailArray as $mail)
        {   
            if(strlen($mail['note']) < 5)
            {
                $q = "DELETE FROM mail_notes WHERE id = '".$mail['id']."'";
                $result = $Db -> query($q);
            }
            
        }
      
    }*/
    
}
?>
