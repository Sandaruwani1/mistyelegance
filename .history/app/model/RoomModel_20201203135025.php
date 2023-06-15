<?php
class RoomModel
{
	function getAllRooms($con)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return false;
			}
		}
		$stmt = $con->prepare("SELECT r.room_no, pkg.room_id, r.room_status, r.room_id FROM room r ,packages pkg WHERE r.pkg_id=pkg.pkg_id ");

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
	function getPackageName($con)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return false;
			}
		}
		$stmt = $con->prepare("SELECT pkg_id, room_id FROM packages ");
		$stmt->execute();
		$packageName = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($packageName, $row);
		}
		return $packageName;
	}
	function getRoomNo($con)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return -1;
			}
		}

		$stmt = $con->prepare("SELECT room_no FROM room ORDER BY room_no DESC LIMIT 1");
		$stmt->execute();
		if ($stmt->errorCode() != '00000') {
			return -1;
		}

		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['room_no'];
		}

		return 0;
	}
	function addRoom($con, $data)
	{
		if ($con->errorCode() != null) {
			if ($con->errorCode() != '00000') {
				return -1;
			}
		}
		$room_no = $data['room-no'];
		$pkg_id = $data['pkg-id'];

		$stmt = $con->prepare("INSERT INTO room (room_no,pkg_id,room_status ) VALUES(?,?,?)");

		$stmt->execute(array(
			$room_no, $pkg_id, 1
		));
	}
	function getRoom($con,$room_id){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}
		$stmt = $con->prepare("SELECT * FROM packages pkg , room r WHERE pkg.pkg_id=r.room_id AND room_id=?");
		$stmt->execute(array($room_id));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
