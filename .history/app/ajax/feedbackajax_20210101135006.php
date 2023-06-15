<?php
//include '../controller/FeedbackController.php';
//$feedbackController = new FeedbackController();
if($_POST['action'] == 'getAllFeedbacks'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT f.feedback_id, pkg.pkg_name, CONCAT(cus.cus_fname, ' ', cus.cus_lname) AS cus_name, CONCAT(f.feedback, ' ', f.rating) AS feedback FROM feedback_and_ratings f ,packages pkg , customer cus WHERE  f.pkg_id=pkg.pkg_id AND f.cus_id=cus.cus_id
 ) temp
EOT;

	$primaryKey = "room_id";

	$columns = array(
		//
		array( 'db' => 'feddback_id', 'dt'=> 0),
        array( 'db' => 'pkg_name', 'dt'=> 1),
		array( 'db' => 'cus_name', 'dt'=> 2),
		array( 'db' => 'feedback', 'dt'=> 3),
    );

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
    	SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );



}else if($_POST['action'] == 'checkEmailANDNicExistence'){
	$email = $_POST['email'];
	$nic = $_POST['nic'];
	echo $customerController->checkEmailANDNicExistence($email, $nic);
}else if($_POST['action'] == 'deleteCustomer'){
	$cusId =$_POST['cusId'];
	echo $customerController->deleteCustomer($cusId);
}elseif($_POST['action'] == 'changeRoomstatus'){
	$roomId = $_POST['roomId'];
	echo $roomController->changeRoomstatus($roomId);
}

?>