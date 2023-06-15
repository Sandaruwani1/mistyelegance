<?php
include '../controller/RoomController.php';
$roomController = new RoomController();
if($_POST['action'] == 'getAllRooms'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT r.pkg_id, pkg.pkg_id, r.room_no, pkg.pkg_name, r.room_Status, r.room_id FROM room r ,packages pkg WHERE  r.pkg_id=pkg.pkg_id
 ) temp
EOT;

	$primaryKey = "pkg.pkg_id";

	$columns = array(
		//
		array( 'db' => 'room_no', 'dt'=> 0),
        array( 'db' => 'pkg_name', 'dt'=> 1),
		array( 'db' => 'room_status', 'dt'=> 2),
		array( 'db' => 'room_id', 'dt'=> 3),
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
}elseif($_POST['action'] == 'changeCustomerstatus'){
	$cusId = $_POST['cusId'];
	echo $customerController->changeCustomerstatus($cusId);
}

?>