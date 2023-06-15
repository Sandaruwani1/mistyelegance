<?php

include 'dbconnection.php';
include '../model/UserModel.php';

class UserController{
	
	private $con;
	private $userModel;

	function UserController(){
		$this->con = DBConnection::dbConnect();
		$this->userModel = new UserModel();
	}

	function Login($username, $password){

		$isUserAvailable = $this->userModel->checkUserCredentials($this->con, $username, $password);

		if($isUserAvailable == 1){
			$userInfo = $this->userModel->getUser($this->con, $username);

			if(!$userInfo){
				$err = "A system error has been occured!";
				header("Location: login.php?err=" . base64_encode($err));
			}else{
				//create a session
				session_start();
				$_SESSION['user_info'] = $userInfo;

				//redirect to dashboard
				header("Location: dashboard.php");
			}

		}else if($isUserAvailable == -1){

			$err = "A system error has been occured!";
			header("Location: login.php?err=" . base64_encode($err));
		
		}else{
			$err = "Wrong username or password!";
			header("Location: login.php?err=" . base64_encode($err));
		}

	}

	function logout($error){

		session_start();
		session_destroy();
		
		if($error){
			$err = "A system error has been occured!";
			header("Location: login.php?err=" . base64_encode($err));
		}else{
			header("Location: login.php");
		}
		
		
	}

	function getAllUsers(){
		return $this->userModel->getAllUsers($this->con);
	}

	function deleteUser($userId){
		session_start();
		if($userId == $_SESSION['user_info']['user_id']){
			return false;
		}
		return $this->userModel->deleteUser($this->con, $userId);
	}

	function getUser($userId){
		return $this->userModel->getUserById($this->con, $userId);
	}
	function searchUser($emp_fname){
		$result = $this->userModel->searchUser($this->con, $emp_fname);
		$output = "";
		if($result){
			forEach($result as $row){
				$output.="<button type='button' onclick=\"setData(" . $row['emp_id'] . ", '" . $row['emp_fname'] . " " . $row['emp_lname'] . "')\">" . $row['emp_fname'] . " " . $row['emp_lname'] . " - " .  $row['emp_id'] . "</button>";

			}
			return $output;
		}else{
			return "<button type='button'>No Record</button>";
		}

		return false;
	}
	function addUser($userdata){
		$user = $this->userModel->getUserByEmployeeId($this->con, $userdata['emp_id']);
		$output = false;
		if($user){
			$output=$this->userModel->updateDeletedUser($this->con,$userdata);
		}else{
			$output=$this->userModel->addUser($this->con,$userdata);
		}
		
		if($output){
			header("Location: user.php");
		}else{
			header("Location: user.php?err=true");
		}
	}
	
	function changeUserstatus($userId){
		$output=$this->userModel->getUserstatus($this->con,$userId);
		if($output==-1){
			return -1;
		}
		$newUserstatus=0;
		if($output==0){

			$newUserstatus=1;

		} 
	
		$is_updated = $this->userModel->updateUserstatus($this->con,$userId,$newUserstatus);
		if($is_updated == -1){
			return -1;
		}
		return $newUserstatus;
	}
	
	function checkUsernameExistence($username){
		return  $this->userModel->checkUsernameExistence($this->con, $username);
		
			
			
	}
	function updateUsername($newUserName,$userId){
		$isUsernameExist = $this->userModel->checkUsernameExistenceWithUserId($this->con, $newUserName, $userId);
		if($isUsernameExist == 1){
			return 2;
		}
		return $this->userModel->updateUsername($this->con, $newUserName,$userId);

	}
	function updatePassword($newPassword,$userId){
		return $this->userModel->updatePassword($this->con,sha1($newPassword),$userId);
	
	}
	function getFullrevenue(){
        return $this->paymentModel->getFullrevenue($this->con);
    }
   
    

}	

?>