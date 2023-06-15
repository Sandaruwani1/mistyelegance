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
        if($currentLatestgetRoomNo == -1){
            return -1;
        }

        $newRoomNo= "R001";

        if($currentLatestgetRoomNo){
            $num = substr($currentLatestgetRoomNo, 1);
            $num++;
            $newRoomNo = "R" . str_pad($num, 3, "0", STR_PAD_LEFT);
        }
	    return $newRoomNo;
    
    
    
    }
    function addRoom($data){
        if(!$this->roomModel->addRoom($this->con, $data)){
			header("Location: room.php?err");
        }
        header("Location: room.php");
    }
    function getRoom($roomID){

		return $this->roomModel->getRoom($this->con, $roomID);
	}

}

?>