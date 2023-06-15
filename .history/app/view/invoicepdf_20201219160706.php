<?php
include 'sessionHandler.php';
include_once '../controller/ReservationController.php';

$paymentController = new PaymentController();
$CusData = $paymentController->getPaymentById($_GET['payment_id']);


?>

<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<body style="margin: 0;">

	<table width="100%">
		<tr>
			<td style="width: 20%; text-align: center;">
				<img src="../resources/images/logo.jpg" width="50%" />
			</td>
			<td style="width: 80%; text-align: center;">
				<h1 class="h1" text-align:center; >Misty Elegance Hotel </h1>
				<p> Misty Elegance,
				  N0.76,
                  Police Station Road ,
                  Ambagolla,
				  Ella,
				  <br/>
				  TEl: 077-207 12 10 / 077-048 09 77.<br/>
				  Email: info@artlee.com
				</p>
			</td>
		</tr>
	</table>

	<hr />

	<h2 style="text-align: center;">Invoice</h2>

	<table width="100%">
		<tr>
			<td style="width: 80%; padding: 10px 50px;">
				<span>
					Dasun Enterprices<br/>
					No 3<br/>Main road<br />Panadura.<br/>
					0711111111
				</span>
			</td>
			<td style="width: 20%: padding: 10px;">
				<p style="font-weight: bold;">payment No: <?php echo $_GET['payment_id'];?></p>
				<p style="font-weight: bold;">Date: <?php echo date('Y-m-d');?></p>
			</td>
		</tr>
	</table>

	<br/>

	<table width="90%" style="border: 1px solid black;" cellpadding="5" cellspacing="0" align ="center">
		<thead>
			<tr style="text-align: center; background-color: black; color: white;">
				
				<td style="width: 70%">Description</td>
				<td style="width: 15%">Amount</td>
			</tr>
		</thead>
		<tbody>
        <tr>
				
                <td style="padding: 25px 5px; border-right: 1px solid black;">Package Name
                </td>
				
			</tr>

			<tr>
				
                <td style="padding: 25px 5px; border-right: 1px solid black;">Advanced Payment
                </td>
				<td style="padding: 5px; text-align: right;">50000.00</td>
            </tr>
            
		</tbody>
	</table>

	<br />

	<h3 style="text-align: right; padding-right: 50px;">Total: 200000.00</h3>

	<br /><br />

    <p style="padding-left: 50px;">
    
		<br/>
		Handled By: <?php echo $loggedUser['user_name'];?><br/>
		
	</p>

	<br /><br />

	<hr/>

	<p style="text-align: center;">***This is a Computer Generated Document***</p>

</body>
</html>