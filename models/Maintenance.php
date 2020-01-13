<?php 
class Maintenance{
	function getData($col,$where){
		$Db = Db::getConnect($_SESSION['filial']);
		$q = ' SELECT '.$col.' FROM maintenance '.$where;
		//echo $q;
		$result = $Db -> query($q);
		$i = 0;
		$MaintenanceList = array();
		while($row = $result -> fetch()){
			$MaintenanceList[$i]['id'] = $row['id'];
			$MaintenanceList[$i]['date'] = $row['date'];
			$MaintenanceList[$i]['client_type'] = $row['client_type'];
			$MaintenanceList[$i]['client'] = $row['client'];
			$MaintenanceList[$i]['type'] = $row['type'];
			$MaintenanceList[$i]['ingeneer'] = $row['ingeneer'];
			$MaintenanceList[$i]['place'] = $row['place'];
			$MaintenanceList[$i]['time'] = $row['time'];
			$MaintenanceList[$i]['price'] = $row['price'];
			$MaintenanceList[$i]['note'] = $row['note'];
			$i++;			
		}
		return $MaintenanceList;
	}
	function insertData($data = array()){
		$Db = Db::getConnect($_SESSION['filial']);
		htmlspecialchars($data,'ENT_QUOTES');
		$q = 'INSERT INTO maintenance VALUES(\'\',:date,:client_type,:client,:type,:ingeneer,:place,:time,:price,:note)';
		$date = $data['date'];
		$client_type = $data['client_type'];
		$client = $data['client'];
		$type = $data['type'];
		$ingeneer = $data['ingeneer'];
		$place = $data['place'];
		$time = $data['time'];
		$price = $data['price'];
		$note = $data['note'];
		$result = $Db -> prepare($q);
		$result -> bindParam(':date',date("Y-m-d",strtotime($date)));
		$result -> bindParam(':client_type',$client_type, PDO::PARAM_INT);
		$result -> bindParam(':client',$client, PDO::PARAM_STR);
		$result -> bindParam(':type',$type, PDO::PARAM_STR);
		$result -> bindParam(':ingeneer',$ingeneer, PDO::PARAM_INT);
		$result -> bindParam(':place',$place, PDO::PARAM_STR);
		$result -> bindParam(':time',$time, PDO::PARAM_INT);
		$result -> bindParam(':price',$price, PDO::PARAM_INT);
		$result -> bindParam(':note',$note, PDO::PARAM_STR);
		$result -> execute();
		print_r($result);
		return $result -> errorInfo();
	}
	function updateData($data = array()){
		$Db = Db::getConnect($_SESSION['filial']);
		htmlspecialchars($data,'ENT_QUOTES');
		$q = 'UPDATE maintenance SET date=:date,client_type=:client_type,client=:client,type=:type,ingeneer=:ingeneer,place=:place,time=:time,price=:price,note=:note WHERE id =:id';
		$result = $Db -> prepare($q);
		$result -> bindParam(':id',$data['id']);
		$result -> bindParam(':date',date("Y-m-d",strtotime($data['date'])));
		$result -> bindParam(':client_type',$data['client_type'], PDO::PARAM_INT);
		$result -> bindParam(':client',$data['client'], PDO::PARAM_STR);
		$result -> bindParam(':type',$data['type'], PDO::PARAM_STR);
		$result -> bindParam(':ingeneer',$data['ingeneer'], PDO::PARAM_INT);
		$result -> bindParam(':place',$data['place'], PDO::PARAM_STR);
		$result -> bindParam(':time',$data['time'], PDO::PARAM_INT);
		$result -> bindParam(':price',$data['price'], PDO::PARAM_INT);
		$result -> bindParam(':note',$data['note'], PDO::PARAM_STR);
		$result -> execute();
		//print_r($result);
		return $result -> errorInfo();
	}
	function delete($id){
		$Db = Db::getConnect($_SESSION['filial']);
		$q = 'DELETE FROM maintenance WHERE id='.$id;
		$result = $Db -> query($q);
		$result -> execute();
		return $result -> errorInfo();
	}
	function stat($query){
		// $query is part of query for data from table 'maintenance'
		// query for statistic about time of maintenance of last year
		$Db = Db::getConnect($_SESSION['filial']);
        $year_hours = 0;
        $year_money = 0;
        $qyear = 'SELECT * FROM maintenance'.$query;
        //echo $qyear;
		$result1 = $Db -> query($qyear);
		$i =0;
        while($row = $result1 -> fetch()){
       		 $year_hours = $year_hours + $row['time'];
       		 $year_mntn[$i] = $row['id'];
       		 $year_money = $year_money + $row['price'];
       		 $i++; 
      	}
      	// close

      	//query for statistic about
   
      	$qcontract = 'SELECT * FROM maintenance_contract ORDER BY date DESC LIMIT 1';
      	$result_contract = $Db -> query($qcontract);
      	$contract = $result_contract -> fetch();

      	$qg = 'SELECT * FROM maintenance WHERE note LIKE \'%'.$contract['contract'].'%\'';
      	$result_contract2 = $Db -> query($qg);
      	$balance = 0;
      	while ($row = $result_contract2 -> fetch()) {
      		//echo $row['price'].'<br>';
      		$balance = $balance + $row['price'];
      		//echo $balance.'<br>';
      		//print_r($row);
      	}
      	$g_money = $contract['price'] - $balance;
      	//echo $balance;
      	//close

      	// query about statistic about time of maintenance of last month
        if(strlen($query) < 5){
            $q = ' WHERE date LIKE \''.date("Y-m").'-%\'';   
       }else{
            $q = ' AND date LIKE \''.date("Y-m").'-%\'';
       }
       $month_hours = 0;
       $month_money = 0;
       $qmonth = 'SELECT * FROM maintenance'.$query.$q;
       $result2 = $Db -> query($qmonth);
       $k=0;
       while($row = $result2 -> fetch()){
       		$month_hours = $month_hours + $row['time'];
       		$month_mntn[$k] = $row['id'];
       		$month_money = $month_money + $row['price'];
       		$k++;
       }
       //close

       // display statistics array
       $statData['year_mntn'] = count($year_mntn);
       $statData['month_mntn'] = count($month_mntn);
       $statData['year_hours'] = $year_hours;
       $statData['month_hours'] = $month_hours;
       $statData['year_money'] = $year_money;
       $statData['month_money'] = $month_money;
       $statData['g_money'] = $g_money;
       return $statData;
   }
}