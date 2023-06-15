<?php
include 'sessionHandler.php';

    if(!isset($_GET['type'])){
        header("Location: report.php");
    }

    $reportType = "";
    $output = "<!DOCTYPE html>
        <html>
        <head>
            <title>Report</title>
            <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" 
            integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">
        </head>
        <body>
            <table width=\"100%\">
                <tr>
                    <td style=\"width: 20%; text-align: center;\">
                        <img src=\"http://localhost/mistyelegance/app/resources/images/logo.jpg\" width=\"50%\" />
                    </td>
                    <td style=\"width: 80%; text-align: center;\">
                        <h1 class=\"h1\" >Misty Elegance  </h1>
                        
                    </td>
                </tr>
            </table>
        
            <hr />";

// ================================================

    if($_GET['type'] == 'reservation_analysis'){
        $reportType = "Reservation Analysis";
        include_once('../controller/ReservationController.php');
        $controller = new ReservationController();
        $data = $controller->getReservationsBetweenDates($_GET['from'], $_GET['until']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['res_id'] . "</td>
                    <td>" . $row['cus_id'] . "</td>
                    <td>" . $row['cus_fname'] . " " . $row['cus_lname'] . "</td>
                    <td>" . $row['cus_country'] . "</td>
                    <td>" . $row['pkg_name'] . "</td>
                    <td>" . $row['arrival_date'] . "</td>
                    <td>" . $row['leaving_date'] . "</td>
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['from'] . " - " . $_GET['until'] . "</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Reservation Id</th>
                            <th scope=\"col\">Customer NIC</th>
                            <th scope=\"col\">Customer Name</th>
                            <th scope=\"col\">Customer Country</th>
                            <th scope=\"col\">Package Name</th>
                            <th scope=\"col\">Arrived Date</th>
                            <th scope=\"col\">Leave Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'reservation_analysisByyear'){
        $reportType = "Reservation Analysis";
        include_once('../controller/ReservationController.php');
        $controller = new ReservationController();
        $data = $controller->getReservationcountForYear($_GET['from'], $_GET['until']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td class=\"text-center\">" . $row['year'] . "</td>
                    <td class=\"text-center\">" . $row['count'] . "</td>
                 </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['from'] . " - " . $_GET['until'] . "</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\" class=\"text-center\">Reservation Year</th>
                            <th scope=\"col\" class=\"text-center\">Number Of Reservations</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'package_analysis'){
        $reportType = "Package Analysis";
        include_once('../controller/PackageController.php');
        $controller = new PackageController();
        $data = $controller->getPackagesBetweenDates($_GET['from'], $_GET['until']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['pkg_name'] . "</td>
                    <td>" . $row['count'] . "</td>
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['from'] . " - " . $_GET['until'] . "</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Package Name</th>
                            <th scope=\"col\">Count</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'payment_analysis'){
        $reportType = "Payment Analysis";
        include_once('../controller/PaymentController.php');
        $controller = new PaymentController();
        $data = $controller->getPaymentForpackages($_GET['year']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['pkg_name'] . "</td>
                    <td>" . $row['count'] . "</td>
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['year'] . "</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Package Name</th>
                            <th scope=\"col\">Reservation Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'feedback_analysis'){
        $reportType = "Feedback Analysis";
        include_once('../controller/FeedbackController.php');
        $controller = new FeedbackController();
        $data = $controller->getFeedbackForpackages($_GET['package']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['pkg_name'] . "</td>
                    <td>" . $row['rating'] . "</td>
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['package']."</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Package Name</th>
                            <th scope=\"col\">Rating</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'customer_analysis'){
        $reportType = "Customer Analysis";
        include_once('../controller/CustomerController.php');
        $controller = new CustomerController();
        $data = $controller->getCustomerForpackages($_GET['cusId'], $_GET['year']);
        $cusdata=$controller->getCustomer($_GET['cusId']);

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['pkg_name'] . "</td>
                    <td>" . $row['count'] . "</td>
                    
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['cusId'] . " - ".$cusdata['cus_fname']." ".$cusdata['cus_lname']."- " . $_GET['year'] . "</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Package Name</th>
                            <th scope=\"col\">Reservered Times</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'customer_analysisCount'){
        $reportType = "Customer Analysis";
        include_once('../controller/CustomerController.php');
        $controller = new CustomerController();
        $data = $controller->getCustomerRegistrationcount($_GET['from'], $_GET['until']);
        

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['cus_fname'] . "  " . $row['cus_lname'] . "</td>
                    
                    <td>" . $row['count'] . "</td>
                    
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['from'] . " - ".$_GET['until']."</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Customer Name</th>
                            
                            <th scope=\"col\">Reservation Count</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
    if($_GET['type'] == 'food_analysisCount'){
        $reportType = "Food Analysis";
        include_once('../controller/FoodController.php');
        $controller = new FoodController();
        $data = $controller->getFoodReservationcount($_GET['from'], $_GET['until']);
        

        $htmlData = "";

        foreach($data as $row){
            $htmlData .= "
                <tr>
                    <td>" . $row['food_name'] . "  </td>
                    
                    <td>" . $row['count'] . "</td>
                    
                    
                </tr>
            ";
        }

        $output .= "
            <h4 style=\"text-align: center;\">" . $reportType . "</h4>
            <h6 style=\"text-align: center;\">" . $_GET['from'] . " - ".$_GET['until']."</h6>

            <table width=\"100%\">
                <tr>
                <td>
                    <b>Generated Date: </b>" . date('Y-m-d')  ."
                    <br/>
                <b>Generated By: </b>" . $_SESSION['user_info']['emp_fname'] . " " . $_SESSION['user_info']['emp_lname'] . "
                </td>
                </tr>

            </table>

                <br/>
                <table class=\"table table-striped\">
                    <thead>
                        <tr>
                            <th scope=\"col\">Food Name</th>
                            
                            <th scope=\"col\">Reservation Count</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        " . $htmlData . "
                    </tbody>
                </table>
        ";


    }
   
   
   
   


    

    

// ================================================

    $output .= "
        <br /><br />

        <hr/>

        <p style=\"text-align: center;\">***This is a Computer Generated Document***</p>

    </body>
    </html>";

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

    $dompdf->setPaper('A4','landscape');
    //render the html as PDF
    $dompdf->render();

    //output the generated Pdf
    $dompdf->stream("Report - " . $reportType,array("Attachment"=>0));



?>