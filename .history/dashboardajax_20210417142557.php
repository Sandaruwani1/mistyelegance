<?php
include './controller/CustomerController.php';
$customerController = new CustomerController();
if($_POST['action'] == 'editcusFname'){
	$newfname = $_POST['newfname'];
    $cusId = $_POST['cusId'];
	
	echo $customerController->cusFnameEdit ($newfname,$cusId);
}