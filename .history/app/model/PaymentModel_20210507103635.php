<?php 
class PaymentModel{
    function addPayment($con,$amount,$res_id){
        
            if($con->errorCode() != null){
                if($con->errorCode() != '00000'){
                    return false;
                }
            }
            
            $stmt = $con->prepare("INSERT INTO payment ( payment_date, payment_amount, payment_time, res_id ) VALUES( NOW(),?,NOW(),?)");
            
            $stmt->execute(array($amount,$res_id));
    
            if($stmt->errorCode() != '00000') {
                return false;
            }
    
            return true;
    
        
    }
    function getPaymentById($con,$payment_id){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT * FROM payment p, reservation res, customer cus, room rm, packages pkg WHERE p.res_id=res.res_id AND res.cus_id=cus.cus_id AND rm.room_id=res.room_id AND pkg.pkg_id=rm.pkg_id AND payment_id=? ");

        $stmt->execute(array($payment_id));

        if($stmt->errorCode() != '00000') {
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);


    

    }
    function getPaymentForpackages($con,$year){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT pkg.pkg_name,SUM(rs.res_amount) as count FROM packages pkg, room rm, reservation rs WHERE 
        rs.room_id=rm.room_id AND pkg.pkg_id=rm.pkg_id AND YEAR(rs.res_date)=? GROUP BY pkg.pkg_id");

		$stmt->execute(array($year));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
	


    }
    function getPaymentByresId($con,$res_id){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT * FROM payment p, reservation res, customer cus, room rm, packages pkg WHERE p.res_id=res.res_id
                             AND res.cus_id=cus.cus_id AND rm.room_id=res.room_id AND pkg.pkg_id=rm.pkg_id AND res.res_id=? ");

        $stmt->execute(array($res_id));

        if($stmt->errorCode() != '00000') {
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);



    }

    function deletePaymentById($con, $paymentId){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("DELETE FROM payment WHERE payment_id=?");

        $stmt->execute(array($paymentId));

        if($stmt->errorCode() != '00000') {
            return false;
        }
        return true;
    }

    function getFoodsByPaymentId($con, $paymentId){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT f.food_name, fr.price FROM food f, food_reservation fr, reservation r, payment p WHERE p.res_id=r.res_id AND r.res_id=fr.res_id AND fr.food_id=f.food_id AND p.payment_id=?");

        $stmt->execute(array($paymentId));

        if($stmt->errorCode() != '00000') {
            return false;
        }
        $result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}

		return $result;
    }

    function getLastYearMonthlyIncome($con){
		if($con->errorCode() != null){
			if($con->errorCode() != '00000'){
				return false;
			}
		}

		$stmt = $con->prepare("SELECT DATE_FORMAT(payment_date,'%M %Y') AS MONTH, COUNT(payment_date) AS COUNT FROM payment 
        WHERE payment_date BETWEEN ? AND NOW() GROUP BY DATE_FORMAT(payment_date,'%M %Y')");

		$stmt->execute(array(date('Y-m-d', strtotime('-1 years'))));

		if($stmt->errorCode() != '00000'){
			return false;
		}

		$result = array();
        $resultArray = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $result[0] = $row['MONTH'];
            $result[1] = (int)$row['COUNT'];
            array_push($resultArray, $result);
		}

		return $resultArray;
	


    }
    function getFullrevenue($con,$res_id){
        if($con->errorCode() != null){
            if($con->errorCode() != '00000'){
                return false;
            }
        }
        $stmt = $con->prepare("SELECT SUM(payment_amount) FROM payment");


        if($stmt->errorCode() != '00000') {
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);



    }

    
}


?>