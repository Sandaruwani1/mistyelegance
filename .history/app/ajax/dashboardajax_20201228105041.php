<?php 
include '../controller/ReservationController.php';
$reservationController = new ReservationController();
if($_POST['action'] == 'getResamount'){
	$ReservationId =$_POST['ReservationId'];
	echo $reservationController->getResamount($ReservationId);
}



?>