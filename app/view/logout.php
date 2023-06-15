<?php
	include '../controller/UserController.php';

    $userController = new UserController();

    if(isset($_GET['err'])){
    	$err = true;
    }else{
    	$err = false;
    }

    $userController->logout($err);

?>