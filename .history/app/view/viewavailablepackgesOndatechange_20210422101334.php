<?php
include 'sessionHandler.php';
include_once '../controller/ReservationController.php';
include_once '../controller/ModuleController.php';

$moduleController = new ModuleController();
$userModules = $moduleController->getUserModule($loggedUser['desig_id']);
if (!$userModules) {
    header("Location: logout.php?err=true");
}
if (!isset($_GET['arr']) || !isset($_GET['lev']) || !isset($_GET['adults']) || !isset($_GET['children'])) {
    header("Location: reservation.php");
} else {
    $reservationController = new ReservationController();
    $availablePkgData = $reservationController->getAvailablePkgs($_GET['arr'], $_GET['lev'], $_GET['adults'], $_GET['children']);
}
//$packagecatdata = $reservationController->getPackagetype();
//$beddata = $reservationController->getBedtype();
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
                            if (($module . ".php") == 'package.php') {
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
                                        <li><a href="reservation.php">Reservation</a></li>
                                        <li>
                                            Available Packages
                                            <span style="color: #909396;">[ From: <?php echo $_GET['arr']; ?> | To: <?php echo $_GET['lev']; ?> ]</span>
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

                <div class="row">
                    <!-- <div class="col-lg-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../../resources/images/packages/" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" value="<?php// echo $availablePkgData['pkg_name']; ?>"></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">View Package</a>
                                <a href="#" class="btn btn-primary">Reserve</a>
                            </div>
                        </div>

                    </div> -->

                    <?php
                    if (count($availablePkgData) > 0) {
                        foreach ($availablePkgData as $availablePkg) {
                    ?>
                            <div class="col-sm-6 my-4">
                                <div class="card">
                                    <img class="card-img-top" src="" alt="">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="card-title"><?php echo $availablePkg['pkg_name'] ?></h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <?php
                                                    if (file_exists("../../resources/images/packages/" . $availablePkg['pkg_id'])) {
                                                        $images = scandir("../../resources/images/packages/" . $availablePkg['pkg_id']);
                                                        if ($images) {
                                                    ?>
                                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                                <ol class="carousel-indicators">
                                                                    <?php
                                                                        for($i = 0; $i < count($images); $i++){
                                                                    ?>
                                                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php echo($i == 0)? "class=\"active\"": ""; ?>></li>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    <?php
                                                                        for($i = 2; $i < count($images); $i++){
                                                                    ?>
                                                                    <div class="carousel-item <?php echo ($i == 2)? 'active': ''; ?>">
                                                                        <img class="d-block w-100" style="height: 250px;" src="<?php echo "../../resources/images/packages/" . $availablePkg['pkg_id'] . "/" . $images[$i]; ?>" alt="First slide">
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-6">
                                                    <p class="card-text"><b>No Of Adults:</b> <?php
                                                                                                for ($i = 0; $i < $availablePkg['no_of_adults']; $i++) {
                                                                                                    echo "<i class=\"fa fa-male\" aria-hidden=\"true\"></i> ";
                                                                                                }
                                                                                                ?></p>
                                                    <p class="card-text"><b>No Of Children:</b> <?php
                                                                                                for ($i = 0; $i < $availablePkg['no_of_children']; $i++) {
                                                                                                    echo "<i class=\"fa fa-child\" aria-hidden=\"true\"></i>";
                                                                                                }

                                                                                                ?></p>
                                                    <p class="card-text"><b>Rate Per Night:</b> $<?php echo $availablePkg['rate_per_night'] ?></p>
                                                    <p class="card-text"><b>Discount:</b> <?php 
                                                        $isDiscountAvailable = false; 
                                                        if(($availablePkg['discount_from'] <= date('Y-m-d') && $availablePkg['discount_until'] >= date('Y-m-d'))){
                                                            $isDiscountAvailable = true;
                                                            echo $availablePkg['discount_rate'] . '% [$' . $availablePkg['discount'] .']';
                                                        }
                                                         ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="card-text"><b>No Of Beds:</b> <?php
                                                                                            for ($i = 0; $i < $availablePkg['no_of_bed']; $i++) {
                                                                                                echo "<i class=\"fa fa-bed\" aria-hidden=\"true\"></i> ";
                                                                                            }
                                                                                            ?>
                                                    </p>

                                                    <p class="card-text"><b>Services:</b> <?php echo $availablePkg['services'] ?></p>

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <p class="card-text"><b>Description:</b> <?php echo $availablePkg['pkg_des'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right font-weight-bold" style="font-size: 20px;">
                                                    Amount: <span class="text-info"><?php 
                                                        $date1=date_create($_GET['arr']);
                                                        $date2=date_create($_GET['lev']);
                                                        $diff=date_diff($date1,$date2);
                                                        $dateCount = $diff->format("%a");
                                                        $rate = $availablePkg['rate_per_night'] * $dateCount;
                                                        echo ($isDiscountAvailable)? '<del>$' . $rate . '</del>': '$' . $rate;
                                                    ?></span>
                                                    <?php
                                                        if($isDiscountAvailable){
                                                            echo "<span style='font-size: 24px;' class='text-success'>$" . ($availablePkg['discount'] * $dateCount) . "<span>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <a href="reservationsummerychangedate.php?<?php echo 'arr=' . $_GET['arr'] . '&lev=' . $_GET['lev'] . '&adults=' . $_GET['adults'] . '&children=' . $_GET['children'] . '&pkg_id=' . $availablePkg['pkg_id'] . '&resid=' .$_GET['resid']; ?>" style="width: 100%;" class="btn btn-primary">Reserve</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

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
        $("#updatePackageForm").submit(function(event) {
            event.preventDefault();
            var package_catId = $("#pkg-cat-id").val();
            var no_of_adults = $("#no-of-adults").val();
            var no_of_children = $("#no-of-children").val();
            var rate_per_night = $("#rates-per-night").val();
            var bed_id = $("#bed-id").val();

            if (package_catId == 0) {
                $("#pkg-cat-id-error").text("Package Type  cannot be empty!");
                $("#pkg-cat-id").focus();
                return false;
            }
            if (no_of_adults < 1 || no_of_adults > 20) {
                $("#no-of-adults-error").text("Invalid Input");
                $("#no-of-adults").focus();
                return false;
            }
            if (no_of_children < 1 || no_of_children > 20) {
                $("#no-of-children-error").text("Invalid Input");
                $("#no-of-children").focus();
                return false;
            }
            if (rate_per_night < 1 || rate_per_night > 100) {
                $("#rates-per-night-error").text("Invalid Input");
                $("#rates-per-night").focus();
                return false;
            }
            if (bed_id == 0) {
                $("#bed-id-error").text("Bed Type  cannot be empty!");
                $("#bed-id").focus();
                return false;
            } else {
                $("#updatePackageForm").unbind('submit').submit();
            }
        });

        $("#pkg-cat-id").change(function() {
            $("#pkg-cat-id-error").text("");
        });

        $("#no-of-adults").keyup(function() {
            $("#no-of-adults-error").text("");
        });

        $("#no-of-children").keyup(function() {
            $("#no-of-children-error").text("");
        });

        $("#rates-per-night").keyup(function() {
            $("#rates-per-night-error").text("");
        });

        $("#bed-id").change(function() {
            $("#bed-id-error").text("");
        });
    </script>



</body>

</html>