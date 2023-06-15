<?php
include 'sessionHandler.php';
include_once '../controller/PackageController.php';
include_once '../controller/ModuleController.php';

$moduleController = new ModuleController();
$userModules = $moduleController->getUserModule($loggedUser['desig_id']);
if (!$userModules) {
    header("Location: logout.php?err=true");
}
if (!isset($_GET['pkg_id'])) {
    header("Location: package.php");
} else {
    $packageController = new PackageController();
    $packageData = $packageController->getPackage($_GET['pkg_id']);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $PackageController = new PackageController();
    $PackageController->updatePackage($_POST, $_FILES);
}
$packagecatdata = $packageController->getPackagetype();
$beddata = $packageController->getBedtype();
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
                                    <li><a href="package.php">Package Management</a></li>
                                    <li class="active"><?php echo $packageData['pkg_name']; ?></li>
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
                <?php
                if(file_exists("../../resources/images/packages/" . $_GET['pkg_id'])){
                    $images = scandir("../../resources/images/packages/" . $_GET['pkg_id']);
                    for ($i = 2; $i < count($images); $i++) {
                ?>
                    <div class="col-lg-3">
                        <img width="80%" class="rounded img-thumbnail mx-auto d-block d-inline" src="../../resources/images/packages/<?php echo $_GET['pkg_id'] . "/" . $images[$i]; ?>" />

                    </div>
                <?php
                    }
                }
                ?>
            </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">Package Info</div>
                            <div class="card-body card-block">

                                





                                    <form action="viewpackage.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="updatePackageForm">

                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Package Name </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="pkg-name" name="pkg-name" placeholder="Enter your first Name" class="form-control" value="<?php echo $packageData['pkg_name']; ?>" required>
                                                <span class="text text-danger small" id="pkg-name-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Package Type </label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="pkg-cat-id" id="pkg-cat-id" class="form-control">
                                                    <option value="">Select Package Type</option>
                                                    <?php
                                                    foreach ($packagecatdata as $packagecat) {
                                                    ?>
                                                        <option value="<?php echo $packagecat['pkg_cat_id']; ?>" <?php echo ($packagecat['pkg_cat_id'] == $packageData['pkg_cat_id']) ? 'selected' : '' ?>><?php echo $packagecat['pkg_cat']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                </select>
                                                <span class="text text-danger small" id="pkg-cat-id-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Number of Adults </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="no-of-adults" name="no-of-adults" placeholder="Employee Surame" class="form-control" value="<?php echo $packageData['no_of_adults']; ?>" required>
                                                <span class="text text-danger small" id="no-of-adults-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Number of Children  </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="no-of-children" name="no-of-children" placeholder="Employee Email" class="form-control" value="<?php echo $packageData['no_of_children']; ?>" required>
                                                <span class="text text-danger small" id="no-of-children-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Package Description </label></div>
                                            <div class="col-12 col-md-9"><textarea id="pkg-desc" name="pkg-desc" rows="2" placeholder="address" class="form-control"><?php echo $packageData['pkg_des']; ?></textarea></div>
                                        </div>


                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Bed Type </label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="bed-id" id="bed-id" class="form-control">
                                                    <option value="">Select Bed Type</option>
                                                    <?php
                                                    foreach ($beddata as $bedtype) {
                                                    ?>
                                                        <option value="<?php echo $bedtype['bed_id']; ?>" <?php echo ($bedtype['bed_id'] == $packageData['bed_id']) ? 'selected' : '' ?>><?php echo $bedtype['bed_type']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                </select>
                                                <span class="text text-danger small" id="bed-id-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Number of Beds </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="No-of-beds" name="No-of-beds" placeholder="no-of-beds" class="form-control" value="<?php echo $packageData['no_of_bed']; ?>" required>
                                                <span class="text text-danger small" id="no-of-beds-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Size of the Room  </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="room-size" name="room-size" placeholder="Room size m*m" class="form-control" value="<?php echo $packageData['size_of_rooms']; ?>" required>
                                                <span class="text text-danger small" id="room-size-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Services </label></div>
                                            <div class="col-12 col-md-9"><textarea id="services" name="services" rows="2" placeholder="Package Services" class="form-control" required><?php echo $packageData['services']; ?></textarea></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Rates Per Night </label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="rates-per-night" name="rates-per-night" placeholder="Rates per Night" class="form-control" value="<?php echo $packageData['rate_per_night']; ?>" required>
                                                <span class="text text-danger small" id="rates-per-night-error"></span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Images </label></div>
                                            <div class="col-12 col-md-9"><input type="file" name="image[]" class="form-control-file" multiple="multiple" accept="image/*"></div>
                                        </div>


                                        <div class="modal-footer">

                                            <input type="hidden" name="pkg-id" value="<?php echo $packageData['pkg_id']; ?>" />
                                            <button type="submit" class="btn btn-primary">Update Package</button>
                                        </div>
                                    </form>


                            </div>




                        </div>
                    </div>
                </div>


            </div>
            
        </div><!-- .animated -->
    </div><!-- .content -->
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
            var bed_id= $("#bed-id").val();

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
            }
            
            
            else {
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