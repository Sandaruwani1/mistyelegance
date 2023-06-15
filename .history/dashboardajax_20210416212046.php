<?php
include './controller/CustomerController.php';
$customerController = new CustomerController();
if($_POST['action'] == 'editcusFname'){
	$newfname = $_POST['newfname'];
    $cus_id = $_POST['cus_id'];
	
	echo $customerController->cusFnameEdit ($newfname,$cus_id);
}