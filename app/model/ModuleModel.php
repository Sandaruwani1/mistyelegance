<?php

class ModuleModel{

	function getUserModule($con, $desigID){

		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT * FROM module_designation md, module m WHERE md.module_id=m.module_id AND md.desig_id=?");

		$stmt->execute(array($desigID));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$modules = array();

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($modules, $result);
		}

		return $modules;

	}

}


?>