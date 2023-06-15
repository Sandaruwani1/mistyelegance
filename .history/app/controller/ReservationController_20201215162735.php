<?php 
include 'dbconnection.php';
include '../model/ReservationModel.php';

class ReservationController{
    private $con;
    private $reservationModel;

    function ReservationController(){
        $this->con = DBConnection::dbconnect();
        $this->reservationModel = new ReservationModel();
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
      if($result){
        return $result->rowCount();
      }else{
        return 0;
      }
		
    }

    function getReservation($res_id)
    {

        return $this->reservationModel->getReservationById($this->con, $res_id);
    }
   
}

?>