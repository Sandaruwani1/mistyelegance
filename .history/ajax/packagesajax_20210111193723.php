<?php
include './controller/PackagesController.php';
$packagesController = new PackagesController();
if($_POST['action'] == 'getPackagesbyId'){
    $pkgId = $_POST['pkgId'];
	echo $packageController->deletePackage($pkgId);
	
}




?>