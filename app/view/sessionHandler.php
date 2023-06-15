<?php
	session_start();
	if(isset($_SESSION['user_info'])){
		$loggedUser = $_SESSION['user_info'];
	}else{
		header("Location: login.php");
	}
?>