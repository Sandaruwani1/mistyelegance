<?php

include 'dbconnection.php';
include '../model/EmployeeModel.php';

class EmployeeController{
	
	private $con;
	private $employeeModel;

	function EmployeeController(){
		$this->con = DBConnection::dbConnect();
		$this->employeeModel = new EmployeeModel();
	}

	
	function getAllEmployees(){
		return $this->employeeModel->getAllEmployees($this->con);
	}

	function getEmployee($empID){
		return $this->employeeModel->getEmployeeById($this->con, $empID);
	}

	function addEmployee($data, $image){
		if(!$this->employeeModel->addEmployee($this->con, $data)){
			header("Location: employee.php?err");
		}
		//check iimage avalablity
		if ($image['file-input']['name'] != "") {
			$last_id = $this->con->lastInsertId();

			$path = "../resources/images/users/";

			$extension = end(explode(".", $image["file-input"]["name"]));

			$imageName = $last_id . '.' . $extension;

			if(move_uploaded_file($image['file-input']['tmp_name'], $path . $imageName)){
				$this->employeeModel->updateImageName($this->con, $imageName, $last_id);
			}
		}

		header("Location: employee.php");
		//generate image name using last inserted id and save the image //move_uploaded_file()
		//update the image name in the database usig last insert id
		//redirect to employee.php
	}

	function checkEmailANDNicExistence($email, $nic){
		$sum = 0;
		$isEmailExist = $this->employeeModel->checkEMailExistence($this->con, $email);
		$isNicExist = $this->employeeModel->checkNicExistance($this->con, $nic);

		if($isEmailExist == -1 || $isNicExist == -1){
			return -1;
		}

		if($isEmailExist){
			$sum += 1;
		}

		if($isNicExist){
			$sum += 2;
		}

		return $sum;
	}
	function getDesignation(){
		return $this->employeeModel->getDesignation($this->con);
			
		
	}
	function updateEmployee($empUpdatedata){
		if(!$this->employeeModel->updateEmployee($this->con, $empUpdatedata)){
			header("Location: employee.php?err");
		}
		header("Location: employee.php?emp_id=" . $empUpdatedata['emp-id']);

	}
	function deleteEmployee($empId){
		session_start();
		if($empId == $_SESSION['user_info']['emp_id']){
			return false;
		}
		return $this->employeeModel->deleteEmployee($this->con, $empId);

	}
	
	
	

}

?>