<?php

include '../model/ModuleModel.php';

class ModuleController{
	
	private $con;
	private $moduleModel;

	function ModuleController(){
		$this->con = DBConnection::dbConnect();
		$this->moduleModel = new ModuleModel();
	}

	function getUserModule($desigID){
		return $this->moduleModel->getUserModule($this->con, $desigID);
	}

	
}

?>