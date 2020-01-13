<?php 
class Lang{
	function getLang($mod){
		if($_SESSION['lang'])
		{
			$lang = $_SESSION['lang'];
		}else{
			$lang = 'UA';
		}
		
		$Db = Db::getConnect('glb');
		$q = 'SELECT * FROM lang WHERE lang = \''.$lang.'\' AND module LIKE \'%'.$mod.'%\'';
		$result = $Db -> query($q);
		$i = 0;
		while($row = $result -> fetch() ){
			$lang_arr[$row['num']] = $row['phrase'];
			//echo $row['num'].'<br>';
			//print_r($lang_arr);
		}
		return $lang_arr;
	}
}
?>