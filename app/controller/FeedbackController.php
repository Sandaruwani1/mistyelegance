<?php 
include 'dbconnection.php';
include '../model/FeedbackModel.php';

class FeedbackController{
    private $con;
    private $feedbackModel;

    function feedbackController(){
        $this->con = DBConnection::dbconnect();
        $this->feedbackModel = new FeedbackModel();
    }
    function getFeedbackForpackages($package){
        return $this->feedbackModel->getFeedbackForpackages($this->con, $package);
    }
}
?>