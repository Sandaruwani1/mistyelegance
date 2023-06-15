<?php
include '../controller/FoodController.php';
$foodController = new FoodController();
if($_POST['action'] == 'getAllFoodreservations'){

	
	// echo json_encode($output);

	$user = "root";
	$pass = "";
	$db = "misty_elegance_db";
	$host = "localhost";


	$table = <<<EOT
 (
    SELECT fr.res_id, f.food_name, fc.food_cat_name, fr.price, fr.food_res_id FROM food_reservation fr, food f, food_cat fc, reservation r WHERE fr.food_id=f.food_id AND f.food_cat_id=fc.food_cat_id AND fr.res_id=r.res_id AND MONTH(r.arrival_date) = MONTH(CURRENT_DATE())
 ) temp
EOT;

	$primaryKey = "food_res_id";

	$columns = array(
		//
		array( 'db' => 'res_id', 'dt'=> 0),
        array( 'db' => 'food_name', 'dt'=> 1),
		array( 'db' => 'food_cat_name', 'dt'=> 2),
        array( 'db' => 'price', 'dt'=> 3),
        array( 'db' => 'food_res_id', 'dt'=> 4),
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
else if($_POST['action'] == 'searchfood'){
	$foodName =$_POST['foodName'];
	echo $foodController->searchFood($foodName);
}
else if($_POST['action'] == 'cancelFoodres'){
	$food_res_Id =$_POST['food_res_Id'];
	echo $foodController->cancelFoodres($food_res_Id);
}
elseif($_POST['action']=='foodpriceByportion'){
	$foodName=$_POST['foodName'];
	$portion=$_POST['portion'];
	echo $foodController->getFoodpriceByportion($foodName,$portion);

}
?>