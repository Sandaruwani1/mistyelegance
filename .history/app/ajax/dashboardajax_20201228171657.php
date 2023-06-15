<?php 
include '../controller/ReservationController.php';
$reservationController = new ReservationController();
if($_POST['action'] == 'getResamount'){
	$reservationId =$_POST['reservationId'];
	echo json_encode($reservationController->getResamount($reservationId));
}
else if($_POST['action'] == 'completeReservation'){
	$resId = $_POST['resId'];
	echo $reservationController->completeReservation($resId);
}



?>