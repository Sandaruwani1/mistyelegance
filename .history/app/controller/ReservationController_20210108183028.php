<?php 
include 'dbconnection.php';
include '../model/ReservationModel.php';
include '../model/CustomerModel.php';
include '../model/PackageModel.php';
include '../model/PaymentModel.php';

class ReservationController{
    private $con;
    private $reservationModel;
    private $customerModel;
    private $packageModel;
    private $paymentModel;

    function ReservationController(){
        $this->con = DBConnection::dbconnect();
        $this->reservationModel = new ReservationModel();
        $this->customerModel = new CustomerModel();
        $this->packageModel = new PackageModel();
        $this->paymentModel = new PaymentModel();
    }

    function getAllReservations(){
		return $this->reservationModel->getAllReservations($this->con);
    }
    function checkPkgAvailablility($data){

      $adults = $data['adults'];
      $children = $data['children'];
      $arrival_date = $data['arrival_date'];
      $leaving_date = $data['leaving_date'];
      
      $result = $this->reservationModel->checkAvailability($this->con, $adults, $children, $arrival_date, $leaving_date);
      return count($result);
		
    }

    function getAvailablePkgs($arrival_date, $leaving_date, $adults, $children){
      return $this->reservationModel->checkAvailability($this->con, $adults, $children, $arrival_date, $leaving_date);
    }

    function getReservation($res_id)
    {

        return $this->reservationModel->getReservationById($this->con, $res_id);
    }

    function getCustomerById($cusId){
      return $this->customerModel->getCustomerById($this->con, $cusId);
    }
    function getPackageById($pkg_id){
      return $this->packageModel->getPackageById($this->con, $pkg_id);
    }
    function checkDiscountandAmount($arrival_date,$leaving_date, $pkg_id){
      $rowpkg = $this->packageModel->getPackageById($this->con, $pkg_id);
      
     $diff=date_diff(date_create($arrival_date),date_create($leaving_date));
     $dateCount = $diff->format("%a");
     $amount = $rowpkg['rate_per_night'] * $dateCount;
 
      if(($rowpkg['discount_from'] <= date('Y-m-d') && $rowpkg['discount_until'] >= date('Y-m-d'))){
          
        $amount=  $rowpkg['discount'] * $dateCount;
        return $amount;
        
      }else{
  
        return $amount;

      }


    }

    function addReservation ($arrival_date,$leaving_date,$adults,$children,$cus_id,$pkg_id){
      $availableRoom =  $this->reservationModel->checkRoomavailability($this->con, $arrival_date,$leaving_date,$pkg_id);
      if(!$availableRoom){
        return -1;
      }
      $amount = $this->checkDiscountandAmount($arrival_date,$leaving_date,$pkg_id);
      $reservationAdded= $this->reservationModel->addReservation($this->con,$arrival_date,$leaving_date,$adults,$children,$cus_id,$availableRoom['room_id'],$amount);
 
      if(!$reservationAdded){
        return -1;
      }
      $res_id = $this->con->lastInsertId();
      //add payment
       $isPaymentAdded = $this->paymentModel->addPayment($this->con, ($amount * 0.25),$res_id);
      if(!$isPaymentAdded){
        return -1;
      }
      return $this->con->lastInsertId();
    }
    function cancelReservation($resId){
      return $this->reservationModel->cancelReservation($this->con,$resId);
    }
    function getResamount($resId){
      $reservationAmount = $this->reservationModel->getResamount($this->con,$resId);
      $data = array();
      array_push($data, $reservationAmount);
      $reservationFoods = $this->reservationModel->getFoodReservationByReservationId($this->con, $resId);
      array_push($data, $reservationFoods);
      $advancePayment = $this->reservationModel->getAdvancepayment($this->con, $resId);
      array_push($data, $advancePayment);
      return $data;
    }
    function completeReservation($resId)
    {
        $reservationFoods = $this->reservationModel->getFoodReservationByReservationId($this->con, $resId);
        $sum = 0;
        foreach ($reservationFoods as $food) {
            $sum += $food['price'];
        }
        $reservationAmount = $this->reservationModel->getResamount($this->con,$resId);

        $totalAmount= $sum + $reservationAmount['res_amount'];
        
        $advancePayment = $this->reservationModel->getAdvancepayment($this->con, $resId);

        $balancePrice= $totalAmount - $advancePayment['payment_amount'];

        if( $this->paymentModel->addPayment($this->con,$balancePrice,$resId)){
          
          $payment_id = $this->con->lastInsertId();

         if( $this->reservationModel->completeReservation($this->con,$totalAmount,$resId)){

          
          return $payment_id;
         }

          
          return -1;
        }

        
          return -1;


    }
    function getReservationsBetweenDates($from,$until){
      return $this->reservationModel->getReservationsBetweenDates($this->con,$from,$until);

    }
    function getReservationcountForYear($from,$until){
      return $this->reservationModel->getReservationcountForYear($this->con,$from,$until);

    }
    function editReservationdate($data){

      $resId= $data['resId'];
      $arrival_date = $data['arrival_date'];
      $leaving_date = $data['leaving_date'];
      $resdata = $this->reservationModel->getReservationById($this->con,$resId);

      $adults= $resdata['no_of_adults'];
      $children= $resdata['no_of_children'];

      $result = $this->reservationModel->EditcheckAvailability($this->con, $resId,$adults, $children, $arrival_date, $leaving_date);
      return count($result);
		
    }

   
   
}
