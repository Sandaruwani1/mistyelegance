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

}

?>