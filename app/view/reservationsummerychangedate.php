<?php
include 'sessionHandler.php';
include_once '../controller/ReservationController.php';
include_once '../controller/ModuleController.php';

$moduleController = new ModuleController();
$userModules = $moduleController->getUserModule($loggedUser['desig_id']);
if (!$userModules) {
    header("Location: logout.php?err=true");
}
/*
if (!isset($_GET['arr']) || !isset($_GET['lev']) || !isset($_GET['adults']) || !isset($_GET['children']) ||  !isset($_GET['pkg_id']) ||   !isset($_GET['cus_id']) ) {
    header("Location: reservation.php");
} else {
    */
$reservationController = new ReservationController();
$CusData = $reservationController->getPaymentByresId($_GET['resid']);
$PkgData = $reservationController->getPackageById($_GET['pkg_id']);
//}

//$packagecatdata = $customerController->getPackagetype();
//$beddata = $customerController->getBedtype();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Misty Elegance Ella</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../resources/images/logo.jpg">
    <link rel="shortcut icon" href="../resources/images/logo.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../resources/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../resources/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <!-- datatable -->
    <link rel="stylesheet" href="../resources/css/lib/datatable/dataTables.bootstrap.min.css">

    <!-- sweetalert css -->
    <link rel="stylesheet" type="text/css" href="../resources/sweetalert/sweetalert2.min.css" />

    <style>
        #weatherWidget .currentDesc {
            color: #ffffff !important;
        }

        .traffic-chart {
            min-height: 335px;
        }

        #flotPie1 {
            height: 150px;
        }

        #flotPie1 td {
            padding: 3px;
        }

        #flotPie1 table {
            top: 20px !important;
            right: -10px !important;
        }

        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #flotLine5 {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }

        #cellPaiChart {
            height: 160px;
        }
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>

                    <?php
                    foreach ($userModules as $userModule) {

                        $module = $userModule['module_name'];
                        $moduleIcon = $userModule['module_icon'];

                        if ($userModule['module_id'] != 1) {
                            $moduleClass = "";
                            if (($module . ".php") == 'reservation.php') {
                                $moduleClass = "active";
                            }
                    ?>
                            <li class="sub-menu <?php echo $moduleClass; ?>">
                                <a href="<?php echo $module; ?>.php">
                                    <i class="menu-icon fa <?php echo $moduleIcon; ?>"></i>
                                    <?php echo $module; ?>
                                </a>
                            </li>

                        <?php
                        } else {
                        ?>

                            <li class="sub-menu">
                                <a><i class="fa <?php echo $moduleIcon; ?> menu-icon"></i> <?php echo $module; ?></a>
                            </li><!-- /.menu-title -->
                            <li class="sub-menu children ml-4">
                                <a href="restuarant.php"> <i class="menu-icon fa fa-glass"></i> Restuarant</a>
                                <a href="food.php"> <i class="menu-icon fa fa-coffee"></i></i> Food</a>
                            </li>

                    <?php
                        }
                    }
                    ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php"><img src="../resources/images/logo.jpg" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="../resources/images/logo.jpg" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">

                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                if ($loggedUser['emp_image'] == "") {
                                    $userImage = "default.png";
                                } else {
                                    $userImage = $loggedUser['emp_image'];
                                }
                                ?>
                                <img class="user-avatar rounded-circle" src="../resources/images/users/<?php echo $userImage; ?>" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="profile.php?user_id=<?php echo $loggedUser['user_id']; ?>"><i class="fa fa- user"></i>My Profile</a>
                                <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-8">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-left">
                                    <li><a href="reservationcustomerform.php">Reservation Customer Info</a></li>
                                    <li>
                                        Reservation Summery
                                        <span style="color: #909396;"></span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="content">

            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        Confirm reservation
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title">Package: <?php echo $PkgData['pkg_name']; ?></h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title">Customer Name: <?php echo $CusData['cus_fname'] . " " . $CusData['cus_lname']; ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title">Arrival Date: <?php echo $_GET['arr']; ?></h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title">Leaving Date: <?php echo $_GET['lev']; ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title">Adults: <?php echo $_GET['adults']; ?></h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title">Children: <?php echo $_GET['children']; ?> </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <h4 class="card-title">Amount:<?php

                                                                $date1 = date_create($_GET['arr']);
                                                                $date2 = date_create($_GET['lev']);
                                                                $diff = date_diff($date1, $date2);
                                                                $dateCount = $diff->format("%a");
                                                                $rate = $PkgData['rate_per_night'] * $dateCount;
                                                                $advancePayment = 0;

                                                                if (($PkgData['discount_from'] <= date('Y-m-d') && $PkgData['discount_until'] >= date('Y-m-d'))) {

                                                                    echo  " $<del>$rate </del>" . "  " . "$" . $PkgData['discount'] * $dateCount;
                                                                    $advancePayment = ($PkgData['discount'] * $dateCount) * 0.25;
                                                                } else {


                                                                    echo " $" . $rate;
                                                                    $advancePayment = $rate * 0.25;
                                                                }

                                                                ?></h4>
                                
                                <h4 class="card-title">Earlier Payment that have done: $<?php echo $CusData['payment_amount'];?> </h4>
                                                                <?php
                                                                if($CusData['payment_amount']>$advancePayment){

                                                                    $credit_amount= ($CusData['payment_amount']-$advancePayment);
                                                                    echo "<h4 class=\"card-title\">credit Amount $:"  . round($credit_amount) . "</h4>";
                                                                }

                                                                if($CusData['payment_amount']< $advancePayment){

                                                                    $debit_amount= ($advancePayment-$CusData['payment_amount']);
                                                                     echo "<h4 class=\"card-title\">debit Amount $:" . round($debit_amount) . "</h4>";

                                                                }
                                                                if($CusData['payment_amount'] == $advancePayment){

                                                                    echo "<h4 class=\"card-title\">There is no credit or debit amount" . "</h4>";
                                                                }
                                                                ?>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title">Advance Payment: $<?php echo round($advancePayment); ?> </h4>
                                
                                
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">


                            </div>
                            <div class="col-sm-6" id="res-btns">

                                <button type="button" id="confirm-btn" class="btn btn-success">Confirm Reservation</button>
                                

                            </div>
                        </div>


                    </div>
                </div>

            </div><!-- .animated -->
        </div>
        <!-- .content -->
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../resources/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="../resources/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="../resources/js/init/fullcalendar-init.js"></script>

    <!-- datatable -->
    <script src="../resources/js/lib/data-table/datatables.min.js"></script>
    <script src="../resources/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../resources/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../resources/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../resources/js/lib/data-table/jszip.min.js"></script>
    <script src="../resources/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../resources/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../resources/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../resources/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../resources/js/init/datatables-init.js"></script>

    <!-- sweetalert js -->
    <script type="text/javascript" src="../resources/sweetalert/sweetalert2.min.js"></script>


    <!--Local Stuff-->
    <script type="text/javascript">
        $("#confirm-btn").click(function() {
            $.post('../ajax/reservationajax.php', {
                action: 'editReservation',
                arrival_date: '<?php echo $_GET['arr']; ?>',
                leaving_date: '<?php echo $_GET['lev']; ?>',
                adults: '<?php echo $_GET['adults']; ?>',
                children: '<?php echo $_GET['children']; ?>',
                cus_id: '<?php echo $CusData['cus_id']; ?>',
                pkg_id: '<?php echo $_GET['pkg_id']; ?>',
                res_id: '<?php echo $_GET['resid']; ?>'
            }, function(data) {
                console.log(data);
                if (data) {
                    data = $.parseJSON(data);
                    $("#res-btns").html(`<button type="button" class="btn btn-success" disabled><i class="fa fa-check" aria-hidden="true"></i> Confirmed</button>
                                            <button type=\"button\" class=\"btn btn-primary\" onclick=\"window.open('invoicepdf.php?payment_id=${data[0]}&prev_amount=${data[1]}&type=advance', '_blank')\">
                                                <i class=\"fa fa-file-text\" aria-hidden=\"true\"></i> Invoice
                                            </button>`)
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'System Error!',
                    });
                }

            });



        });
    </script>



</body>

</html>