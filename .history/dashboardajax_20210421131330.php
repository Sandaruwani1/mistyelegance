<?php
include './controller/CustomerController.php';
$customerController = new CustomerController();
if($_POST['action'] == 'editcusFname'){
	$newfname = $_POST['newfname'];
    $cusId = $_POST['cusId'];
	
	echo $customerController->cusFnameEdit ($newfname,$cusId);
}
if($_POST['action'] == 'addFeedback'){
	$pkgId = $_POST['pkgId'];
	$rating=$_POST['rating'];
	$feedback=$_POST['feedback'];
    $cusId = $_POST['cusId'];
	
	echo json_encode($customerController->addFeedback($pkgId,$rating,$feedback,$cusId));
}
if($_POST['action'] == 'editcusLname'){
	$newlname = $_POST['newlname'];
    $cusId = $_POST['cusId'];
	
	echo $customerController->cusLnameEdit ($newlname,$cusId);
}
if($_POST['action'] == 'editcusEmail'){
	$newemail = $_POST['newemail'];
    $cusId = $_POST['cusId'];
	
	echo $customerController->cusEmailEdit ($newemail,$cusId);
}
if($_POST['action'] == 'editcusTel'){
	$newtel = $_POST['newtel'];
    $cusId = $_POST['cusId'];
	
	echo $customerController->cusTelEdit ($newtel,$cusId);
}