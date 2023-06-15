<?php
include '../controller/UserController.php';
$userController = new UserController();
if($_POST['action'] == 'getusers'){

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
	SELECT emp.emp_image,emp.emp_fname,emp.emp_lname,d.desig_Title,u.user_id,u.user_status FROM employee emp,user u,designation d WHERE emp.emp_id=u.emp_id AND d.desig_id=emp.desig_id AND u.is_deleted=0
 ) temp
EOT;

	$primaryKey = "user_id";

	$columns = array(
        array( 'db' => 'emp_image', 'dt'=> 0),
		array( 'db' => 'emp_fname', 'dt'=> 1),
        array( 'db' => 'emp_lname', 'dt'=> 2),
        array( 'db' => 'desig_Title', 'dt'=> 3),
		array( 'db' => 'user_id', 'dt'=> 4),
		array( 'db' => 'user_status', 'dt'=> 5),

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


}else if($_POST['action'] == 'checkUsernameExistence'){
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
	echo $userController->changeUserstatus($newPassword,$userId);
}


?>