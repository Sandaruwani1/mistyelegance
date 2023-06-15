<?php 
include 'dbconnection.php';
include '../model/ReservationModel.php';
include '../model/CustomerModel.php';
include '../model/PackageModel.php';

class ReservationController{
    private $con;
    private $reservationModel;
    private $customerModel;
    private $packageModel;

    function ReservationController(){
        $this->con = DBConnection::dbconnect();
        $this->reservationModel = new ReservationModel();
        $this->customerModel = new CustomerModel();
        $this->packageModel = new PackageModel();
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
      
     $diff=date_diff($arrival_date,$leaving_date);
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
      $amount = $this->checkDiscountandAmount($arrival_date,$leaving_date,$pkg_id);
      $reservationAdded= $this->reservationModel->addReservation($this->con,$arrival_date,$leaving_date,$adults,$children,$cus_id,$availableRoom['room_id'],$amount);
 
      if(!$reservationAdded){
        return -1;
      }
      $res_id = $this->con->lastInsertId();
      //add payment
      
      $isPaymentAdded = false;
       $isPaymentAdded = $this->paymentModel->addPayement($amount,$res_id);
      //after payment added
      if(!$isPaymentAdded){
        return -1;
      }
      return $this->con->lastInsertId();
    }
   
}
