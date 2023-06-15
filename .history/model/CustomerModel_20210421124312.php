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
    function getCustomer($con, $username){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM customer cus, cus_login clogin WHERE cus.cus_id=clogin.cus_id AND  clogin.cus_username=?");

		$stmt->execute(array($username));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function checkUserCredentials($con, $username, $password){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		}

		$stmt = $con->prepare("SELECT COUNT(*) FROM customer cus, cus_login clogin WHERE cus.cus_id=clogin.cus_id AND clogin.cus_username=? AND clogin.cus_pw=? AND clogin.cus_status=?");

		$stmt->execute(array($username, $password, 1));

		if($stmt->errorCode() != '00000'){
			return -1;
		}

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result['COUNT(*)'];
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

         if($stmt->errorCode() != '00000'){
            return false;
        }
         return true;
                                        

	
	    
    }
    function addCustomerLogin($con,$data){
        if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

        }
        $cus_id = $data['cus-nic'];
		$cus_username=$data['reg-user-name'];
        $cus_pw=sha1($data['regpassword']);
        $stmt = $con->prepare("INSERT INTO cus_login ( cus_username, cus_pw, cus_status, cus_id) VALUES(?,?,?,?)");
		
        $stmt->execute(array($cus_username, $cus_pw, 1, $cus_id));
        
        if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;

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
	function cusFnameEdit($con, $newfname,$cus_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt =$con->prepare("UPDATE customer SET cus_fname=? WHERE cus_id=? ");
	
		$stmt->execute(array($newfname, $cus_id));

		if($stmt->errorCode() != '00000'){
			return 0;
		}
		return 1;
		

	}
	function cusLnameEdit($con, $newlname,$cus_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt =$con->prepare("UPDATE customer SET cus_lname=? WHERE cus_id=? ");
	
		$stmt->execute(array($newlname, $cus_id));

		if($stmt->errorCode() != '00000'){
			return 0;
		}
		return 1;
		

	}
	function cusEmailEdit($con, $newemail,$cus_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt =$con->prepare("UPDATE customer SET cus_email=? WHERE cus_id=? ");
	
		$stmt->execute(array($newemail, $cus_id));

		if($stmt->errorCode() != '00000'){
			return 0;
		}
		return 1;
		

	}
	function OngoingresData($con,$cus_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt = $con->prepare("SELECT * FROM reservation rs, payment p, room rm, packages pkg WHERE p.res_id=rs.res_id AND rs.cus_id=? AND rm.pkg_id=pkg.pkg_id AND rs.room_id=rm.room_id AND rs.full_payment_amount IS NULL");

		$stmt->execute(array($cus_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;

	}
	function ReshistoryData($con,$cus_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt = $con->prepare("SELECT A.*, F.feedback, F.rating FROM (SELECT rs.*, rm.room_no, pkg.pkg_name, pkg.pkg_id FROM reservation rs, room rm, packages pkg 
		WHERE rs.room_id=rm.room_id AND rm.pkg_id=pkg.pkg_id AND rs.full_payment_amount IS NOT NULL AND rs.cus_id=?) AS A
		 LEFT OUTER JOIN feedback_and_ratings F ON A.pkg_id =F.pkg_id AND A.cus_id=F.cus_id");

		$stmt->execute(array($cus_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;

	}
	function addFeedback($con,$pkgId,$rating,$feedback,$cusId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("INSERT INTO feedback_and_ratings (cus_id,pkg_id,rating,feedback) VALUES(?,?,?,?)");
		
		$stmt->execute(array($cusId,$pkgId,$rating,$feedback));

         if($stmt->errorCode() != '00000'){
            return false;
        }
         return $con->lastInsertId();
	    
    }

	function getFeedbackById($con,$feedbackId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}

		}
		$stmt = $con->prepare("SELECT * from feedback_and_ratings WHERE feedback_id=?");

		$stmt->execute(array($feedbackId));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
	
	
	

}


?>