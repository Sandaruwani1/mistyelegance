<?php 
class PaymentModal{
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
}


?>