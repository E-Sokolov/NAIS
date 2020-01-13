<?php
class Know{
	function getResources(){
		$res = array();
		$Db = Db::getConnect('glb');
		$q = 'SELECT * FROM resource_know';
		$result = $Db -> query($q);
		$i = 0;
		while($row = $result -> fetch()){
			$res[$i]['id'] = $row['id'];
			$res[$i]['resource'] = $row['resource'];
			$res[$i]['title'] = $row['title'];
			$i++;
		}
		return $res;
	}
	function getKnowsByResource($resource){
		$knows = array();
		$Db = Db::getConnect('glb');
		$q = "SELECT * FROM know WHERE resource = '".$resource."'";
		$result = $Db -> query($q);
		$i = 0;
		while($row = $result -> fetch()){
			$knows[$i]['id'] = $row['id'];
			$knows[$i]['title'] = $row['title'];
			$knows[$i]['full'] = $row['full'];
			$knows[$i]['solution'] = $row['solution'];
			$knows[$i]['screen'] = $row['screen'];
			$knows[$i]['zip'] = $row['zip'];
			$knows[$i]['resource'] = $row['resource'];
			$knows[$i]['date'] = $row['date'];
			$i++;
		}
		return $knows;
	}
	function getKnowsById($id){
		$knows = array();
		$Db = Db::getConnect('glb');
		$q = "SELECT * FROM know WHERE id = '".$id."'";
		//echo $id;
		$result = $Db -> query($q);
		$row = $result -> fetch();
			$knows['id'] = $row['id'];
			$knows['title'] = $row['title'];
			$knows['full'] = $row['full'];
			$knows['solution'] = $row['solution'];
			$knows['screen'] = $row['screen'];
			$knows['zip'] = $row['zip'];
			$knows['resource'] = $row['resource'];
			$knows['date'] = $row['date'];
		//print_r($knows);
		return $knows;
	}
	function insertKnow($data = array()){
		
		if(isset($_FILES['screen'])){
			$screenroute = '/views/know/screen/'.time().$_FILES['screen']['name'];
			if(move_uploaded_file($_FILES['screen']['tmp_name'], HOME.$screenroute)){
				$data['screen'] = $screenroute;
			}
		}
		if(isset($_FILES['zip'])){
			$ziproute = '/views/know/zip/'.time().$_FILES['zip']['name'];
			if(move_uploaded_file($_FILES['zip']['tmp_name'], HOME.$ziproute)){
				$data['zip'] = $ziproute;
			}
		}

		$Db = Db::getConnect('glb');
		$q = "INSERT INTO know values('',:title,:full,:solution,:screen,:zip,:resource,CURRENT_TIMESTAMP)";
		$result = $Db -> prepare($q);
		$result -> bindParam(':title', $data['title'], PDO::PARAM_STR);
		$result -> bindParam(':full', $data['full'], PDO::PARAM_STR);
		$result -> bindParam(':screen', $data['screen'], PDO::PARAM_STR);
		$result -> bindParam(':solution', $data['solution'], PDO::PARAM_STR);
		$result -> bindParam(':resource', $data['resource'], PDO::PARAM_STR);
		$result -> bindParam(':zip', $data['zip'], PDO::PARAM_STR);

		$result -> execute();
        return $result -> errorInfo();
	}
	function updateKnow($data = array()){

		if($_FILES['screen']['error'] != 4){
			//echo 'screen is set';
			$screenroute = '/views/know/screen/'.time().$_FILES['screen']['name'];
			//echo $screenroute;
			if(move_uploaded_file($_FILES['screen']['tmp_name'], HOME.$screenroute)){
				echo 'file uploaded';
				$data['screen'] = $screenroute;
				if($data['bscreen'] != ''){
					unlink(HOME.$data['bscreen']);
				}
			}
		}else{
			$data['screen'] = $data['bscreen'];	
		}
		if($_FILES['zip']['error'] != 4){
			echo 'isset zip';
			$ziproute = '/views/know/zip/'.time().$_FILES['zip']['name'];
			echo $ziproute;                                                                                    
			if(move_uploaded_file($_FILES['zip']['tmp_name'], HOME.$ziproute)){
				$data['zip'] = $ziproute;
					if($data['bzip'] != ''){
						unlink(HOME.$data['bzip']);
					}
			}
		}else{
			//echo $data['bzip'].'wwwss';
			$data['zip'] = $data['bzip'];
			print_r($data);
		}
		
		$Db = Db::getConnect('glb');
		$q = "UPDATE know SET title = :title,full = :full,solution = :solution, screen = :screen,zip = :zip,resource = :resource,date = CURRENT_TIMESTAMP WHERE id = :id ";
		$result = $Db -> prepare($q);
		$result -> bindParam(':id', $data['id'], PDO::PARAM_INT);
		$result -> bindParam(':title', $data['title'], PDO::PARAM_STR);
		$result -> bindParam(':full', $data['full'], PDO::PARAM_STR);
		$result -> bindParam(':screen', $data['screen'], PDO::PARAM_STR);
		$result -> bindParam(':solution', $data['solution'], PDO::PARAM_STR);
		$result -> bindParam(':resource', $data['resource'], PDO::PARAM_STR);
		$result -> bindParam(':zip', $data['zip'], PDO::PARAM_STR);

		$result -> execute();
        return $result -> errorInfo();
	}
	function getKnowByFilter($data = array()){
		$knows = array();
		$Db = Db::getConnect('glb');
		$q = "SELECT * FROM know WHERE title LIKE '%".$data['sq']."%' OR full LIKE '%".$data['sq']."%' OR solution LIKE '%".$data['sq']."%'";
		$result = $Db -> query($q);
		$i = 0;
		while($row = $result -> fetch()){
			$knows[$i]['id'] = $row['id'];
			$knows[$i]['title'] = $row['title'];
			$knows[$i]['full'] = $row['full'];
			$knows[$i]['solution'] = $row['solution'];
			$knows[$i]['screen'] = $row['screen'];
			$knows[$i]['zip'] = $row['zip'];
			$knows[$i]['resource'] = $row['resource'];
			$knows[$i]['date'] = $row['date'];
			$i++;
		}
		return $knows;
	}
}
?>
