<?php

class UserModel{

	function checkUserCredentials($con, $username, $password){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		}

		$stmt = $con->prepare("SELECT COUNT(*) FROM user, employee WHERE user.emp_id=employee.emp_id AND ( user.user_name=? OR employee.emp_email=? ) AND user.user_pw=? AND user.user_status=? AND user.is_deleted=?");

		$stmt->execute(array($username, $username, $password, 1, 0));

		if($stmt->errorCode() != '00000'){
			return -1;
		}

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result['COUNT(*)'];
	}

	function getUser($con, $username){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM user u, employee e, designation d WHERE u.emp_id=e.emp_id AND e.desig_id=d.desig_id AND user_name=?");

		$stmt->execute(array($username));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function getUserById($con, $userId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM user u, employee e, designation d WHERE u.emp_id=e.emp_id AND e.desig_id=d.desig_id AND user_id=?");

		$stmt->execute(array($userId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function getUserByEmployeeId($con, $employeeId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM user WHERE emp_id=?");

		$stmt->execute(array($employeeId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function getAllUsers($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT emp.emp_email, emp.emp_fname, emp.emp_lname, u.user_name, d.desig_Title  FROM employee emp, user u, designation d WHERE emp.emp_id=u.emp_id AND d.desig_id=emp.desig_id");

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

	function deleteUser($con, $userId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("UPDATE user SET is_deleted=1 WHERE user_id=?");

		$stmt->execute(array($userId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return true;
	}


		function searchUser($con, $data){
			if($con->errorCode() != null){
				if($con->errorCode() != '00000'){
					return false;
				}
			}
	
			$stmt = $con->prepare("SELECT e.emp_id, e.emp_fname, e.emp_lname FROM employee e LEFT OUTER JOIN user u ON u.emp_id=e.emp_id 
									WHERE CONCAT(e.emp_fname, ' ', e.emp_lname) LIKE '%$data%' AND (u.user_id IS NULL OR u.is_deleted = 1)");
	        
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
	function addUser($con,$userdata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$user_name=$userdata['user-name'];
		$user_pw=sha1($userdata['password']);
		$emp_id=$userdata['emp_id'];

		$stmt = $con->prepare("INSERT INTO user(user_name, user_pw, user_status, emp_id, is_deleted) VALUES(?,?,?,?,?) ");
		$stmt->execute(array($user_name,$user_pw,1,$emp_id,0));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return true;

	}
	function updateDeletedUser($con,$userdata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$user_name=$userdata['user-name'];
		$user_pw=sha1($userdata['password']);
		$emp_id=$userdata['emp_id'];

		$stmt = $con->prepare("UPDATE user SET user_name=?, user_pw=?, user_status=1, is_deleted=0 WHERE emp_id=?");
		$stmt->execute(array($user_name,$user_pw,$emp_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return true;

	}
	/*function changeUserstatus($con, $userId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("UPDATE user SET user_status=0 WHERE user_id=?");

		$stmt->execute(array($userId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return true; 
	}*/
	function getUserstatus($con,$userId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}

		}

		$stmt = $con->prepare("SELECT user_status FROM user WHERE user_id=? ");
		$stmt->execute(array($userId));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row['user_status'];

	}
	function updateUserstatus($con,$userId,$newUserstatus){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}

		}
		

			$stmt = $con->prepare("UPDATE user SET user_status=? WHERE user_id=?");

			$stmt->execute(array($newUserstatus,$userId));

			if($stmt->errorCode() != '00000'){
				return -1;
			}
			return 1;
	

		

		
		
	}
	function checkUsernameExistence($con, $username){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
	

		$stmt =$con->prepare("SELECT * FROM user WHERE user_name=?");
		$stmt->execute(array($username));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();
	} 
	function updateUsername($con,$newUserName,$userId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
		
		$stmt = $con->prepare("UPDATE user SET user_name=? WHERE user_id=?");
		$stmt->execute(array($newUserName,$userId));

		if($stmt->errorCode() != '00000'){
				return -1;
			}
			return 1;
	}

	function checkUsernameExistenceWithUserId($con, $username, $userId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
	

		$stmt =$con->prepare("SELECT * FROM user WHERE user_name=? AND user_id<>?");
		$stmt->execute(array($username, $userId));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();
	} 
	function updatePassword($con,$newPassword,$userId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}
		
		}
		
		$stmt = $con->prepare("UPDATE user SET user_pw=? WHERE user_id=?");
		$stmt->execute(array($newPassword,$userId));

		if($stmt->errorCode() != '00000'){
				return -1;
			}
			return 1;

	}
	function getFullrevenue($con){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT SUM(payment_amount) FROM payment");


        if($stmt->errorCode() != '00000') {
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);



    }




}


?>

