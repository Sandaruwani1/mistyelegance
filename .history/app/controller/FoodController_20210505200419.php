<?php
include 'dbconnection.php';
include '../model/FoodModel.php';

class FoodController
{
    private $con;
    private $foodModel;

    function FoodController()
    {
        $this->con = DBConnection::dbConnect();
        $this->foodModel = new FoodModel();
    }
    function getAllFood()
    {
        return $this->foodModel->getAllFood($this->con);
    }
    function getFoodcatName()
    {
        return $this->foodModel->getFoodcatName($this->con);
    }
    function addFood($data)
    {
        if (!$this->foodModel->addFood($this->con, $data)) {
            header("Location: food.php?err");
        }
        header("Location: food.php");
    }
    function getFood($foodID)
    {

        return $this->foodModel->getFoodById($this->con, $foodID);
    }
    function updateFood($foodUpdatedata)
    {
        if (!$this->foodModel->updateFood($this->con, $foodUpdatedata)) {
            header("Location: food.php?err");
        }

        header("Location: viewfood.php?food_id=" . $foodUpdatedata['food-id']);
    }
    function deleteFood($foodId){
		return $this->foodModel->deleteFood($this->con,$foodId);
	}
    function searchFood($foodName){
		$result = $this->foodModel->searchFood($this->con,$foodName);
		$output = "";
		if($result){
			forEach($result as $row){
				$output.="<button type='button' onclick=\"setData(this, " . $row['food_id'] . ", '" . $row['food_name']."')\">"  . $row['food_id'] . " - " .  $row['food_name'] . "</button>";

			}
			return $output;
		}

		return false;
    }
    
    function addReservationFoods($data){
        $foodIds = $data['food-id'];
        $foodPrices = $data['food-price'];
        $resId = $data['res-id'];

        for($i = 0; $i < count($foodIds); $i++){
            $this->foodModel->addReservationFood($this->con, $foodIds[$i], $foodPrices[$i], $resId);
        }
        header("Location: restuarant.php");
    }
    function cancelFoodres($food_res_Id){
		return $this->foodModel->cancelFoodres($this->con,$food_res_Id);
    }
    function getFoodReservationcount($from,$until){
        return $this->foodModel->getFoodRegistrationcount($this->con, $from, $until);
    }
	function getFoodpriceByportion($foodName,$portion){

        $result = $this->foodModel->searchFood($this->con,$foodName);
        $foodDetail= $this->getFood($result['food_id']);
        $foodprice= $foodDetail['food_price'] * $portion;
        return $foodprice;
    }
	
	
    
}