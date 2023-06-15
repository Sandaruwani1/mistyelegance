<?php
include '../controller/EmployeeController.php';
$employeeController = new EmployeeController();
if($_POST['action'] == 'getAllEmployees'){

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
    SELECT d.desig_id, emp.emp_fname, emp.emp_lname, d.desig_Title, emp.emp_id  FROM employee emp, designation d WHERE  d.desig_id=emp.desig_id AND emp.is_deleted=0
 ) temp
EOT;

	$primaryKey = "desig_id";

	$columns = array(
		array( 'db' => 'desig_id', 'dt'=> 0),
		array( 'db' => 'emp_fname', 'dt'=> 1),
        array( 'db' => 'emp_lname', 'dt'=> 2),
		array( 'db' => 'desig_Title', 'dt'=> 3),
		array( 'db' => 'emp_id', 'dt'=> 4)

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
	echo $employeeController->checkEmailANDNicExistence($email, $nic);
}else if($_POST['action'] == 'deleteemployee'){
	$empId = $_POST['empId'];
	echo $employeeController->deleteEmployee($empId);
}

?>