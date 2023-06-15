<?php

class EmployeeModel{

	function getAllEmployees($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT emp.emp_fname, emp.emp_lname, d.desig_Title  FROM employee emp, designation d WHERE  d.desig_id=emp.desig_id");

		$stmt->execute();

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
		 
	}

	function getEmployeeById($con, $empId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM  employee e, designation d WHERE e.desig_id=d.desig_id AND e.emp_id=?");

		$stmt->execute(array($empId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function getEmployee($con, $empId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM  employee e, designation d WHERE e.desig_id=d.desig_id AND e.emp_id=?");
		$stmt->execute(array($empId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	} 

	function deleteEmployee($con,$empId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt =$con->prepare("UPDATE employee SET is_deleted=1 WHERE emp_id=?");

		$stmt->execute(array($empId));
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;
	}
	function addEmployee($con,$data){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}

		$emp_fname=$data['emp-fname'];
		$emp_lname=$data['emp-lname'];
		$emp_email=$data['emp-email'];
		$emp_dob=$data['emp-dob'];
		$emp_address=$data['emp-address'];
		$emp_tel=$data['emp-tel'];
		$emp_gender=$data['emp-gender'];
		$emp_desig=$data['desig-id'];
		$emp_nic = $data['emp-nic'];

		$stmt = $con->prepare("INSERT INTO employee (emp_fname,emp_lname, emp_email, emp_address, emp_dob, 
								emp_nic, emp_tel, emp_gender, desig_id, is_deleted ) VALUES(?,?,?,?,?,?,?,?,?,?)");
		
		$stmt->execute(array($emp_fname, $emp_lname, $emp_email, $emp_address, $emp_dob, $emp_nic, $emp_tel,  
							$emp_gender, $emp_desig,  0));
	}

	function updateImageName($con, $imageName, $empId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}

		$stmt = $con->prepare("UPDATE employee SET emp_image=? WHERE emp_id=?");
		$stmt->execute(array($imageName, $empId));
	}
	function getDesignation($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
			$stmt = $con->prepare("SELECT * FROM designation");
			$stmt->execute();
			$designations = array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($designations,$row);
			}
			return $designations;

	}

	function checkEMailExistence($con, $email){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
		$stmt =$con->prepare("SELECT * FROM employee WHERE emp_email=?");
		$stmt->execute(array($email));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();
	}
	
	function checkNicExistance($con,$nic){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}


		}
		$stmt =$con->prepare("SELECT * FROM employee WHERE emp_nic=?");
		$stmt->execute(array($nic));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();

	}

	function updateEmployee($con,$empUpdatedata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}

		$emp_fname=$empUpdatedata['emp-fname'];
		$emp_lname=$empUpdatedata['emp-lname'];
		$emp_email=$empUpdatedata['emp-email'];
		$emp_dob=$empUpdatedata['emp-dob'];
		$emp_address=$empUpdatedata['emp-address'];
		$emp_tel=$empUpdatedata['emp-tel'];
		$emp_gender=$empUpdatedata['emp-gender'];
		$emp_desig=$empUpdatedata['desig-id'];
		$emp_nic = $empUpdatedata['emp-nic'];
		$emp_id = $empUpdatedata['emp-id'];

		$stmt = $con->prepare("UPDATE employee SET emp_fname=?, emp_lname=?, emp_email=?, emp_address=?, emp_dob=?, emp_nic=?, 
								emp_Tel=?,  emp_gender=?, desig_id=?, is_deleted=? WHERE emp_id=?");
		
		$stmt->execute(array($emp_fname, $emp_lname, $emp_email, $emp_address, $emp_dob, $emp_nic, $emp_tel,
							 $emp_gender, $emp_desig,  0, $emp_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;
	    
	}
	

}


?>