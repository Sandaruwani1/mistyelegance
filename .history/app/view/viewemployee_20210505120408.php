
<?php
    include 'sessionHandler.php';
    include_once '../controller/EmployeeController.php';
    include_once '../controller/ModuleController.php';
    
    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $EmployeeController = new EmployeeController();
        $EmployeeController->updateEmployee($_POST);
    }

    if(!isset($_GET['emp_id']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
        header("Location: employee.php");
    }else{
        $EmployeeController = new EmployeeController();
        $employeeData = $EmployeeController->getEmployee($_GET['emp_id']);
        if($employeeData['emp_image'] == ""){
            $employeeData['emp_image'] = "default.png";
        }
   }
        $desigdata = $EmployeeController->getDesignation();
       // $EmployeeController->updateEmployee($_POST,$empUpdate);

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
                                if(($module . ".php") == 'Employee.php'){
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
                                    <li><a href="Employee.php">Employee Management</a></li>
                                    <li class="active"><?php echo $employeeData['emp_fname'] . " " . $employeeData['emp_lname']; ?></li>
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

                    <div class="col-lg-4">
                        <br/><br/>
                        <img width="100%" class="rounded mx-auto d-block" src="../resources/images/users/<?php echo $employeeData['emp_image']; ?>" />
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">Employee Info</div>
                            <div class="card-body card-block">
    
                                <form action="viewemployee.php" method="post">
                                    <!-- Modal -->
                                
                                
                                
                               
                                
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="updateEmployeeForm">
                                                            
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">First Name </label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="emp-fname" name="emp-fname" placeholder="Enter your first Name"  class="form-control" value="<?php echo $employeeData['emp_fname']; ?>" required>
                                            <span class="text text-danger small" id="emp-fname-error"></span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label" > Surname </label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="emp-lname" name="emp-lname" placeholder="Employee Surame" class="form-control" value="<?php echo $employeeData['emp_lname']; ?>" required>
                                            <span class="text text-danger small" id="emp-lname-error"></span>
                                    </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email  </label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="email" id="emp-email" name="emp-email" placeholder="Employee Email" class="form-control" value="<?php echo $employeeData['emp_email']; ?>"required>
                                            <span class="text text-danger small" id="emp-email-error"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIC Number </label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="emp-nic" name="emp-nic" placeholder="Employee NIC" class="form-control" value="<?php echo $employeeData['emp_nic']; ?>" required>
                                            <span class="text text-danger small" id="emp-nic-error"></span>
                                        </div>
                                    </div>
                                   
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Address </label></div>
                                        <div class="col-12 col-md-9"><textarea id="emp-address" name="emp-address" rows="2" placeholder="address" class="form-control" required><?php echo $employeeData['emp_address']; ?>"</textarea></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date Of Birth </label></div>
                                        <div class="col-12 col-md-9"><input type="date" id="emp-dob" name="emp-dob" placeholder="Employee Date Of Birth" class="form-control" max="<?php echo date('Y-m-d', strtotime('-18 year')) ?>" value="<?php echo $employeeData['emp_dob']; ?>"required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contact number </label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="emp-tel" name="emp-tel" placeholder="Employee Phone number" class="form-control" value="<?php echo $employeeData['emp_tel']; ?>" required>
                                            <span class="text text-danger small" id="emp-tel-error"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Designation </label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="desig-id" id="desig-id" class="form-control">
                                                <option value="">Select Designation</option>
                                            <?php  
                                                foreach ($desigdata as $designation){
                                            ?>
                                                <option value="<?php echo $designation['desig_id']; ?>" <?php echo ($designation['desig_id'] == $employeeData['desig_id'])?'selected':'' ?>><?php echo $designation['desig_Title']; ?></option>
                                            <?php
                                                }
                                            ?>

                                                                                                            
                                            </select>
                                            <span class="text text-danger small" id="emp-desig-id-error"></span>
                                        </div>
                                    </div>
                                   
                                    <div class="row form-group" required>
                                        <div class="col col-md-3"><label class=" form-control-label">Gender </label></div>
                                        <div class="col col-md-9">
                                         <div class="form-check-inline form-check">

                                                <label for="inline-radio1" class="form-check-label ">
                                                    <input type="radio" id="emp-genderf" name="emp-gender" value="Female" class="form-check-input" <?php echo ($employeeData['emp_gender'] == 'Female')?'checked':'' ?>>Female 
                                                </label>

                                                <label for="inline-radio2" class="form-check-label ">
                                                    <input type="radio" id="emp-genderm" name="emp-gender" value="Male" class="form-check-input" <?php echo ($employeeData['emp_gender'] == 'Male')?'checked': '' ?>>Male
                                                </label>  
                                         </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Employee Image </label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="emp-image" name="file-input" class="form-control-file" accept="image/*"></div>
                                    </div>                 
                                    <div class="modal-footer">
                                        
                                        <input type="hidden" name="emp-id" value="<?php echo $employeeData['emp_id']; ?>" />
                                        <button type="submit" class="btn btn-primary">Update Employee</button>
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
         

    </script>
    <script>
        $("#updateEmployeeForm").submit(function (event){
            event.preventDefault();
            var fName = $("#emp-fname").val();
            var lname = $("#emp-lname").val();
            var email = $("#emp-email").val();
            var nic = $("#emp-nic").val();
            var tel = $("#emp-tel").val();
            var designationId = $("#desig-id").val();

            var namePattern = /^[a-zA-Z]{1,}$/;
            var patternnicold = /^[0-9]{9}[vVxX]$/;
            var patternnicnew = /^[0-9]{12}$/;
            var patterntel = /^[0-9]{9,12}$/;

            if(!fName.match(namePattern)){
                $("#emp-fname-error").text("Invalid Format! First Name can have only one or more characters");
                $("#emp-fname").focus();
                return false;
            }
            if(!lname.match(namePattern)){
                $("#emp-lname-error").text("Invalid Format! Last Name can have only one or more characters");
                $("#emp-lname").focus();
                return false;
            }
            if(!nic.match(patternnicold) && !nic.match(patternnicnew) ){
                $("#emp-nic-error").text("Invalid Format!");
                $("#emp-nic").focus();
                return false;
            }
            if(!tel.match(patterntel)){
                $("#emp-tel-error").text("Invalid Format!");
                $("#emp-tel").focus();
                return false;
            }
            if(designationId == 0){
                $("#emp-desig-id-error").text("Designation cannot be empty!");
                $("#desig-id").focus();
                return false;
            }
            
            /*
            $.post('../ajax/employeeajax.php',{
                action: 'checkEmailExistence',
                email: email
            }, function(response){
                if(response == 1){
                    $("#emp-email-error").text("Email address exist in the system. Please enter different email address");
                    $("#emp-email").focus();
                    return false; 
                }else if(response == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                    return false;
                }else{
                    $("#addEmployeeForm").unbind('submit').submit();
                }
            }); */

        });

        $("#emp-fname").keyup(function (){
            $("#emp-fname-error").text("");
        });

        $("#emp-lname").keyup(function (){
            $("#emp-lname-error").text("");
        });

        $("#emp-nic").keyup(function (){
            $("#emp-nic-error").text("");
        });

        $("#emp-tel").keyup(function (){
            $("#emp-tel-error").text("");
        });
        $("#emp-email").keyup(function (){
            $("#emp-email-error").text("");
        });
      
        $("#desig-id").change(function (){
            $("#emp-desig-id-error").text("");
        });

      
    </script>


</body>
</html>
