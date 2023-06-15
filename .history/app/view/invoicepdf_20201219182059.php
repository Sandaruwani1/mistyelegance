<?php
include 'sessionHandler.php';
include_once '../controller/PaymentController.php';

$paymentController = new PaymentController();
$PaymentData = $paymentController->getPaymentById($_GET['payment_id']);

    $output="

    <!DOCTYPE html>
    <html>
    <head>
        <title>
            INVOICE - Misty Elegance Hotel
        </title>
    </head>
    <body style=\"margin: 0;\">

        <table width=\"100%\">
            <tr>
                <td style=\"width: 20%; text-align: center;\">
                    <img src=\"../resources/images/logo.jpg\" width=\"50%\" />
                </td>
                <td style=\"width: 80%; text-align: center;\">
                    <h1 text-align:center; >Misty Elegance Hotel </h1>
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

        <h2 style=\"text-align: center;\">Invoice</h2>

        <table width=\"100%\">
            <tr>
                <td style=\"width: 80%; padding: 10px 50px;\">
                    <span>
                        Guest Name: " . $PaymentData['cus_fname'] . " " . $PaymentData['cus_lname'] . "<br/>
                        
                        Contact No: " . $PaymentData['cus_tel'] . "
                    </span>
                </td>
                <td style=\"width: 20%; padding: 10px;\">
                    <p style=\"font-weight: bold;\">payment No: " . $_GET['payment_id'] . "</p>
                    <p style=\"font-weight: bold;\">Date:" . date('Y-m-d') . "</p>
                </td>
            </tr>
        </table>

        <br/>

        <table width=\"90%\" style=\"border: 1px solid black;\" cellpadding=\"5\" cellspacing=\"0\" align =\"center\">
            <thead>
                <tr style=\"text-align: center; background-color: black; color: white;\">
                    
                    <td style=\"width: 70%\">Description</td>
                    <td style=\"width: 15%\">Amount</td>
                </tr>
            </thead>
            <tbody>
        
                <tr>
                    
                    <td style=\"padding: 25px 5px; border-right: 1px solid black; font-size: 18px;\">" . $PaymentData['pkg_name'] .  "(" . $PaymentData['arrival_date'] . "-" . $PaymentData['leaving_date'] . ")
                    </td>
                    <td style=\"padding: 5px; text-align: right; font-size: 20px;\">$" . $PaymentData['payment_amount'] . "</td>
                </tr>
                
            </tbody>
        </table>

        <br /><br />

        <p style=\"padding-left: 50px;\">
        
            <br/>
            Handled By: " . $loggedUser['user_name'] . "<br/>
            
        </p>

        <br /><br />

        <hr/>

        <p style=\"text-align: center;\">***This is a Computer Generated Document***</p>

    </body>
    </html>
    
    ";

   ///////////////////////////////////////////////////////////////////////

    //Include autoloader
    require_once("../resources/dompdf/autoload.inc.php");

    //reference the dompdf namespace
    use Dompdf\Dompdf;
    $dompdf  = new Dompdf();

    $options = $dompdf->getOptions();
    $options->setIsRemoteEnabled(true);
    $options->setIsHtml5ParserEnabled(true);

    $dompdf->loadHtml($output);
    //setup papaer size

    $dompdf->setPaper('A4','portrait');
    //render the html as PDF
    $dompdf->render();

    //output the generated Pdf
    $dompdf->stream("INVOICE - " . $_GET['payment_id'],array("Attachment"=>0));



?>