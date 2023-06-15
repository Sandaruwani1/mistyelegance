
<?php
    include 'sessionHandler.php';
    include_once '../controller/CustomerController.php';
    include_once '../controller/ModuleController.php';
    
    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }

    if(!isset($_GET['cus_id']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
        header("Location: customer.php?err=true");
    }else{
        $customerController = new CustomerController();
        $customerData = $customerController->getCustomer($_GET['cus_id']);
    
   }
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customerController = new CustomerController();
    $customerController->UpdateCustomer($_POST);
}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
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
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
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
                        foreach ($userModules as $userModule){ 

                            $module = $userModule['module_name'];
                            $moduleIcon = $userModule['module_icon'];

                            if($userModule['module_id'] != 1){
                                $moduleClass = "";
                                if(($module . ".php") == 'customer.php'){
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
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                if($loggedUser['emp_image'] == ""){
                                    $userImage = "default.png";
                                }else{
                                    $userImage = $loggedUser['emp_image'];
                                }
                            ?>
                            <img class="user-avatar rounded-circle" src="../resources/images/users/<?php echo $userImage; ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="profile.php"><i class="fa fa- user"></i>My Profile</a>
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
                                    <li><a href="customer.php">Customer Management</a></li>
                                    <li class="active"><?php echo $customerData['cus_fname'] . " " . $customerData['cus_lname']; ?></li>
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

                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">Customer Info</div>
                            <div class="card-body card-block">
    
                            <form action="viewcustomer.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="editCustomerForm">
                                   
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">First Name </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-fname" name="cus-fname" placeholder="Customer First Name" class="form-control" value="<?php echo $customerData['cus_fname']; ?>" required>
                                           <span class="text text-danger small" id="cus-fname-error"></span>
                                       </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label" > Surname </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-lname" name="cus-lname" placeholder="Customer Surame" class="form-control" value="<?php echo $customerData['cus_lname']; ?>" required>
                                           <span class="text text-danger small" id="cus-lname-error"></span>
                                   </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Country </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-country" name="cus-country" placeholder="Customer Country" class="form-control" value="<?php echo $customerData['cus_country']; ?>" required>
                                           <span class="text text-danger small" id="cus-country-error"></span>
                                       </div>
                                   </div>
                                  
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email  </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="email" id="cus-email" name="cus-email" placeholder="Customer Email" class="form-control" value="<?php echo $customerData['cus_email']; ?>" required>
                                           <span class="text text-danger small" id="cus-email-error"></span>
                                       </div>
                                   </div>

                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIC Number </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-nic" name="cus-nic" placeholder="Customer NIC" class="form-control" value="<?php echo $customerData['cus_id']; ?>" readonly>
                                           <span class="text text-danger small" id="cus-nic-error"></span>
                                       </div>
                                   </div>
                                  
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date Of Birth </label></div>
                                       <div class="col-12 col-md-9"><input type="date" id="cus-dob" name="cus-dob" placeholder="Customer Date Of Birth" class="form-control" max="<?php echo date('Y-m-d', strtotime('-18 year')) ?>" value="<?php echo $customerData['cus_dob']; ?>" required></div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contact number </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-tel" name="cus-tel" placeholder="Customer Phone number" class="form-control" value="<?php echo $customerData['cus_tel']; ?>" required>
                                           <span class="text text-danger small" id="cus-tel-error"></span>
                                       </div>
                                   </div>

                                  
                                   <div class="row form-group" required>
                                       <div class="col col-md-3"><label class=" form-control-label">Gender </label></div>
                                       <div class="col col-md-9">
                                        <div class="form-check-inline form-check">

                                               <label for="inline-radio1" class="form-check-label ">
                                                   <input type="radio" id="cus-genderf" name="cus-gender" value="Female" class="form-check-input" <?php echo ($customerData['cus_gender'] == 'Female')?'checked':'' ?>>Female 
                                               </label>

                                               <label for="inline-radio2" class="form-check-label ">
                                                   <input type="radio" id="cus-genderm" name="cus-gender" value="Male" class="form-check-input" <?php echo ($customerData['cus_gender'] == 'Male')?'checked':'' ?>>Male
                                               </label>  
                                        </div>
                                       </div>
                                   </div>
                                                  
         <div class="modal-footer">
         <input type="hidden" name="cus-nic" value="<?php echo $customerData['cus_id']; ?>" />
           <button type="submit" class="btn btn-primary">Edit Customer</button>
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
        $("#editCustomerForm").submit(function (event){
            event.preventDefault();
            var fName = $("#cus-fname").val();
            var lname = $("#cus-lname").val();
            var email = $("#cus-email").val();
            
            var tel = $("#cus-tel").val();
            

            var namePattern = /^[a-zA-Z]{1,}$/;
            var patternnicold = /^[0-9]{9}[vVxX]$/;
            var patternnicnew = /^[0-9]{12}$/;
            var patterntel = /^[0-9]{9,12}$/;

            if(!fName.match(namePattern)){
                $("#cus-fname-error").text("Invalid Format! First Name can have only one or more characters");
                $("#cus-fname").focus();
                return false;
            }
            if(!lname.match(namePattern)){
                $("#cus-lname-error").text("Invalid Format! Last Name can have only one or more characters");
                $("#cus-lname").focus();
                return false;
            }
            if(!tel.match(patterntel)){
                $("#cus-tel-error").text("Invalid Format!");
                $("#cus-tel").focus();
                return false;
            }
            else {
                $("#editCustomerForm").unbind('submit').submit();
            }
            

            
        });

        $("#cus-fname").keyup(function (){
            $("#cus-fname-error").text("");
        });

        $("#cus-lname").keyup(function (){
            $("#cus-lname-error").text("");
        });

        $("#cus-tel").keyup(function (){
            $("#cus-tel-error").text("");
        });
        
        $("#cus-email").keyup(function (){
            $("#cus-email-error").text("");
        });
      
      


    </script>



</body>
</html>
