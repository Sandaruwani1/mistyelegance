<?php
include '../controller/FoodController.php';
$foodController = new FoodController();
if($_POST['action'] == 'getAllFood'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT f.food_name, fc.food_cat_name, f.food_price, f.food_id FROM food f , food_cat fc WHERE f.food_cat_id=fc.food_cat_id AND is_deleted=0
 ) temp
EOT;

	$primaryKey = "food_id";

	$columns = array(
		//
		array( 'db' => 'food_name', 'dt'=> 0),
        array( 'db' => 'food_cat_name', 'dt'=> 1),
		array( 'db' => 'food_price', 'dt'=> 2),
		array( 'db' => 'food_id', 'dt'=> 3),
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



}else if($_POST['action'] == 'deleteFood'){
	$foodId =$_POST['foodId'];
	echo $foodController->deleteFood($foodId);
}

?>