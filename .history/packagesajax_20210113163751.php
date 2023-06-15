<?php
include './controller/PackagesController.php';
$packagesController = new PackagesController();
if($_POST['action'] == 'getPkgbyId'){
    $pkgId = $_POST['pkgId'];
	echo json_encode($packagesController->getPackage($pkgId));
	
}
else if($_POST['action'] == 'checkNicExistence'){
	$nic = $_POST['nic'];
	echo $packagesController->checkNicExistence($nic);
}




?>