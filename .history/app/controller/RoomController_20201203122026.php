<?php 
include 'dbconnection.php';
include '../model/RoomModel.php';

class RoomController{
    private $con;
    private $roomModel;

    function RoomController(){
        $this->con =DBConnection::dbConnect();
        $this->roomModel = new RoomModel();
    }
    function getAllRooms(){
        return $this->roomModel->getAllRooms($this->con);
    }
    function getPackageName(){
		return $this->roomModel->getPackageName($this->con);
			
		
    }
    function selectRoomNumber(){

        $currentLatestgetRoomNo = $this->roomModel->getRoomNo($this->con);

        $newRoomNo= "R001";

        if($currentLatestRoomNo){
            $num = substr($currentLatestRoomNo, 1);
            $num++;
            $newRoomNo = "R" . str_pad($num, 3, "0", STR_PAD_LEFT);
        }
	        return $newRoomNo;
    
    
    
    }

}

?>