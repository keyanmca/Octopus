<?php
class MYSQL{
	
	public static function connect($host, $user, $password, $db){
		mysql_connect($host, $user, $password) or die ("<p>Unable to connect to database.</p>");
		mysql_select_db($db);
	}
	
 	public static function query($query){
 		
 		$result = mysql_query($query);
 		if(!$result) die("<p>Invalid query: " . mysql_error()."</p>");
 		$rows = array();
 		
 		while($row = mysql_fetch_assoc($result)){
 			$rows = $row;
 		}
 		
 		mysql_close();
 		return $rows;
 	}
}
?>