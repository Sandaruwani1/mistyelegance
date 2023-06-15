<?php 
include 'dbconnection.php';
include '../model/PaymentModel.php';
include '../model/CustomerModel.php';

class DashboardController{
    private $con;
    private $paymentModel;
    private $customerModel;

    function DashboardController(){
        $this->con = DBConnection::dbconnect();
        $this->paymentModel = new PaymentModel();
        $this->customerModel = new CustomerModel();
    }
    function getFullrevenue(){
        return $this->paymentModel->getFullrevenue($this->con);
    }
   
    function getAllcustomerCount(){
        return $this->paymentModel->getAllcustomerCount($this->con);
    }
   
    
}
?>