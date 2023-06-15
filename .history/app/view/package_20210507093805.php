<?php
include 'sessionHandler.php';
include '../controller/PackageController.php';
include '../controller/ModuleController.php';


$moduleController = new ModuleController();
$userModules = $moduleController->getUserModule($loggedUser['desig_id']);
if (!$userModules) {
    header("Location: logout.php?err=true");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $packageController = new PackageController();
    $packageController->addPackage($_POST, $_FILES);
}
$packageController = new PackageController();
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
                            if (($module . ".php") == basename($_SERVER['PHP_SELF'])) {
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
                                    <li class="active">Package Management</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="content">


            <button class="btn btn-primary" data-toggle="modal" data-target="#addpackage"><i class="fa fa-plus"></i> Add Package</button>

            <div class="clearfix">&nbsp;</div>

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="package-detail" class="table table-hover">
                                    <thead>
                                        <tr>

                                            <th>Package Name</th>
                                            <th>Package Type</th>
                                            <th>Rates Per Night</th>
                                            <th>Discounts</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
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

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="addpackage" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="addPackageForm">

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Package Name<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="pkg-name" name="pkg-name" placeholder="Package Name" class="form-control" required>
                                <span class="text text-danger small" id="pkg-name-error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Package Type<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <select name="pkg-cat-id" id="pkg-cat-id" class="form-control">
                                    <option value="">Select Package Type</option>
                                                    <?php
                                                    foreach ($packagecatdata as $packagecat) {
                                                    ?>
                                                        <option value="<?php echo $packagecat['pkg_cat_id']; ?>"><?php echo $packagecat['pkg_cat']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                </select>
                                <span class="text text-danger small" id="pkg-cat-id-error"></span>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Number of Adults<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="no-of-adults" name="no-of-adults" placeholder="Number of Adults" class="form-control" required>
                                <span class="text text-danger small" id="no-of-adults-error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Number of Children <span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="no-of-children" name="no-of-children" placeholder="Number of children" class="form-control" required>
                                <span class="text text-danger small" id="no-of-children-error"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Package Description<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9"><textarea id="pkg-description" name="pkg-description" rows="2" placeholder="Description" class="form-control" required></textarea></div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Bed Type<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <select name="bed-id" id="bed-id" class="form-control">
                                    
                                    <option value="">Select Bed Type</option>
                                                    <?php
                                                    foreach ($beddata as $bedtype) {
                                                    ?>
                                                        <option value="<?php echo $bedtype['bed_id']; ?>"><?php echo $bedtype['bed_type']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                </select>
                                <span class="text text-danger small" id="bed-id-error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Number of Beds<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="No-of-beds" name="no-of-beds" placeholder="no-of-beds" class="form-control" required>
                                <span class="text text-danger small" id="no-of-beds-error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Size of the Room <span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="room-size" name="room-size" placeholder="Room size (Square Meters)" class="form-control" required>
                                <span class="text text-danger small" id="room-size-error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Services<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9"><textarea id="services" name="services" rows="2" placeholder="Package Services" class="form-control" required></textarea></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Rates Per Night<span style="color: red;">*</span> </label></div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="rates-per-night" name="rates-per-night" placeholder="Rates per Night" class="form-control" required>
                                <span class="text text-danger small" id="rates-per-night-error"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Images </label></div>
                            <div class="col-12 col-md-9"><input type="file" name="image[]" class="form-control-file" multiple="multiple" accept="image/*"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                            <button type="submit" class="btn btn-primary">Add New Package</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div id="discountModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">

		<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" id="dis-close-btn" class="close" data-dismiss="modal" aria-label="Close" onclick="closebtn()"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="exampleModalLabel">Discount</h4>
     		 </div>
      		<div class="modal-body">
                <div class="container-fluid">
                    <h4 id="discount-pkg-name" class="text-success">AAAAA</h4>
                    <h5 id="discount-pkg-rate" class="text-success">Rate: $55</h5>
                    <div id="add-dis-field-error" style="color: red; font-style: italic;"></div>
                    
                    <div class="row">
                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-4">
                            <input type="text" id="discount-rate" class="form-control" placeholder="Discount Rate" />
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" id="discount-check-btn">Check</button>
                        </div>
                        <div class="col-sm-3">&nbsp;</div>
                    </div>
                    <h3 class="text text-primary" id="discount-rate-view" style="text-align: center;"></h3>
                    <div class="clearfix">&nbsp;</div>
                    
                    <div>
                

                        <div class="clearfix">&nbsp;</div>

                        <label>Discount From: </label>
                        <input type="date" id="discount-from-input" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
                        <div class="clearfix">&nbsp;</div>
                        <label>Discount Until: </label>
                        <input type="date" id="discount-until-input" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
                        <div class="clearfix">&nbsp;</div>
                    </div>
                    <input type="hidden" id="add-dis-pkg-id" value="" />
                    <input type="hidden" id="add-dis-pkg-rate" value="" />
                    
                </div>
      		</div>
      		<div class="modal-footer">
				<button type="button" id="add-dis-btn-submit" class="btn btn-success" >Add Discount</button>
        		<button type="button"  id="add-dis-btn-close" class="btn btn-default" onclick="closebtn()" data-dismiss="modal">Close</button>
        		<div class="loader-spin"></div>
      		</div>
    	</div>

	</div>
    </div>

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
        $(document).ready(function() {
            var PackageRecords = $('#package-detail').DataTable({
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "../ajax/packageajax.php",
                    type: "POST",
                    data: {
                        action: 'getAllPackages'
                    }
                },
                "columns": [{
                        "data": "0"
                    },
                    {
                        "data": "1"
                    },
                    {
                        "data": "2"
                    },
                    {
                        "data": "3"
                    },
                    {
                        "data": "4"
                    },



                ],
                "columnDefs": [

                    {
                        "data": "4",
                        "render": function(data, type, row) {
                            return "<button class='btn btn-sm btn-outline-secondary' onclick='viewPackage(" + data + ")'><i class='fa fa-folder-open-o'></i> View</button>  <button class='btn btn-sm btn-outline-danger' onclick='deletePackage(" + data + ")'><i class='fa fa-trash-o'></i> Delete</button>";
                        },
                        "targets": 4,
                        "width": "20%"
                    },
                    {
                        "data": "3",
                        "render": function(data, type, row) {
                            return (row[5] == 1)? "Rate: $" +row[3] + "<br/>" + " From: " + row[6] + " <br /> To: " + row[7] + "<br/><button class='btn btn-danger btn-sm' id='remove-btn' onclick='removeDiscount("+row[4]+")'>Remove</button>":
                             "<button class='btn btn-info btn-sm'  onclick= 'setValuesToDiscountModal(\"" + row['0'] + "\"," + row['2'] + "," + row[4] + ")'  data-toggle='modal' data-target='#discountModal'>  Discount</button>"
                        },
                        "targets": 3,
                        "width": "20%"
                    },

                ]
            });

        });


      
        //view package
        function viewPackage(pkgId) {
            window.location.href = "viewpackage.php?pkg_id=" + pkgId;
        }

        function deletePackage(pkgId) {

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.post('../ajax/packageajax.php', {
                        action: 'deletePackage',
                        pkgId: pkgId
                    }, function(response) {
                        if (response) {
                            Swal.fire(
                                'Deleted!',
                                'Package has been deleted.',
                                'success'
                            )
                            $("#package-detail").DataTable().clear().draw();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'A system error has been occured!'
                            });
                        }

                    });

                }
            })
        }
    </script>
    <script>
        $("#addPackageForm").submit(function(event) {
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
            if (bed_id == 0) {
                $("#bed-id-error").text("Bed Type  cannot be empty!");
                $("#bed-id").focus();
                return false;
            }
            if (rate_per_night < 1 || rate_per_night > 100) {
                $("#rates-per-night-error").text("Invalid Input");
                $("#rates-per-night").focus();
                return false;
            } else {
                $("#addPackageForm").unbind('submit').submit();
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

        $("#bed-id").change(function() {
            $("#bed-id-error").text("");
        });

        $("#rates-per-night").keyup(function() {
            $("#rates-per-night-error").text("");
        });
    </script>
    <script>

        function setValuesToDiscountModal(pkgName, rate,  pkgId) {

            $('#discount-pkg-name').text(pkgName);
            $('#add-dis-pkg-id').val(pkgId);
            $('#discount-pkg-rate').text('Rate: $' + rate);
            $("#add-dis-pkg-rate").val(rate);
            

        }
        $("#discount-check-btn").click(function(){
           
            var current_rate = parseInt($("#add-dis-pkg-rate").val());
            var discount_rate = parseInt($("#discount-rate").val());

            if(discount_rate){
                if(discount_rate < 0 || discount_rate > 100){
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                    })
                }else{
                    var discounted_price = Math.round((current_rate*(100-discount_rate))/100);
                    $("#discount-rate-view").text('Discounted Rate: $'+discounted_price);
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                })
            }
            
        });
    
    $("#add-dis-btn-submit").click(function(){

        var pkgId = $("#add-dis-pkg-id").val();
        var discount = $.trim($("#discount-rate").val());
        var discount_from = $("#discount-from-input").val();
        var discount_until = $("#discount-until-input").val();


        if(discount == "" || discount_from == "" || discount_until == ""){
            Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'All field must be filled!',
            })
            return false;
        }
        Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Add Discount it!'
            }).then((result) => {
                if (result.value) {
                    $.post('../ajax/packageajax.php', {
                        action: 'addDiscountpackage',
                        pkgId: pkgId,
                        discount:discount,
                        discount_from:discount_from,
                        discount_until:discount_until,
                       


                    }, function(response) {
                        if (response) {
                            $('#add-dis-btn-close').click();
                            Swal.fire(
                                'Discount Added!',
                                'Package has been Updated.',
                                'success'
                            )

                            
                            $("#package-detail").DataTable().clear().draw();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'A system error has been occured!'
                            });
                        }

                    });

                }
            })
       

       
    });
    function removeDiscount(pkgId) {

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.value) {
                    $.post('../ajax/packageajax.php', {
                        action: 'removeDiscount',
                        pkgId: pkgId
                    }, function(response) {
                        if (response) {
                            Swal.fire(
                                'removed!',
                                'Package Discount has been removed.',
                                'success'
                            )
                            
                            $("#package-detail").DataTable().clear().draw();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'A system error has been occured!'
                            });
                        }

                    });

                }
            })
}

    function closebtn(){
        $("#discount-from-input").val("");
        $("#discount-until-input").val("");
        $("#discount-rate-view").text("");
        $("#discount-rate").val("");
        
    }

    </script>



</body>

</html>