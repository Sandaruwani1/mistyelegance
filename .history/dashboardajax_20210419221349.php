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
	
	echo $customerController->addFeedback($pkgId,$rating,$feedback,$cusId);
}