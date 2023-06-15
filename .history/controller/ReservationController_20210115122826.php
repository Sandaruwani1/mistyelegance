<?php 
include 'dbconnection.php';
include './model/ReservationModel.php';
include './model/PackagesModel.php';
include './model/PaymentModel.php';


class ReservationController{
    private $con;
    private $reservationModel;
    private $packagesModel;
    private $paymentModel;

   
    public function ReservationController(){
        $this->con = DBConnection::dbconnect();
        $this->reservationModel = new ReservationModel();
        $this->packagesModel = new PackagesModel();
        $this->paymentModel = new PaymentModel();
        
    }

    function checkDiscountandAmount($arrival_date,$leaving_date, $pkg_id){
        $rowpkg = $this->packagesModel->getPackageById($this->con, $pkg_id);
        
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
}