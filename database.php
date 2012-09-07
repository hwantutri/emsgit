<?php
class Database{

	private $database_name = "ems";
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	public $connection = null;
	
	function __construct(){
		$connection = mysql_connect($this->host, $this->username, $this->password) or die();
		mysql_select_db($this->database_name, $connection);
		$this->connection = $connection;
		return $connection;
	}
}
?>