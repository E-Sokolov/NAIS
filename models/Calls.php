<?php
class Calls
{
    function getCallsList($cols, $where)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $callsList = array();
        $q = 'SELECT '.$cols.' FROM calls '.$where;
        //print_r($q);
        $result = $Db -> query($q);
        $i=0;
        while($row = $result -> fetch()){
            $callsList[$i]['id'] = $row['id'];
            $callsList[$i]['region'] = $row['region'];
            $callsList[$i]['status'] = $row['status'];
            $callsList[$i]['date'] = date("d.m.Y", strtotime($row['date']));
            $callsList[$i]['time'] = $row['time'];
            $callsList[$i]['type'] = $row['type'];
            $callsList[$i]['client_type'] = $row['client_type'];
            $callsList[$i]['client'] = $row['client'];
            $callsList[$i]['fio'] = $row['fio'];
            $callsList[$i]['resource'] = $row['resource'];
            $callsList[$i]['description'] = $row['description'];
            $callsList[$i]['what_to_do'] = $row['what_to_do'];
            $callsList[$i]['ingeneer'] = $row['ingeneer'];
            if(is_numeric(strtotime($row['date_success'])) == true){
                $callsList[$i]['date_success'] = date("Y-m-d H:i", strtotime($row['date_success']));
            }else{
                $callsList[$i]['date_success'] = '';
            }
            $callsList[$i]['date_success'] = $row['date_success'];
            $callsList[$i]['service'] = $row['service'];
            $callsList[$i]['trip'] = $row['trip'];
            $callsList[$i]['trip_ingeneer'] = $row['trip_ingeneer'];
            $callsList[$i]['date_trip'] = $row['date_trip'];
            $callsList[$i]['etc_data'] = $row['etc_data'];
            $i++;
        }
        return $callsList;
    }
    
    function getClientTypeList()
    {
        $Db = Db::getConnect('glb');
        $clientTypeList = array();
        $result = $Db -> query('SELECT * FROM client_type');
        $i=2;
        while($row = $result -> fetch()){
            $clientTypeList[$i]['id'] = $row['id'];
            $clientTypeList[$i]['type'] = $row['type'];
            $i++;
        }
        return $clientTypeList;
    }
    function getResource()
    {
        $Db = Db::getConnect('glb');
        $resource = array();
        $result = $Db -> query('SELECT * FROM resource');
        $i=1;
        while($row = $result -> fetch()){
            $resource[$i]['id'] = $row['id'];
            $resource[$i]['resource'] = $row['resource'];
            $i++;
        }
        return $resource;
    }
    function insertCall($data = array())
    {
        htmlspecialchars($data,'ENT_QUOTES');
        $status = $data['status'];
        $date   = date("Y-m-d", strtotime($data['date']));
        $time   = $data['time'];
        $type   = $data['type'];
        $client_type = $data['client_type'];
        $client = $data['client'];
        $fio = $data['fio'];
        $resource = $data['resource'];
        $description = $data['fast_description'].$data['description'];
        $what_to_do = $data['what_to_do'];
        $ingeneer = $data['ingeneer'];
        
        if(is_numeric(strtotime($data['date_success'])) == true){
            $date_success = date("Y-m-d H:i:s", strtotime($data['date_success']));
        }else{
            $date_success = NULL;
        }
        $trip = $data['trip'];
        $service = $data['service'];
        $etc_data = $data['etc_data'];
       // print_r($data);
        $Db = Db::getConnect($_SESSION['filial']);
        
        $q = "INSERT INTO calls VALUES('','ОД',:status,:date,:time,:type,:client_type,:client,:fio,:resource,:description,:what_to_do,:ingeneer,:date_success,:service,:trip,:etc_data)";
        $result = $Db->prepare($q);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':date', $date );
        $result->bindParam(':time', $time );
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->bindParam(':client_type', $client_type, PDO::PARAM_INT);
        $result->bindParam(':client', $client, PDO::PARAM_STR);
        $result->bindParam(':fio', $fio, PDO::PARAM_STR);
        $result->bindParam(':resource', $resource, PDO::PARAM_INT);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':what_to_do', $what_to_do, PDO::PARAM_STR);
        $result->bindParam(':ingeneer', $ingeneer, PDO::PARAM_INT);
        $result->bindParam(':date_success', $date_success);
        $result->bindParam(':trip', $trip, PDO::PARAM_STR);
        $result->bindParam(':service', $service, PDO::PARAM_STR);
        $result->bindParam(':etc_data', $etc_data, PDO::PARAM_STR);
        $result -> execute();
        
        return $result -> errorInfo();
    }
    function editCall($data = array())
    {
        htmlspecialchars($data,'ENT_QUOTES');
        $id = $data['id'];
        $status = $data['status'];
        $date   = date("Y-m-d", strtotime($data['date']));
        $time   = $data['time'];
        $type   = $data['type'];
        $client_type = $data['client_type'];
        $client = $data['client'];
        $fio = $data['fio'];
        $resource = $data['resource'];
        $description = $data['fast_description'].$data['description'];
        $what_to_do = $data['what_to_do'];
        $ingeneer = $data['ingeneer'];
        if(is_numeric(strtotime($data['date_success'])) == true){
            $date_success = date("Y-m-d H:i:s", strtotime($data['date_success']));
        }else{
            $date_success = NULL;
        }
        $trip = $data['trip'];
        $service = $data['service'];
        $etc_data = $data['etc_data'];
         print_r($data);
        $Db = Db::getConnect($_SESSION['filial']);
        
        $q = "UPDATE calls SET region='Р В РЎвЂєР В РІР‚Сњ', status=:status, date=:date, time=:time, type=:type, client_type=:client_type,client=:client,fio=:fio,resource=:resource, description=:description, what_to_do=:what_to_do,ingeneer=:ingeneer,date_success=:date_success,service=:service,trip=:trip,etc_data=:etc_data WHERE id=:id";
        //print_r($q);
        $result = $Db->prepare($q);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':date', $date );
        $result->bindParam(':time', $time );
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->bindParam(':client_type', $client_type, PDO::PARAM_INT);
        $result->bindParam(':client', $client, PDO::PARAM_STR);
        $result->bindParam(':fio', $fio, PDO::PARAM_STR);
        $result->bindParam(':resource', $resource, PDO::PARAM_INT);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':what_to_do', $what_to_do, PDO::PARAM_STR);
        $result->bindParam(':ingeneer', $ingeneer, PDO::PARAM_INT);
        $result->bindParam(':date_success', $date_success);
        $result->bindParam(':trip', $trip, PDO::PARAM_STR);
        $result->bindParam(':service', $service, PDO::PARAM_STR);
        $result->bindParam(':etc_data', $etc_data, PDO::PARAM_STR);
        $result -> execute();
        return $result -> errorInfo();
    }
    function statCall($query)
    {
       $obj = new Calls();
       $all =  $obj -> getCallsList(' id ', $query);
       if(strlen($query) < 5){
            $q = ' WHERE date LIKE \''.date("Y-m").'-%\'';   
       }else{
            $q = ' AND date LIKE \''.date("Y-m").'-%\'';
       }
      // print_r($query);
      // print_r($q);
       $month = $obj -> getCallsList(' id', $query.$q );
       $statData['all'] = count($all);
       $statData['month'] = count($month);
       return $statData;
    }
    function getClientList($cols, $where)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $callsList = array();
        $q = 'SELECT * FROM clients '.$where;
        //print_r($q);
        $result = $Db -> query($q);
        $i=0;
        while($row = $result -> fetch()){
            $callsList[$i]['id'] = $row['id'];
            $callsList[$i]['region'] = $row['region'];
            $callsList[$i]['status'] = $row['status'];
            $callsList[$i]['org_type'] = $row['org_type'];
            $callsList[$i]['client'] = $row['client'];
            $callsList[$i]['address'] = $row['address'];
            $i++;
        }
        return $callsList;
    }
    function delete($id)
    {
        $Db = Db::getConnect($_SESSION['filial']);
        $q = 'DELETE FROM calls WHERE id = \''.$id.'\'';
        $result = $Db -> query($q);
        return $result -> errorInfo();
    }
}