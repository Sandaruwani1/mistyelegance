<?php
include '../controller/ReservationController.php';
$reservationController = new ReservationController();
if($_POST['action'] == 'getAllReservations'){

	// $userController = new UserController();
	// $users = $userController->getAllUsers();

	// $numRows = count($users);

	// $response = array();
	// $count = 1;
	//  foreach ($users as $user){
	//  	$temp = array();

	//  	$temp[] = $count;
	//  	$temp[] = $user['emp_fname'] . " " . $user['emp_lname'];
	//  	$temp[] = $user['desig_Title'];
	//  	$temp[] = $user['emp_email'];
	//  	$temp[] = $user['user_name'];

	//  	$count++;

	//  	$response[] = $temp;
	//  }

	//  $output = array(
	// 	"draw"				=>	intval($_POST["draw"]),
	// 	"recordsTotal"  	=>  $numRows,
	// 	"recordsFiltered" 	=> 	$numRows,
	// 	"data"    			=> 	$response
	// );

	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";

	$table = <<<EOT
 (
	SELECT res.res_id, pkg.pkg_name, r.room_no, cus.cus_id, cus.cus_fname, res.res_date, res.arrival_date, res.leaving_date FROM reservation res,room r, packages pkg,  customer cus WHERE res.cus_id=cus.cus_id AND res.room_id=r.room_id AND r.pkg_id=pkg.pkg_id AND res.res_status=1
 ) temp
EOT;

	$primaryKey = "res_id";

	$columns = array(
        array( 'db' => 'res_id', 'dt'=> 0),
		array( 'db' => 'pkg_name', 'dt'=> 1),
        array( 'db' => 'room_no', 'dt'=> 2),
        array( 'db' => 'cus_id', 'dt'=> 3),
		array( 'db' => 'cus_fname', 'dt'=> 4),
        array( 'db' => 'res_date', 'dt'=> 5),
        array( 'db' => 'arrival_date', 'dt'=> 6),
        array( 'db' => 'leaving_date', 'dt'=> 7),
        // array( 'db' => 'is_cancelled_by', 'dt'=> 8),

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


} /*
else if($_POST['action'] == 'checkUsernameExistence'){
	$username = $_POST['username'];
	echo $userController->checkUsernameExistence($username);
}
else if($_POST['action'] == 'deleteuser'){
	$userId = $_POST['userId'];
	echo $userController->deleteuser($userId);
}
else if($_POST['action'] == 'searchusers'){
	$empname = $_POST['empName'];
	echo $userController->searchUser($empname);
}
else if($_POST['action'] == 'changeUserstatus'){
	$userId = $_POST['userId'];
	echo $userController->changeUserstatus($userId);
}
else if($_POST['action'] == 'UpdateuserName'){
	$newUserName = $_POST['newUserName'];
	$userId =$_POST['userId'];
	echo $userController->updateUsername($newUserName,$userId);
}
else if($_POST['action'] == 'Updatepassword'){
	$newPassword = $_POST['newPassword'];
	$userId =$_POST['userId'];
	echo $userController->updatePassword($newPassword,$userId);
}
*/

?>