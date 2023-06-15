<?php
include './PackagesController.php';
$packagesController = new PackagesController();
if($_POST['action'] == 'getPkgbyId'){
    $pkgId = $_POST['pkgId'];
	echo $packagesController->getPackage($pkgId);
	
}




?>