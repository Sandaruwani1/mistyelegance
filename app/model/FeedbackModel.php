<?php 
class FeedbackModel{
    
        function getFeedbackForpackages($con,$package){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT pkg.pkg_name, f.rating, f.feedback,  CONCAT(c.cus_fname ,c.cus_lname) as cusname  FROM packages pkg, feedback_and_ratings f,customer c WHERE pkg.pkg_id=f.pkg_id  AND f.cus_id=c.cus_id AND f.cus_id=c.cus_id AND pkg.pkg_id=?");

		$stmt->execute(array($package));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
	


	}
	//SELECT pkg.pkg_name, AVG(f.rating) as rating FROM packages pkg, feedback_and_ratings f 
                             //  WHERE pkg.pkg_id=f.pkg_id AND f.feedback_date BETWEEN ? AND ? GROUP BY pkg.pkg_name
    
}


?>