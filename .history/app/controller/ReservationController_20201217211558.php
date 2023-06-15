<?php 
include 'dbconnection.php';
include '../model/ReservationModel.php';
include '../model/CustomerModel.php';

class ReservationController{
    private $con;
    private $reservationModel;
    private $customerModel;

    function ReservationController(){
        $this->con = DBConnection::dbconnect();
        $this->reservationModel = new ReservationModel();
        $this->customerModel = new CustomerModel();
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

    function getCUstomerById($cusId){
      return $this->customerModel->getCustomerById($this->con, $cusId);
    }
   
}

?>