<?php

include 'dbconnection.php';
include './model/CustomerModel.php';

class CustomerController{
	
	private $con;
	private $customerModel;

	function CustomerController(){
		$this->con = DBConnection::dbConnect();
		$this->customerModel = new CustomerModel();
	}

	
	function getAllCustomers(){
		return $this->customerModel->getAllCustomers($this->con);
	}

	
    function Login($username, $password, $urlData){

		$isCustomerAvailable = $this->customerModel->checkUserCredentials($this->con, $username, $password);

		if($isCustomerAvailable == 1){
			$customerInfo = $this->customerModel->getCustomer($this->con, $username);

			if(!$customerInfo){
				$err = "A system error has been occured!";
				header("Location: login.php?err=" . base64_encode($err));
			}else{
                session_start();
                $_SESSION['customer_info'] = $customerInfo;
				//redirect to dashboard
				if(isset($urlData['arr_date']) && isset($urlData['lev_date'])){
					header("Location: reservationsummary.php" . "?arr_date=" . $urlData['arr_date'] . '&lev_date=' . $urlData['lev_date'] . '&adults=' . $urlData['adults'] . '&children=' . $urlData['children'] . '&pkg_id=' .$urlData['pkg_id']);
				}else{
					header("Location: index.php");
				}
				
			}

		}else if($isCustomerAvailable == -1){

			$err = "A system error has been occured!";
			header("Location: login.php?err=" . base64_encode($err));
		
		}else{
			$err = "Wrong username or password!";
			header("Location: login.php?err=" . base64_encode($err));
		}

	}

	function addCustomer($data, $urlData){
		if(!$this->customerModel->addCustomer($this->con, $data)){
            $err = "A system error has been occured!";
            header("Location: login.php?err" . base64_encode($err));
		}else{
            if(!$this->customerModel->addCustomerLogin($this->con, $data)){
                $err = "A system error has been occured!";
                header("Location: login.php?err" . base64_encode($err));
            }
        }
		$customerInfo = $this->customerModel->getCustomer($this->con, $data['reg-user-name']);

        if(!$customerInfo){
            $err = "A system error has been occured!";
            header("Location: login.php?err=" . base64_encode($err));
        }else{
            session_start();
            $_SESSION['customer_info'] = $customerInfo;
            //redirect to dashboard
            if(isset($urlData['arr_date']) && isset($urlData['lev_date'])){
				header("Location: reservationsummary.php" . "?arr_date=" . $urlData['arr_date'] . '&lev_date=' . $urlData['lev_date'] . '&adults=' . $urlData['adults'] . '&children=' . $urlData['children'] . '&pkg_id=' .$urlData['pkg_id']);
			}else{
				header("Location: index.php");
			}
        }

	}
	function getCustomer($cusID){
		return $this->customerModel->getCustomerById($this->con, $cusID);
	}
	function UpdateCustomer($UpdateCusdata){
		if(!$this->customerModel->UpdateCustomer($this->con, $UpdateCusdata)){
			header("Location: viewcustomer.php?err");
		}
		header("Location: customer.php");

	}
	function OngoingresData($cus_id){
		return $this->customerModel->OngoingresData($this->con, $cus_id);
	}
	function ReshistoryData($cus_id){
		return $this->customerModel->ReshistoryData($this->con, $cus_id);
	}
	function cusFnameEdit($newfname,$cus_id){
		return $this->customerModel->cusFnameEdit($this->con, $newfname,$cus_id);

	}
	function cusLnameEdit($newlname,$cus_id){
		return $this->customerModel->cusLnameEdit($this->con, $newlname,$cus_id);

	}
	function cusEmailEdit($newemail,$cus_id){
		return $this->customerModel->cusEmailEdit($this->con, $newemail,$cus_id);

	}
	function cusTelEdit($newtel,$cus_id){
		return $this->customerModel->cusTelEdit($this->con, $newtel,$cus_id);

	}
	function addFeedback($pkgId,$rating,$feedback,$cusId){
		$feedbackId = $this->customerModel->addFeedback($this->con, $pkgId,$rating,$feedback,$cusId);
		return $this->customerModel->getFeedbackById($this->con, $feedbackId);
	}
	
	function cuseditImage($cusId, $image){
		
		//check iimage avalablity
		if ($image['file-input']['name'] != "") {
			

			$path = "../resources/images/customers/";

			$extension = end(explode(".", $image["file-input"]["name"]));

			$imageName = $cusId . '.' . $extension;

			move_uploaded_file($image['file-input']['tmp_name'], $path . $imageName);
			
		}

		header("Location: user.php");
		//generate image name using last inserted id and save the image //move_uploaded_file()
		//update the image name in the database usig last insert id
		//redirect to employee.php
	}


}	

?>