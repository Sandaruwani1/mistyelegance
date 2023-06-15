<?php 

class ReservationModel{

    function getAllReservations($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare(" SELECT res.res_id, pkg.pkg_name, r.room_no, cus.cus_id, cus.cus_fname, res.res_date, res.arrival_date,
								 res.leaving_date, res.is_cancelled_by FROM room r, packages pkg,  customer cus, reservation res 
								 WHERE res.cus_id=cus.cus_id AND res.room_id=r.room_id AND r.pkg_id=pkg.pkg_id ");

		$stmt->execute();

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
		 
	}
	function getReservationById($con, $res_id){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM reservation res, customer cus ,packages pkg ,room r 
		WHERE  res.cus_id=cus.cus_id AND res.room_id=r.room_id AND r.pkg_id=pkg.pkg_id AND res_id=?");

		$stmt->execute(array($res_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	} 
	
	function checkAvailability($con, $adults, $children, $arrival_date, $leaving_date){

        $result = $con->prepare("SELECT COUNT(room_id), pkg.*, pkg_cat.* FROM room rm, packages pkg, package_cat pkg_cat WHERE 
		rm.pkg_id=pkg.pkg_id AND pkg.pkg_cat_id=pkg_cat.pkg_cat_id AND pkg.no_of_adults >= ? AND pkg.no_of_children >= ? AND rm.room_id 
		NOT IN ( SELECT rm.room_id FROM reservation res, room rm WHERE rm.room_id=res.room_id AND
		 ( (? BETWEEN res.arrival_date AND res.leaving_date OR ? BETWEEN res.arrival_date AND res.leaving_date) OR
		  (res.arrival_date <= ? AND res.leaving_date >= ?) ) AND res.res_status = 1) GROUP BY pkg.pkg_id" );

		$result->execute(array($adults, $children, $arrival_date, $leaving_date, $arrival_date, $leaving_date));
		
		$availablePkgs = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			array_push($availablePkgs, $row);
		}
		return $availablePkgs;
    }
	function checkRoomavailability($con,$arrival_date,$leaving_date,$pkg_id){

		$stmt = $con->prepare("SELECT rm.room_id FROM room rm, packages pkg, package_cat pkg_cat WHERE 
		rm.pkg_id=pkg.pkg_id AND pkg.pkg_cat_id=pkg_cat.pkg_cat_id AND pkg.pkg_id=? AND rm.room_id 
		NOT IN ( SELECT rm.room_id FROM reservation res, room rm WHERE rm.room_id=res.room_id AND
		 ( (? BETWEEN res.arrival_date AND res.leaving_date OR ? BETWEEN res.arrival_date AND res.leaving_date) OR
		  (res.arrival_date <= ? AND res.leaving_date >=?) ) AND res.res_status = 1 ) LIMIT 1" );

		$stmt->execute(array($pkg_id, $arrival_date, $leaving_date, $arrival_date, $leaving_date));
		
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
	function addReservation($con,$arrival_date,$leaving_date,$adults,$children,$cus_id,$availableRoom,$amount){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		
		$stmt = $con->prepare("INSERT INTO reservation ( res_date, arrival_date, leaving_date, no_of_adults, no_of_children, cus_id, 
								 room_id, res_amount, res_status ) VALUES( NOW(),?,?,?,?,?,?,?,?)");
		
		$stmt->execute(array($arrival_date,$leaving_date,$adults,$children,$cus_id,$availableRoom ,$amount,1));

		if($stmt->errorCode() != '00000') {
			return false;
		}

		return true;

	}
	function cancelReservation($con,$resId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt =$con->prepare("UPDATE reservation SET res_status=0 WHERE res_id=?");

		$stmt->execute(array($resId));
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;
	}
	function getResamount($con,$resId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt = $con->prepare("SELECT res_amount FROM reservation WHERE  res_id=?");

		$stmt->execute(array($resId));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	

	}

	function getFoodReservationByReservationId($con ,$resId){
		$result = $con->prepare("SELECT f.food_name, fr.price FROM food_reservation fr, food f WHERE fr.food_id=f.food_id AND fr.res_id=?" );

		$result->execute(array($resId));
		
		$resFoods = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			array_push($resFoods, $row);
		}
		return $resFoods;
	}
	function getAdvancepayment($con,$resId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}
		}
		$stmt = $con->prepare("SELECT payment_amount FROM payment WHERE  res_id=?");

		$stmt->execute(array($resId));

		if($stmt->errorCode() != '00000'){
			return 0;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	

	}
	function completeReservation($con,$fullAmount,$resId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return 0;
			}
		}
		$stmt =$con->prepare("UPDATE reservation SET full_payment_amount=? WHERE res_id=?");

		$stmt->execute(array($fullAmount,$resId));
		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;

	}
	function getReservationsBetweenDates($con,$from,$until){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT res.res_id, cus.cus_id, cus.cus_fname, cus.cus_lname, cus.cus_country, pkg.pkg_name, res.arrival_date, 
		res.leaving_date from reservation res, packages pkg, customer cus, room r WHERE res.cus_id=cus.cus_id AND r.room_id=res.room_id 
		AND r.pkg_id=pkg.pkg_id AND res.res_date BETWEEN ? AND ?");

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
	function getReservationcountForYear($con,$from,$until){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT YEAR(res.res_date) year, COUNT(*) count from reservation res, packages pkg, customer cus, room r WHERE 
		res.cus_id=cus.cus_id AND r.room_id=res.room_id AND r.pkg_id=pkg.pkg_id AND YEAR(res.res_date) BETWEEN ? AND ? 
		GROUP BY YEAR(res.res_date)");

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
	function EditcheckAvailability($con, $resId, $adults, $children, $arrival_date, $leaving_date){

        $result = $con->prepare("SELECT COUNT(room_id), pkg.*, pkg_cat.*  FROM room rm, packages pkg, package_cat pkg_cat WHERE 
		rm.pkg_id=pkg.pkg_id AND pkg.pkg_cat_id=pkg_cat.pkg_cat_id AND pkg.no_of_adults >= ? AND pkg.no_of_children >= ? AND   rm.room_id 
		NOT IN ( SELECT rm.room_id FROM reservation res, room rm WHERE rm.room_id=res.room_id AND NOT res.res_id=? AND		 ( (? BETWEEN res.arrival_date AND res.leaving_date OR ? BETWEEN res.arrival_date AND res.leaving_date) OR
		  (res.arrival_date <= ? AND res.leaving_date >= ?) )  AND res.res_status = 1)  GROUP BY pkg.pkg_id" );

		$result->execute(array($adults, $children, $resId, $arrival_date, $leaving_date, $arrival_date, $leaving_date));
		
		$availablePkgs = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			array_push($availablePkgs, $row);
		}
		return $availablePkgs;
	}
	function editcheckRoomavailability($con,$arrival_date,$leaving_date,$pkg_id,$res_id){

		$stmt = $con->prepare("SELECT rm.room_id FROM room rm, packages pkg, package_cat pkg_cat WHERE 
		rm.pkg_id=pkg.pkg_id AND pkg.pkg_cat_id=pkg_cat.pkg_cat_id AND pkg.pkg_id=? AND rm.room_id 
		NOT IN ( SELECT rm.room_id FROM reservation res, room rm WHERE rm.room_id=res.room_id AND NOT res.res_id=? AND
		 ( (? BETWEEN res.arrival_date AND res.leaving_date OR ? BETWEEN res.arrival_date AND res.leaving_date) OR
		  (res.arrival_date <= ? AND res.leaving_date >= ?) )  AND res.res_status = 1) LIMIT 1" );

		$stmt->execute(array($pkg_id, $res_id,$arrival_date, $leaving_date, $arrival_date, $leaving_date));
		
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
	function updateReservation($con,$arrival_date,$leaving_date,$availableRoom,$amount,$resId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		
		$stmt = $con->prepare("UPDATE  reservation SET  arrival_date=?, leaving_date=?, room_id=?, res_amount=?  WHERE res_id=?");
		
		$stmt->execute(array($arrival_date,$leaving_date,$availableRoom ,$amount,$resId));

		if($stmt->errorCode() != '00000') {
			return false;
		}

		return true;

	}
	
	
    
}
?>