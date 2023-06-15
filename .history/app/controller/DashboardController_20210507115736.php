<?php 
include 'dbconnection.php';
include '../model/PaymentModel.php';
include '../model/CustomerModel.php';
include '../model/ReservationModel.php';

class DashboardController{
    private $con;
    private $paymentModel;
    private $customerModel;
    private $reservationModel;

    function DashboardController(){
        $this->con = DBConnection::dbconnect();
        $this->paymentModel = new PaymentModel();
        $this->customerModel = new CustomerModel();
        $this->reservationModel= new ReservationModel();
    }
    function getFullrevenue(){
        return $this->paymentModel->getFullrevenue($this->con);
    }
   
    function getAllcustomerCount(){
        return $this->customerModel->getAllcustomerCount($this->con);
    }

    function getAllreservationCount(){
        return $this->reservationModel->getAllcustomerCount($this->con);
    }
   
    
}
?>