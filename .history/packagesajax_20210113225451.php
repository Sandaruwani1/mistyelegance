<?php
include './controller/PackagesController.php';
$packagesController = new PackagesController();
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




?>