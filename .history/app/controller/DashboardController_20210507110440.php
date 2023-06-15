<?php 
include 'dbconnection.php';
include '../model/PaymentModel.php';

class DashboardController{
    private $con;
    private $paymentModel;

    function DashboardController(){
        $this->con = DBConnection::dbconnect();
        $this->paymentModel = new PaymentModel();
    }
    
    
}
?>