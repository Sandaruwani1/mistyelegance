<?php
class PackagesModel{
    function getAllpackages($con){
        if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
        }
        $stmt = $con->prepare("SELECT * FROM packages pkg, package_cat pkgc WHERE pkg.pkg_cat_id=pkgc.pkg_cat_id");
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
	
	function getPackageById($con,$pkg_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt = $con->prepare("SELECT * FROM packages pkg, bed b, package_cat pkgc WHERE pkg.bed_id=b.bed_id AND pkg.pkg_cat_id=pkgc.pkg_cat_id AND pkg_id=?");
		$stmt->execute(array($pkg_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	} 
	function getPackage($con,$pkg_name){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt = $con->prepare("SELECT * FROM packages pkg, bed b, package_cat pkgc WHERE pkg.bed_id=b.bed_id AND pkg.pkg_cat_id=pkgc.pkg_cat_id AND pkg_name=?");
		$stmt->execute(array($pkg_name));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function getPackagetype($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
			$stmt = $con->prepare("SELECT * FROM package_cat");
			$stmt->execute();
			$packagetypes = array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($packagetypes,$row);
			}
			return $packagetypes;

	}
	function getBedtype($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("SELECT * FROM bed");
		$stmt->execute();
		$bedtypes= array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($bedtypes,$row);
		}
		return $bedtypes;
	}
	
	
	function getPackagesBetweenDates($con,$from,$until){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt = $con->prepare("SELECT pkg.pkg_name,COUNT(pkg.pkg_id) as count FROM packages pkg, room rm, reservation rs WHERE 
								rs.room_id=rm.room_id AND pkg.pkg_id=rm.pkg_id AND rs.arrival_date BETWEEN ? AND ? GROUP BY pkg.pkg_id");
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
	function getPackageNames($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
			$stmt = $con->prepare("SELECT pkg_name FROM packages");
			$stmt->execute();
			$packageNames = array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($packageNames,$row);
			}
			return $packageNames;

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
	function checkNicExistance($con,$nic){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}


		}
		$stmt =$con->prepare("SELECT * FROM customer WHERE cus_id=?");
		$stmt->execute(array($nic));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();

	}
	function checkEmailExistance($con,$email){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}


		}
		$stmt =$con->prepare("SELECT cus_email FROM customer WHERE cus_email=?");
		$stmt->execute(array($email));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();

	}
	function checkUsernameExistance($con,$username){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}


		}
		$stmt =$con->prepare("SELECT * FROM cus_login WHERE cus_username=?");
		$stmt->execute(array($username));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->rowCount();

	}

	function getMaxAdultsAndChildrenCountsOfPkg($con,$pkgId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}


		}
		$stmt =$con->prepare("SELECT no_of_adults, no_of_children FROM packages WHERE pkg_id=?");
		$stmt->execute(array($pkgId));

		if($stmt->errorCode() != '00000') {
			return -1;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
	
	function getOverallRatingOfPkg($con, $pkg_id){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT ROUND(AVG(rating), 1) as rating FROM feedback_and_ratings WHERE pkg_id=?");

		$stmt->execute(array($pkg_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row['rating'];
    } 
    
}

?>