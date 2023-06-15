<?php 
include 'dbconnection.php';
include '../model/RoomModel.php';

class RoomController{
    private $con;
    private $roomModel;

    function RoomController(){
        $this->con =dbconnection::dbconnection();
        $this->roomModel = new RoomModel();
    }

}

?>