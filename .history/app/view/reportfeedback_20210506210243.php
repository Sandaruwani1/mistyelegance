<?php
    include 'sessionHandler.php';
    include '../controller/PackageController.php';
    include_once '../controller/dbconnection.php';
    include '../controller/ModuleController.php';
    

    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }
    $packagecontroller= new PackageController();
    $pkgData= $packagecontroller->getAllPackages();

   
    

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
    <title>Misty Elegance</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../resources/images/logo.jpg">
    <link rel="shortcut icon" href="../resources/images/logo.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
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


    /* dropdown css */


    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 400px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 99;
        margin-top: 0px;
        padding: 0px;
        content: "";
        top: 100%;
        left: 0;
        right: 0;

    }

    /* Links inside the dropdown */
    .dropdown-content button {
        color: black;
        padding: 12px 16px;
        width: 100%;
        text-decoration: none;
        display: block;
        float: right;
        z-index: 99;
        border: none;
        cursor: pointer;

    }

    /* Change color of dropdown links on hover */
    .dropdown-content button:hover {
        background-color: rgba(144, 197, 222, 0.4);
    }
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>

                    <?php
                        foreach ($userModules as $userModule){ 

                            $module = $userModule['module_name'];
                            $moduleIcon = $userModule['module_icon'];

                            if($userModule['module_id'] != 1){
                                $moduleClass = "";
                                if(($module . ".php") == basename($_SERVER['PHP_SELF'])){
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
                            }else{
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
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <?php
                                if($loggedUser['emp_image'] == ""){
                                    $userImage = "default.png";
                                }else{
                                    $userImage = $loggedUser['emp_image'];
                                }
                            ?>
                                <img class="user-avatar rounded-circle"
                                    src="../resources/images/users/<?php echo $userImage; ?>" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="profile.php?user_id=<?php echo $loggedUser['user_id']; ?>"><i
                                        class="fa fa- user"></i>My Profile</a>
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
                                    <li><a href="report.php">Report Management</a></li>
                                    <li class="active">Report Feedback</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->

                <!-- /Widgets -->
                <div class="clearfix"></div>
                <div class="animated fadeIn"> </div>
            </div>
            <div class="row">
                <!-- <div class="col-sm-6">
                    <div class="card w-100">
                        <div class="card-body">

                            <h3 class="card-title" style="text-align: center;">Feedback Analysis</h3>


                            <label style="font-weight:bold; text-align:left"> From: </label>

                            <input type="date" id="report-from-feedback-analysis" class="form-control"
                                max="<?php echo date('Y-m-d'); ?>" />
                            <span id="report-from-feedback-analysis-error" class="text text-danger"></span>

                            <div class="clearfix">&nbsp;</div>
                            <label style="font-weight: bold;"> Until: </label>

                            <input type="date" id="report-until-feedback-analysis" class="form-control"
                                max="<?php echo date('Y-m-d'); ?>" />
                            <span id="report-until-feedback-analysis-error" class="text text-danger"></span>
                            <div class="clearfix">&nbsp;</div>

                            <button class="btn btn-primary" onclick="createFeedbackAnalysisReport()">View
                                Report</button>

                        </div>

                    </div>
                </div> -->
                <div class="col-sm-6">
                    <div class="card w-100">
                        <div class="card-body">

                            <h3 class="card-title" style="text-align: center;">Feedback Analysis Of Packages</h3>
                            <label style="font-weight:bold; text-align:left"> Year: </label>
                                    <select id="year" name="year" class="form-control">
                                    <?php  
                                                foreach ($pkgData as $data){
                                            ?>
                                                <option value="<?php echo $data['pkg_id']?>"><?php echo $data['pkg_name'] ?></option>
                                            <?php
                                                }
                                            ?>

                                    </select>
                                    <div class="clearfix">&nbsp;</div>
                            <button class="btn btn-primary" onclick="createFeedbackAnalysisReport()">View
                                Report</button>

                        </div>



                    </div>
                </div>
            </div>



        </div>


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
    </div>

    <!-- /#right-panel -->
    <!-- Jquery js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


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
    <!--Datatables-->
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
    <script>
    function createFeedbackAnalysisReport() {
        var fromDate = $("#report-from-feedback-analysis").val();
        var untilDate = $("#report-until-feedback-analysis").val();
        if (fromDate == "") {
            $("#report-from-feedback-analysis-error").text("From date cannot be empty!");
            $("#report-from-feedback-analysis").focus();
            return false;
        }
        if (untilDate == "") {
            $("#report-until-feedback-analysis-error").text("Until date cannot be empty!");
            $("#report-until-feedback-analysis").focus();
            return false;
        }
        window.open(`reportpdf.php?type=feedback_analysis&from=${fromDate}&until=${untilDate}`, '_blank');
    }

    $("#report-until-feedback-analysis").change(function() {
        $("#report-until-feedback-analysis-error").text("");
    });
    $("#report-from-feedback-analysis").change(function() {
        $("#report-from-feedback-analysis-error").text("");
    });
    </script>

</body>

</html>