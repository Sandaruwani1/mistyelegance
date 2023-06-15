<?php
class RoomModel{
    function getAllRooms($con){
        if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
        }
        $stmt = $con->prepare("SELECT r.room_no, pkg.pkg_name, r.room_status, r.room_id FROM room r ,packages pkg WHERE r.pkg_id=pkg.pkg_id ");
         
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
	function getPackageName($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}

		}
			$stmt = $con->prepare("SELECT pkg_id, pkg_name FROM packages ");
			$stmt->execute();
			$packageName = array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($packageName,$row);
			}
			return $packageName;

	}
	function getRoomNo($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return -1;
			}

		}
		
		$stmt =$con->prepare("SELECT room_no FROM rom ORDER BY room_no DESC LIMIT 1");
		$stmt->execute();
		if($stmt->errorCode() != '00000'){
			return -1;
		}
		
		if( $stmt->rowCount() == 1){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			return $row['room_no'];
		}

		return 0;


	}

}
?>