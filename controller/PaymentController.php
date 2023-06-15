<?php 
include 'dbconnection.php';
include './model/PaymentModel.php';

class PaymentController{
    private $con;
    private $paymentModel;

    function PaymentController(){
        $this->con = DBConnection::dbconnect();
        $this->paymentModel = new PaymentModel();
    }
    function getPaymentById($payment_id){
        return $this->paymentModel->getPaymentById($this->con, $payment_id);
    }
   
   
}
?>