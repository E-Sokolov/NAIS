<?php
class Gauth
{
	function getData($where = string){
		$Db = Db::getConnect($_SESSION['filial']);
		$q = "SELECT id,client,name,ingeneer,date1,date2,coment FROM gauth ".$where;
		//echo $q;
		$result = $Db -> query($q);
		$i = 0;
		while($row = $result -> fetch())
		{
			$Gauth[$i]['id'] = $row['id'];
			$Gauth[$i]['client'] = $row['client'];
			$Gauth[$i]['name'] = $row['name'];
			$Gauth[$i]['ingeneer'] = $row['ingeneer'];
			$Gauth[$i]['date1'] = $row['date1'];
			$Gauth[$i]['date2'] = $row['date2'];
			$Gauth[$i]['coment'] = $row['coment'];
			$i++;
		}
		return $Gauth;
	}
	function insertData($data = array())
	{
		htmlspecialchars($data,'ENT_QUOTES');
		$Db = Db::getConnect($_SESSION['filial']);
		$q = 'INSERT INTO gauth VALUES(\'\',:client,:name,:ingeneer,:date1,:date2,:coment)';
		$result = $Db -> prepare($q);
		$result -> bindParam(':client',$data['client'], PDO::PARAM_STR);
		$result -> bindParam(':name',$data['name'], PDO::PARAM_STR);
		$result -> bindParam(':ingeneer',$data['ingeneer'], PDO::PARAM_INT);
		$result -> bindParam(':date1',$data['date1']);
		$result -> bindParam(':date2',$data['date2']);
		$result -> bindParam(':coment',$data['coment'], PDO::PARAM_STR);
		$result -> execute();
		return $result->errorInfo();
	}
	function updateData($data = array())
	{
		htmlspecialchars($data,'ENT_QUOTES');
		$Db = Db::getConnect($_SESSION['filial']);
		$q = 'UPDATE gauth SET client=:client, name=:name, ingeneer=:ingeneer,date1=:date1,date2=:date2, coment=:coment WHERE id=:id';
		$result = $Db -> prepare($q);
		$result -> bindParam(':id', $data['id']);
		$result -> bindParam(':client',$data['client'], PDO::PARAM_STR);
		$result -> bindParam(':name',$data['name'], PDO::PARAM_STR);
		$result -> bindParam(':ingeneer',$data['ingeneer'], PDO::PARAM_INT);
		$result -> bindParam(':date1',$data['date1']);
		$result -> bindParam(':date2',$data['date2']);
		$result -> bindParam(':coment',$data['coment'], PDO::PARAM_STR);
		$result -> execute();
		return $result->errorInfo();
	}
	function delete($id){
		$Db = Db::getConnect($_SESSION['filial']);
		$q = 'DELETE FROM gauth WHERE id='.$id;
		$result = $Db -> query($q);
		$result -> execute();
		return $result -> errorInfo();
	}
}
?>