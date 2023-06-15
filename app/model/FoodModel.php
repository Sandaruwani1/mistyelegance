<?php
class FoodModel
{
	function getAllFood($con)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return false;
			}
		}
		$stmt = $con->prepare("SELECT f.food_name, fc.food_cat_name, f.food_price, f.food_id FROM food f , food_cat fc WHERE f.food_cat_id=fc.food_cat_id");

		$stmt->execute();


		if ($stmt->errorCode() != '00000') {
			return false;
		}

		$result = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($result, $row);
		}

		return $result;
	}
	function getFoodcatName($con)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return false;
			}
		}
		$stmt = $con->prepare("SELECT * FROM food_cat ");
		$stmt->execute();
		$foodcat = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($foodcat, $row);
		}
		return $foodcat;
    }
    function addFood($con, $data)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return -1;
			}
		}
		$food_name = $data['food-name'];
        $food_price = $data['food-price'];
        $food_cat_id = $data['food-cat-id'];

		$stmt = $con->prepare("INSERT INTO food (food_name,food_price,food_cat_id,is_deleted ) VALUES(?,?,?,?)");

		$stmt->execute(array(
			$food_name, $food_price,$food_cat_id, 0
		));
	}
	
	
	function getFoodById($con, $foodId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM food WHERE food_id=?");

		$stmt->execute(array($foodId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function updateFood($con,$foodUpdatedata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$food_name = $foodUpdatedata['food-name'];
        $food_price = $foodUpdatedata['food-price'];
        $food_cat_id = $foodUpdatedata['food-cat-id'];
        $food_id=$foodUpdatedata['food-id'];

		$stmt = $con->prepare("UPDATE food SET food_name=?, food_price, food_cat_id=? WHERE food_id=?");
		$stmt->execute(array($food_name, $food_price,$food_cat_id, $food_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;
	    

    }
    function deleteFood($con,$foodId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt =$con->prepare("UPDATE food SET is_deleted=1 WHERE food_id=?");

		$stmt->execute(array($foodId));
		
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;
	}
	function searchFood($con, $data){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }

        $stmt = $con->prepare("SELECT food_name ,food_id FROM food 
                                WHERE CONCAT(food_id, ' ', food_name) LIKE '%$data%' AND is_deleted=0 ");
        
        $stmt->execute();
         if($stmt->rowCount() > 0){
             $result = Array();
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($result, $row);
             } 
             return $result;
         }else{
             return false;
         }
         
         
    }
    function addReservationFood($con, $foodId, $foodPrices, $resId)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return -1;
			}
		}
		
		$stmt = $con->prepare("INSERT INTO food_reservation (food_id,price,res_id ) VALUES(?,?,?)");

		$stmt->execute(array(
			$foodId, $foodPrices,$resId
		));
    }
    function cancelFoodres($con,$food_res_Id){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt =$con->prepare("DELETE FROM  food_reservation WHERE food_res_id=?");

		$stmt->execute(array($food_res_Id));
		
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;
	}
	function getFoodRegistrationcount($con,$from,$until){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT  count(resf.food_id) count, f.food_name FROM food f, food_reservation resf , reservation res WHERE 
								res.res_id=resf.res_id AND res.leaving_date BETWEEN ?  AND ? GROUP BY f.food_id");

		$stmt->execute(array($from,$until));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
	


	}

}
