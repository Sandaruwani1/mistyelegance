<?php 
include 'dbconnection.php';
include '../model/PaymentModel.php';

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
   function getPaymentForpackages($year){
    return $this->paymentModel->getPaymentForpackages($this->con,$year);
   }
   function getFoodsByPaymentId($payment_id){
    return $this->paymentModel->getFoodsByPaymentId($this->con, $payment_id);
}
    function getLastYearMonthlyIncome(){
        $data = $this->paymentModel->getLastYearMonthlyIncome($this->con);
        $result = array();
        $result[0] = array('Month', 'Income');
        foreach($data as $row){
            array_push($result, $row);
        }
        return $result;
    }
    function getFullrevenue(){
        return $this->paymentModel->getFullrevenue($this->con);
    }
   
}
?>