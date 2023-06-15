<?php
include '../controller/CustomerController.php';
$customerController = new CustomerController();
if($_POST['action'] == 'getAllCustomers'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT cus_fname, cus_id, cus_lname, cus_tel, cus_country, cus_status FROM  customer WHERE is_deleted=0
 ) temp
EOT;

	$primaryKey = "cus_id";

	$columns = array(
		//
		array( 'db' => 'cus_fname', 'dt'=> 0),
        array( 'db' => 'cus_lname', 'dt'=> 1),
		array( 'db' => 'cus_tel', 'dt'=> 2),
		array( 'db' => 'cus_country', 'dt'=> 3),
		array( 'db' => 'cus_status', 'dt'=> 4),
		array( 'db' => 'cus_id', 'dt'=> 5),
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
else if($_POST['action'] == 'searchCustomers'){
	$nic = $_POST['nic'];
	echo $customerController->searchCustomer($nic);
}
else if($_POST['action'] == 'loadCustomerinfo'){
	$nic = $_POST['nic'];
	echo $customerController->getCustomer($nic);
}


?>