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
		return $this->customerModel->getAllCustomers($this->con);
	}
}

?>