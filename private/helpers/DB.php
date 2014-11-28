<?php
//private/db/DB.php
/**
 * This class is responsible for connection and communication with a mysql
 * database.
 */
class DB{
	
	/**
	 * Connection links.
	 * @var array
	 * @access public
	 */
	 public static $connections = array();

/**
 * <p>Connects to a mysql database and stores the link to that connection in the
 * public static $CONNECTION_LINKS associative array.</p>
 * <h4>Example :</h4>
 * <blockquote><pre></pre>
 * $server='localhost';
 * $user='root';
 * $password='dont_break_me';
 * $database = 'foo';
 * $link='remote';
 * DB::connect($server, $user, $password, $database,$link);
 * </blockquote>
 * @param string $server
 * @param string $user The connection user
 * @param string $password
 * @param string database
 * @param string $link Connection link key name. Used as key for the connections array.
 */
 static function connect($server, $user, $password, $database, $link = 0){
 	
 	if(isset(self::$connections['$link'])) mysql_close(self::$connections[$link]);
 	
 	$is_new = ($link == 0)? false:true;
 	self::$connections[$link] = mysql_connect($server, $user, $password, $is_new);
 	if(!self::$connections[$link]) die ("<p class='danger'>Unable to connect to database server!</p>");
 	
 	self::select_db($database, $link);
	 }
 
 /**
  * <p>Select a mysql database to work with using the connection $link</p>
  * <h4>Example :</h4>
  * $database = 'foo';
  * $link = 'foo_connection';
  * DB::select_db($database, $link );
  * @param string $database `The database to select
  * @param string $link The mysql_connect() connection link to use.
  */
  static function select_db($database, $link = 0){
  	
 	if(!mysql_select_db($database, self::$connections[$link])) die("<p class='danger'>Unable to connect to database!</p>");
  }
  
  	/**
   	* sets a new link in the connections associative array.
   	*  <blockquote><pre></pre>
	* $server='localhost';
	* $user='root';
	* $password='dont_break_me';
	* $database = 'foo';
	* $link='remote';
	* DB::connect($server, $user, $password, $database,$link);
	* </blockquote>
	* @param string $server
	* @param string $user The connection user
	* @param string $password
	* @param string database
	* @param string $link Connection link key name. Used as key for the connections array.
	*/
 	public static function set_connection($server, $user, $password, $database, $link){
 	
	 	if(isset(self::$connections[$link])) mysql_close(self::$connections[$link]);
	 	
	 	$is_new = ($link == 0)? false:true;
	 	self::$connections[$link] = mysql_connect($server, $user, $password, $is_new);
	 	if(!self::$connections[$link]) die ("<p class='danger'>Unable to create a connection link!</p>");
	 	
	 	self::select_db($database, $link);
	}
	
	/**
	 * <p>Queries the database and returns the result. Each row of the result
	 * set of the is an element in the returned array. And each row column in
	 * the result set is key is the row element associative array. Returns
	 * false on error.</p>
	 * <pre><code>
	 * $query = "Select * from myTable";
	 * $link = "default";
	 * DB::query($query, $link);
	 * </code></pre>
	 * @param string $query Mysql query string.
	 * @param string $link Mysql connection link.
	 * @return array Query result as array of associative arrays.
	 */
	static function query($query,$link = 0){
		
		$rows = array();
		
		if(!($result = mysql_query($query,self::$connections[$link]))) return false;
		
		while($row = mysql_fetch_assoc($result)){
			
			$rows[] = $row;
		}
		
		return $rows;
	}
	
	/**
	 * <p>Searches for all rows that match column/value pairs in the database
	 * and returns the corresponding rows.
	 * Each row of the result set of the is an element in the returned array.
	 * And each row column in the result set is key is the row element
	 * associative array. Returns false on error.</p>
	 * @param strng $table Database table on which to perform the search
	 * @param string $criteria associative array containing the column/value paires to search for.
	 * @param bool $exact_match Should the search criteria be an exact match?
	 * @param string $link Mysql connection link.
	 * @return array Query result as array of associative arrays.
	 */
	static function search($table, $criteria, $exact_match = false, $link = 0){
		
		$where = "WHERE ";
		$first = true;
		foreach($criteria as $key=>$value){
			
			if(!$first) $where=" and ";
			
			$where .=" $key";
			$where .=($exact_match)?"='$value'":" like '%$value%'";
		}
		
		$query = "select * from $table $where";
		
		return self::query($query, $link);
	}
}
?>