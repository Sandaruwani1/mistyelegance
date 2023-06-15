<?php

include 'dbconnection.php';
include '../model/CustomerModel.php';

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

	
    function checkEmailANDNicExistence($email,$nic){
		$sum = 0;
		$isEmailExist = $this->customerModel->checkEMailExistence($this->con, $email);
		$isNicExist = $this->customerModel->checkNicExistance($this->con, $nic);

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
	function checkNicExistence($nic){
		$isNicExist = $this->customerModel->checkNicExistance($this->con, $nic);
		if($isNicExist){
			return 1;
		}
		else{
			return 0;
		}

	}
	function addCustomer($data){
		if(!$this->customerModel->addCustomer($this->con, $data)){
			header("Location: customer.php?err");
		}
		header("Location: customer.php");

	}
	function addCustomerfromReservation($nic,$fname,$lname,$email,$tel,$dob,$country,$gender){
		$isEmailExist = $this->customerModel->checkEMailExistence($this->con, $email);
		if($isEmailExist){
			return -1;
		}

		if($this->customerModel->addCustomerfromReservation($this->con, $nic,$fname,$lname,$email,$tel,$dob,$country,$gender)){
			return 1;
		}else{
			return 0;
		}

	}
	function getCustomer($cusID){
		return $this->customerModel->getCustomerById($this->con, $cusID);
	}
	function deleteCustomer($cusId){
		return $this->customerModel->deleteCustomer($this->con,$cusId);
	}
	function changeCustomerstatus($cusId){
		$output= $this->customerModel->getCustomerstatus($this->con,$cusId);
		if($output == -1){
			return -1;
		}
		$newCustomerstatus=0;
		if($output == 0){
			$newCustomerstatus=1;
		}
		$is_updated =$this->customerModel->changeCustomerstatus($this->con,$cusId,$newCustomerstatus);
		if($is_updated == -1){
			return -1;
		}
		return $newCustomerstatus;
	}
	function UpdateCustomer($UpdateCusdata){
		if(!$this->customerModel->UpdateCustomer($this->con, $UpdateCusdata)){
			header("Location: viewcustomer.php?err");
		}
		header("Location: customer.php");

	}
	function searchCustomer($cus_nic){
		$result = $this->customerModel->searchCustomer($this->con, $cus_nic);
		$output = "";
		if($result){
			forEach($result as $row){
				$output.="<button type='button' onclick=\"setData('" . $row['cus_id'] ."')\">" . $row['cus_id'] . "</button>";

			}
			return $output;
		}

		return false;
	}
	function getCustomerForpackages($cus_nic,$year){
        return $this->customerModel->getCustomerForpackages($this->con, $cus_nic, $year);
    }
	
	



}	

?>