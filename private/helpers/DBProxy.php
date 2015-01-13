<?php

//private/helpers/DBProxy.php
/**
 * Serves as a proxy between the user and the database by hidding the details
 * on the actual database.
 */
 class DBProxy{
 	
 	/**
 	 * Name of the current database to use
 	 * @var string
 	 */
 	private $name;
 	
 	/**
 	 * Type of database
 	 * @var string
 	 */
 	private $type;
 	
 	/**
 	 * Database host
 	 * @var string;
 	 */
 	private $host;
 	
 	/**
 	 * database sever connection user
 	 * @var string
 	 */
 	private $user;
 	
 	/**
 	 * database sever communication port
 	 * @var int
 	 */
 	private $port;
 	
 	/**
 	 * database server connection password
 	 * @var string
 	 */
 	private $password;
 	
 	/**
 	 * Choses the right database to use for the current request and sets the
 	 * type, name, host, user, port, and password properties.
 	 */
 	private function init(){
 		
 		$configs = parse_ini_file('../private/config/config.ini');
 		$dbParams = explode(':', $configs['db']);
 		
 		$this->type = $dbParams[0];
 		$this->name = $dbParams[4];
 		$this->host = explode('@', $dbParams[1])[1];
 		$this->user = explode('@', $dbParams[1])[0];
 		$this->port = $dbParams[2];
 		$this->passord = $dbParams[3];
 	}
 	
 	/**
 	 * Builds up and returns a mysql query string form a  key/value pair
 	 * associative array representing database columns and their values and a
 	 * table name.
 	 * @param string $table The database table to query;
 	 * @param array $criteria Associative array of column/value pairs.
 	 * @return array
 	 */
 	private function buildQuery($table, $criteria){
 		
 		if(!is_string($table) || !is_array($criteria) || !isset($table))
 			throw new Exception("parameter 1 must be <i>string</i> and 2 an <i>array</i>");
 		
 		$query = "select * from $table";
 		
 		if(count($criteria) > 0){
 			
 			$first = true;
 			$query .= " where";
 			
	 		foreach($criteria as $key=>$value){
	 			
	 			if(!$fist){
	 				$query .= " and ($key = '$value')";
	 			}
	 			else{
	 				$query .= " ($key = '$value')";
	 				$first = false;
	 			}
	 			
	 			$query .= " ($key = '$value')";
	 		}
 		}
 		
 		return $query;
 	}
 	
 	/**
 	 * Executes a mysql query and returns the results as an array of associative
 	 * arrays of column/value pairs of rows that match the query.
 	 * @param string The query string
 	 * @return array The rows that match the query.
 	 */
 	private function execute($query){
 		
 		if($this->type == 'mysql'){
 			require "../private/helpers/MYSQL.php";
 			MYSQL::connect($this->host, $this->user, $this->password, $this->name);
 			return MYSQL::query($query);
 		}
 	}
 	
 	/**
 	 * Executes a query or search on the database and returns the returns the
 	 * result as an array of table column/value associative arrays.
 	 * <h4>Example:</h4>
 	 * $proxy = new DBProxy;
 	 * print_r($proxy->find("select * from user;"));
 	 *
 	 * print_r(['first_name'=>'Moses', 'last_name'=>'Besong'], 'person');
 	 *
 	 * @param string/array $criteria SQL query string or search criteria column/valud array.
 	 * @param string $table The database table to query. Must be specified if search critera array is used.
 	 */
 	public function find($criteria, $table=""){

 		$this->init();
 		if(is_string($criteria))
 			return $this->execute($criteria);
 		
 		return $this->execute($this->buildQuery($table, $criteria));
 	}
 	 
 }
?>