<?php

class CustomerModel{

	function getAllCustomers($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare(" SELECT cus_fname, cus_id, cus_lname, cus_tel, cus_country, cus_status FROM  customer WHERE is_deleted=0");

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

	function getCustomerById($con, $cusId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM customer WHERE cus_id=?");

		$stmt->execute(array($cusId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	} 

	function checkEMailExistence($con, $email){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
	

		$stmt =$con->prepare("SELECT * FROM customer WHERE cus_email=?");
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
		$stmt =$con->prepare("SELECT * FROM customer WHERE cus_id=?");
		$stmt->execute(array($nic));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();

	}
	function addCustomer($con,$UpdateCusdata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$cus_id = $UpdateCusdata['cus-nic'];
		$cus_fname=$UpdateCusdata['cus-fname'];
		$cus_lname=$UpdateCusdata['cus-lname'];
		$cus_email=$UpdateCusdata['cus-email'];
		$cus_dob=$UpdateCusdata['cus-dob'];
		$cus_tel=$UpdateCusdata['cus-tel'];
		$cus_gender=$UpdateCusdata['cus-gender'];
		$cus_country=$UpdateCusdata['cus-country'];


		$stmt = $con->prepare("INSERT INTO customer ( cus_fname, cus_lname, cus_email, cus_dob, cus_id, 
								cus_tel,  cus_gender, cus_country, cus_status, is_deleted) VALUES(?,?,?,?,?,?,?,?,?,?)");
		
		$stmt->execute(array($cus_fname, $cus_lname, $cus_email, $cus_dob, $cus_id, $cus_tel,
							 $cus_gender, $cus_country,1,0));

	
	    
	}
	function deleteCustomer($con,$cusId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt =$con->prepare("UPDATE customer SET is_deleted=1 WHERE cus_id=?");

		$stmt->execute(array($cusId));
		
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;
	}
	function changeCustomerstatus($con,$cusId,$newCustomerstatus){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}

		}
		$stmt = $con->prepare("UPDATE customer SET cus_status=? WHERE cus_id=?");

			$stmt->execute(array($newCustomerstatus,$cusId));

			if($stmt->errorCode() != '00000'){
				return -1;
			}
			return 1;
	

	}
	function getCustomerstatus($con,$cusId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}

		}

		$stmt = $con->prepare("SELECT cus_status FROM customer WHERE cus_id=? ");
		$stmt->execute(array($cusId));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row['cus_status'];

	}
	function UpdateCustomer($con,$UpdateCusdata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		
		$cus_fname=$UpdateCusdata['cus-fname'];
		$cus_lname=$UpdateCusdata['cus-lname'];
		$cus_email=$UpdateCusdata['cus-email'];
		$cus_dob=$UpdateCusdata['cus-dob'];
		$cus_tel=$UpdateCusdata['cus-tel'];
		$cus_gender=$UpdateCusdata['cus-gender'];
		$cus_country=$UpdateCusdata['cus-country'];
		$cus_id = $UpdateCusdata['cus-nic'];

		$stmt =$con->prepare("UPDATE customer SET cus_fname=?, cus_lname=?, cus_email=?, cus_dob=?, 
								cus_tel=?,  cus_gender=?, cus_country=?, cus_status=?, is_deleted=? WHERE cus_id=? ");
	
		$stmt->execute(array($cus_fname,  $cus_lname, $cus_email, $cus_dob, $cus_tel,$cus_gender, $cus_country, 1, 0, $cus_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;
	    

	}
	
	function searchCustomer($con, $data){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM customer WHERE cus_id LIKE '%$data%'");
		
		$stmt->execute();
		 if($stmt->rowCount() > 0){
			 $result = Array();
			 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($result, $row);
			 } 
			 return $result;
		 }else{
			 return false;
		 }
		 
		 
	}
	function addCustomerfromReservation($con,$nic,$fname,$lname,$email,$tel,$dob,$country,$gender){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("INSERT INTO customer( cus_fname, cus_lname, cus_email, cus_dob, cus_id, 
								cus_tel, cus_gender, cus_country, cus_status, is_deleted) VALUES(?,?,?,?,?,?,?,?,?,?)");
		
		$stmt->execute(array($fname,  $lname, $email, $dob, $nic, $tel, $gender, $country, 1, 0));

		if($stmt->errorCode() != '00000') {
			return false;
		}

		return true;

		

	}
	function getCustomerForpackages($con,$cusId,$year){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT pkg.pkg_name, COUNT(pkg.pkg_name) count FROM packages pkg,  reservation res, room r
							 WHERE r.pkg_id=pkg.pkg_id AND r.room_id=res.room_id AND res.cus_id=? AND YEAR(res.arrival_date)=? GROUP BY pkg.pkg_name");

		$stmt->execute(array($cusId,$year));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
	


	}
	function getCustomerRegistrationcount($con,$from,$until){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT  count(res.cus_id) count, cus.cus_fname, cus.cus_lname FROM customer cus, reservation res WHERE res.cus_id=cus.cus_id AND res.res_date BETWEEN ?  AND ? GROUP BY cus.cus_id");

		$stmt->execute(array($from,$until));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
	


	}
	function getAllcustomerCount($con){
		if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT COUNT(cus_id) as count FROM customer");

        $stmt->execute();

        if($stmt->errorCode() != '00000') {
            return false;
        }
        $Count= $stmt->fetch(PDO::FETCH_ASSOC);

         return $Count;


	}


}


?>