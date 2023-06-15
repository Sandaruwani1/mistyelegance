<?php 
 class DBConnection{
 	private $host="localhost"; //host of the db server
 	private $un="root"; // username of the db
 	private $pw=""; //password of the db
 	private $db="misty_elegance_db"; // name of the db
 	private $connetion=null;
 	private static $instance=null; // define varibles instance 

 	private function dbCon(){

		$this->connection = new PDO("mysql:host=$this->host;dbname=$this->db",$this->un,$this->pw); //create database connction
		return $this->connection;
	}

	public static function dbConnect(){
		if(self::$instance == null){ // if database instance not exists
			$ob = new DBConnection();
			self::$instance = $ob->dbCon(); // Create database instance
		}
		return self::$instance;
	}

 }




?>