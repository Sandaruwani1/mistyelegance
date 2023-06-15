<?php
include '../controller/PackageController.php';
$packageController = new PackageController();
if($_POST['action'] == 'getAllPackages'){

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
	SELECT CASE WHEN ( (pkg.discount_from <= NOW() AND pkg.discount_until >= NOW()) OR (pkg.discount_from > NOW()) ) THEN 1 ELSE 0 END AS is_discount_available, pkg.pkg_name, pkgc.pkg_cat, pkg.rate_per_night, pkg.discount_from, pkg.discount_until, pkg.discount, pkg.pkg_id FROM packages pkg, package_cat pkgc WHERE pkg.pkg_cat_id=pkgc.pkg_cat_id AND pkg.is_deleted=0
 ) temp
EOT;

	$primaryKey = "pkg_id";

	$columns = array(
        
		array( 'db' => 'pkg_name', 'dt'=> 0),
        array( 'db' => 'pkg_cat', 'dt'=> 1),
        array( 'db' => 'rate_per_night', 'dt'=> 2),
		array( 'db' => 'discount', 'dt'=> 3),
		array( 'db' => 'pkg_id', 'dt'=> 4),
		array( 'db' => 'is_discount_available', 'dt'=> 5 ),
		array( 'db' => 'discount_from', 'dt'=> 6 ),
		array( 'db' => 'discount_until', 'dt'=> 7 )

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
}



else if($_POST['action'] == 'deletePackage'){
	$pkgId = $_POST['pkgId'];
	echo $packageController->deletePackage($pkgId);
}

else if($_POST['action'] == 'addDiscountpackage'){
	$pkgId = $_POST['pkgId'];
	$discount = $_POST['discount'];
	$discount_from = $_POST['discount_from'];
	$discount_until = $_POST['discount_until'];
	
	echo $packageController->addDiscountpackage($pkgId,$discount,$discount_from,$discount_until);
}
else if($_POST['action'] == 'removeDiscount'){
	$pkgId = $_POST['pkgId'];
	echo $packageController->removeDiscount($pkgId);
}
else if($_POST['action'] == 'getPackagesByReservationCount'){
    echo json_encode($packageController->getPackagesByReservationCount());
}
/*
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