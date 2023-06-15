<?php
include 'dbconnection.php';
include '../model/PackageModel.php';

class PackageController{
    private $con;
	private $packageModel;

	function PackageController(){
		$this->con = DBConnection::dbConnect();
		$this->packageModel = new PackageModel();
	}

    function getAllPackages(){
        return $this->packageModel->getAllPackages($this->con);
	}
	
	function addPackage($data, $files){

		if(!$this->packageModel->addPackage($this->con, $data)){
			header("Location: package.php?err");
		}
		if($files['image']){

		
			$output_dir = "../../resources/images/packages/";
			$fileCount = count($files["image"]["name"]);
			$last_id = $this->con->lastInsertId();

			for($i=0; $i < $fileCount; $i++){
				$tmp = explode(".", $files["image"]["name"][$i]);
				$extension = end($tmp);

				$NewImageName = $last_id.'-'.($i + 1).'.'.$extension;

				
				if (!file_exists($output_dir . $last_id))
				{
					mkdir($output_dir . $last_id, 0777);
				}
							
				move_uploaded_file($files["image"]["tmp_name"][$i],$output_dir.$last_id."/".$NewImageName );
					
					
			}
	    }

	 header("Location: package.php");
	
		
	}
	function getPackage($pkg_id){
		return $this->packageModel->getPackageById($this->con,$pkg_id);
	}

	function getPackagetype(){
		return $this->packageModel->getPackagetype($this->con);
	}

	function getBedtype(){
		return $this->packageModel->getBedtype($this->con);
	}

	function updatePackage($pkgUpdatedata,$files){
		if(!$this->packageModel->updatePackage($this->con, $pkgUpdatedata)){
			header("Location: package.php?err");
		}

		if($files['image']){
			$image_count=1;
			$output_dir = "../../resources/images/packages/";
			$folderpath=$output_dir.$pkgUpdatedata['pkg-id'];
			$fileCount = count($files["image"]["name"]);

			
			if(file_exists($folderpath)){
				
				$countfiles=count(glob("$folderpath/*"));

				$image_count= $countfiles +1;


			}else{
				mkdir($output_dir . $pkgUpdatedata['pkg-id'], 0777);
			}

			for($i=0; $i < $fileCount; $i++){

				$tmp = explode(".", $files["image"]["name"][$i]);
				$extension = end($tmp);

				$NewImageName = $pkgUpdatedata['pkg-id'].'-'.$image_count.'.'.$extension;

					
				move_uploaded_file($files["image"]["tmp_name"][$i], $folderpath."/".$NewImageName );
					
				$image_count++;
					
			}

		}

		header("Location: viewpackage.php?pkg_id=" . $pkgUpdatedata['pkg-id']);
	}
	function deletePackage($pkgId){
		return $this->packageModel->deletePackage($this->con,$pkgId);
	}
	function addDiscountpackage($pkgId,$discount,$discount_from,$discount_until){

		$rowpkg = $this->packageModel->getPackageById($this->con, $pkgId);
		$current_rate = $rowpkg['rate_per_night'];
		$discounted_price = round($current_rate*(100-$discount)/100);

		if($this->packageModel->addDiscountpackage($this->con, $pkgId,$discount,$discount_from,$discount_until,$discounted_price)){
			return 1;
		}else{
			return 0;
		}

	}
	function removeDiscount($pkgId){
		
		return $this->packageModel->removeDiscounts($this->con, $pkgId);
		
	}
	function getPackagesBetweenDates($from,$until){
		
		return $this->packageModel->getPackagesBetweenDates($this->con, $from,$until);
		
	}
	function getPackageNames(){
		return $this->packageModel->getPackageNames($this->con);
	}

	function getPackagesByReservationCount(){
        $data = $this->packageModel->getPackagesByReservationCount($this->con);
        $result = array();
        $result[0] = array('Package', 'Reservations');
        foreach($data as $row){
            array_push($result, $row);
        }
        return $result;
    }
	

	
    
}
