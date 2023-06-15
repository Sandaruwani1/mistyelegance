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
}
?>