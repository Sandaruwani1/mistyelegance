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
    SELECT pkg.pkg_img_1, pkg.pkg_name, pkgc.pkg_cat, pkg.rate_per_night,  pkg.discount, pkg.pkg_id FROM packages pkg, package_cat pkgc WHERE pkg.pkg_cat_id=pkgc.pkg_cat_id AND pkg.is_deleted=0 
 ) temp
EOT;

	$primaryKey = "pkg_id";

	$columns = array(
		array( 'db' => 'pkg_img_1', 'dt'=> 0),
		array( 'db' => 'pkg_name', 'dt'=> 1),
        array( 'db' => 'pkg_cat', 'dt'=> 2),
		array( 'db' => 'rate_per_night', 'dt'=> 3),
		array( 'db' => 'discount', 'dt'=> 4)
		array( 'db' => 'pkg_id', 'dt'=> 5)

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