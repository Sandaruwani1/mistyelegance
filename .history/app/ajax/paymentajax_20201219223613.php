<?php
if($_POST['action'] == 'getAllPayments'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT p.payment_id, p.payment_date, p.payment_amount, p.payment_time ,cus.cus_fname FROM payment p, reservatios res, customer cus WHERE  p.res_id=res.res_id AND res.cus_id=cus.cus_id
 ) temp
EOT;

	$primaryKey = "room_id";

	$columns = array(
		//
		array( 'db' => 'payment_id', 'dt'=> 0),
        array( 'db' => 'payment_date', 'dt'=> 1),
		array( 'db' => 'payment_amount', 'dt'=> 2),
        array( 'db' => 'payment_time', 'dt'=> 3),
        array( 'db' => 'cus_fname', 'dt'=> 4),
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
?>