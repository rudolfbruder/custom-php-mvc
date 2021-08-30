<?php

/**
 * This is a default model class
 */
require_once'libs/Functions.php';

class Model{

	

	public function __construct()
	{
		static $conn = null;
		$this->database = new Database();
		$this->database->getInstance();
		$this->conn = $this->database->getConnection(); 
	}
}
?>