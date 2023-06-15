<?php
include 'dbconnection.php';
include './model/PackagesModel.php';

class PackagesController{
    private $con;
	private $packagesModel;

	function PackagesController(){
		$this->con = DBConnection::dbConnect();
		$this->packagesModel = new PackagesModel();
	}

    function getAllPackages(){
        return $this->packagesModel->getAllPackages($this->con);
	}
	
	function getPackage($pkg_id){
		$packages = $this->packagesModel->getPackageById($this->con,$pkg_id);
		$imagesArray = array();
		if(file_exists("./resources/images/packages/" . $pkg_id)) {
			$images = scandir("./resources/images/packages/" . $pkg_id);
			
			if ($images) {
				for($i = 2; $i < count($images); $i++){
					array_push($imagesArray,  $images[$i]);
				}
			}
		}
		$packages['imageArray'] = $imagesArray;
		return $packages;
	}
	function checkNicEmailUsernameExistence($nic,$email,$username){
		$isNicExist = $this->packagesModel->checkNicExistance($this->con, $nic);
		$isEmailExist= $this->packagesModel->checkEmailExistance($this->con, $email);
		$isUsernameExist = $this->packagesModel->checkUsernameExistance($this->con,$username);
		$sum=0;
		if($isEmailExist == -1 || $isNicExist == -1 || $isUsernameExist == -1){
			return -1;
		}
		if($isUsernameExist){
			 $sum +=1;
		}
		if($isNicExist){
			$sum += 2;
		}
		if($isEmailExist){
			$sum += 4;
		}
		 return $sum;

	}
	

	function getPkg($pkg_id){
		return $this->packagesModel->getPackageById($this->con,$pkg_id);
	}

	function getBedtype(){
		return $this->packageModel->getBedtype($this->con);
	}
    function getAvailablePkgs($arrival_date, $leaving_date, $adults, $children){
        return $this->packagesModel->checkAvailability($this->con, $adults, $children, $arrival_date, $leaving_date);
      }
  
	  function getMaxAdultsAndChildrenCountsOfPkg($pkg_id){
		return $this->packagesModel->getMaxAdultsAndChildrenCountsOfPkg($this->con,$pkg_id);
	}	
	function getOverallRatingOfPkg($pkg_id){
		return $this->packagesModel->getOverallRatingOfPkg($this->con,$pkg_id);
	}
    
}
