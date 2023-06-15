<?php
include './controller/PackagesController.php';
include './controller/ReservationController.php';
$packagesController = new PackagesController();
$reservationController = new ReservationController();
if($_POST['action'] == 'getPkgbyId'){
    $pkgId = $_POST['pkgId'];
	echo json_encode($packagesController->getPackage($pkgId));
	
}
else if($_POST['action'] == 'checkEmailANDNicExistence'){
	$nic = $_POST['nic'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	echo $packagesController->checkNicEmailUsernameExistence($nic,$email,$username);
}
else if($_POST['action'] == 'addReservation'){
	$arrival_date = $_POST['arrival_date'];
	$leaving_date = $_POST['leaving_date'];
	$adults = $_POST['adults'];
	$children = $_POST['children'];
	$cus_id = $_POST['cus_id'];
	$pkg_id = $_POST['pkg_id'];
	
	echo $reservationController->addReservation ($arrival_date,$leaving_date,$adults,$children,$cus_id,$pkg_id);
}




?>