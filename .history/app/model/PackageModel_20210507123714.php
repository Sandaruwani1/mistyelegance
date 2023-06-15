<?php
class PackageModel{
    function getAllpackages($con){
        if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
        }
        $stmt = $con->prepare("SELECT pkg.pkg_id, pkg.pkg_name, pkg.rate_per_night, pkg.discount FROM packages pkg, package_cat pkgc WHERE pkg.pkg_cat_id=pkgc.pkgc_pkg_cat_id");
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
	function addPackage($con,$data){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}

		$pkg_name=$data['pkg-name'];
		$pkg_type=$data['pkg-cat-id'];
		$no_of_adults=$data['no-of-adults'];
		$no_of_children=$data['no-of-children'];
		$rate_per_night=$data['rates-per-night'];
		$pkg_description=$data['pkg-description'];
		$number_of_beds=$data['no-of-beds'];
		$room_size = $data['room-size'];
		$services = $data['services'];
		$bed_type = $data['bed-id'];

		$stmt = $con->prepare("INSERT INTO packages (pkg_name,pkg_cat_id, no_of_children, no_of_adults, rate_per_night,bed_id,pkg_des,no_of_bed,size_of_rooms,services,is_deleted 
							 ) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		
		$stmt->execute(array($pkg_name, $pkg_type,$no_of_children, $no_of_adults, $rate_per_night, $bed_type, $pkg_description, $number_of_beds,  
							$room_size, $services,  0));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;
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
	function updatePackage($con,$pkgUpdatedata){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$pkg_name=$pkgUpdatedata['pkg-name'];
		$pkg_type=$pkgUpdatedata['pkg-cat-id'];
		$no_of_adults=$pkgUpdatedata['no-of-adults'];
		$no_of_children=$pkgUpdatedata['no-of-children'];
		$rate_per_night=$pkgUpdatedata['rates-per-night'];
		$pkg_description=$pkgUpdatedata['pkg-desc'];
		$number_of_beds=$pkgUpdatedata['No-of-beds'];
		$room_size = $pkgUpdatedata['room-size'];
		$services = $pkgUpdatedata['services'];
		$bed_type = $pkgUpdatedata['bed-id'];
		$pkg_id =$pkgUpdatedata['pkg-id'];
		

		$stmt = $con->prepare("UPDATE packages SET pkg_name=?,pkg_cat_id=?, no_of_children=?, no_of_adults=?, rate_per_night=?,bed_id=?,pkg_des=?,no_of_bed=?,size_of_rooms=?,services=?,is_deleted=?
							 WHERE pkg_id=?");
		$stmt->execute(array($pkg_name, $pkg_type,$no_of_children, $no_of_adults, $rate_per_night, $bed_type, $pkg_description, $number_of_beds,  
		$room_size, $services,  0, $pkg_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}
		return true;
	    

	}
	function deletePackage($con,$pkgId){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("UPDATE packages SET is_deleted=1 WHERE pkg_id=?");

		$stmt->execute(array($pkgId));

		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;

	}
	function addDiscountpackage($con,$pkgId,$discount,$discount_from,$discount_until,$discounted_price ){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("UPDATE packages SET discount_rate=?, discount=? , discount_from=? ,discount_until=? WHERE pkg_id=?");
		$stmt->execute(array($discount,$discounted_price,$discount_from,$discount_until,$pkgId));

		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;

	}
	function removeDiscounts($con,$pkgId){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("UPDATE packages SET discount=0, discount_rate=NULL, discount_from=NULL, discount_until=NULL WHERE pkg_id=?");

		$stmt->execute(array($pkgId));

		if($stmt->errorCode() != '00000') {
			return false;
		}
		return true;

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

	function getPackagesByReservationCount($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
		$stmt = $con->prepare("SELECT pkg.pkg_name as pkg_name, COUNT(rs.res_id) AS COUNT FROM packages pkg, room rm, reservation rs 
								WHERE pkg.pkg_id=rm.pkg_id AND rm.room_id=rs.room_id GROUP BY pkg.pkg_name");
		$stmt->execute();
		$result = array();
        $resultArray = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $result[0] = $row['pkg_name'];
            $result[1] = (int)$row['COUNT'];
            array_push($resultArray, $result);
		}

		return $resultArray;
	}
	function getTodaydiscounts($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT pkg_name, discount_rate FROM packages WHERE now() BETWEEN discount_from AND discount_until");

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

	
    
}

?>