<?php 
include 'dbconnection.php';
include '../model/PaymentModel.php';
include '../model/CustomerModel.php';
include '../model/ReservationModel.php';
include '../model/PackageModel.php';

class DashboardController{
    private $con;
    private $paymentModel;
    private $customerModel;
    private $reservationModel;
    private $packageModel;

    function DashboardController(){
        $this->con = DBConnection::dbconnect();
        $this->paymentModel = new PaymentModel();
        $this->customerModel = new CustomerModel();
        $this->reservationModel= new ReservationModel();
        $this->packageModel= new PackageModel():
    }
    function getFullrevenue(){
        return $this->paymentModel->getFullrevenue($this->con);
    }
   
    function getAllcustomerCount(){
        return $this->customerModel->getAllcustomerCount($this->con);
    }

    function getAllreservationCount(){
        return $this->reservationModel->getAllreservationCount($this->con);
    }
    function getTodaydiscounts(){
		$result= $this->packageModel->getTodaydiscounts($this->con);

		if($result =="" || $result== 'NULL'){
			return 0;
		}
		else{
			return $result;
		}
	}
   
    
}
?>