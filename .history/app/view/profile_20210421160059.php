<?php
    include 'sessionHandler.php';
    include '../controller/UserController.php';
    include '../controller/ModuleController.php';

    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }
    
        $userController = new UserController();
        $userData = $userController->getUser($_GET['user_id']);
        if($userData['emp_image'] == ""){
            $userData['emp_image'] = "default.png";
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
                                if(($module . ".php") == 'user.php'){
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
                    <a class="navbar-brand" href="dashboard.php"><img src="images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
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
                                    <li><a href="user.php">User Management</a></li>
                                    <li><?php echo $userData['emp_fname'] . " " . $userData['emp_lname']; ?></li>
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
                        <img width="100%" class="rounded mx-auto d-block" src="../resources/images/users/<?php echo $userData['emp_image']; ?>" />
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">User Info</div>
                            <div class="card-body card-block">
    
                                <!-- <form action="viewuser.php" method="post"> -->
                                    <div class="form-group">
                                        <label for="name" class=" form-control-label">Name</label>
                                        <br/>
                                        <span class="text text-secondary"><?php echo $userData['emp_fname'] . " " . $userData['emp_lname']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class=" form-control-label">Email</label>
                                        <br/>
                                        <span class="text text-secondary"><?php echo $userData['emp_email']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="username" class=" form-control-label">Username</label>
                                        <br/>
                                        <span id="username-span" class="text text-secondary"><?php echo $userData['user_name']; ?></span>
                                        <button type="button" id="username-edit-btn" class="btn btn-link">[Edit]</button>
                                        <div class="form-group" id="username-div">
                                            <input type="text" id="user_name" value="<?php echo $userData['user_name']; ?>" placeholder="Enter Username" class="form-control">
                                            <span id="user_name_error" class="text text-danger"></span>
                                        </div>
                                        <div class="form-group" id="username-submit-btn-div">
                                            <button class="btn btn-sm btn-outline-success" id="username-submit-btn">Submit</button>
                                            <button class="btn btn-sm btn-outline-danger" id="username-cancel-btn"><i class="fa fa-times" ></i> Cancel</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class=" form-control-label"  >Password</label>
                                        <br/>
                                        <span id="password-span" class="text text-secondary">********</span>
                                        <button type="button" id="password-edit-btn" class="btn btn-link">[Change Password]</button>
                                        <div class="form-group" id="password-div">
                                            <input type="password" id="password" placeholder="Enter New Password" class="form-control">
                                            <span id="pw_error" class="text text-danger"></span>
                                        </div>
                                        <div class="form-group" id="confirmpassword-div">
                                            <input type="password" id="confirmpassword" placeholder="Confirm Password" class="form-control">
                                            <span id="confirm_pw_error" class="text text-danger"></span>
                                        </div>
                                        <div class="form-group" id="password-submit-btn-div">
                                            <button class="btn btn-sm btn-outline-success" id="password-submit-btn">Submit</button>
                                            <button class="btn btn-sm btn-outline-danger" id="password-cancel-btn"><i class="fa fa-times" ></i> Cancel</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" id="updateuser" value="Update" class="btn btn-success" style="display: none;" />

                                        <!-- <button type="button" id="edituser" value="edit" class="btn btn-primary" ><i class="fa fa-edit" ></i> Edit</button>

                                         <button type="button" id="cancel" value="cancel" class="btn btn-danger" style="display:none;"><i class="fa fa-times" ></i> Cancel</button> -->

                                    </div>
                                <!-- </form> -->

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

    <script type="text/javascript">
        
        $(document).ready(function(){
            $("#username-div").hide();
            $("#username-submit-btn-div").hide();
            $("#password-div").hide();
            $("#confirmpassword-div").hide();
            $("#password-submit-btn-div").hide();
        });

        $("#username-edit-btn").click(function(){
            $("#username-div").show();
            $("#username-submit-btn-div").show();
            $("#username-edit-btn").hide();
            $("#username-span").hide();
        });

        $("#username-cancel-btn").click(function(){
            $("#username-div").hide();
            $("#username-submit-btn-div").hide();
            $("#username-edit-btn").show();
            $("#username-span").show();
            $("#user_name").val($.trim($("#username-span").text()));
            $("#user_name_error").text("");
        });

        $("#password-edit-btn").click(function(){
            $("#password-div").show();
            $("#confirmpassword-div").show();
            $("#password-submit-btn-div").show();
            $("#password-edit-btn").hide();
            $("#password-span").hide();
        })

        $("#password-cancel-btn").click(function(){
            $("#password-div").hide();
            $("#confirmpassword-div").hide();
            $("#password-submit-btn-div").hide();
            $("#password-edit-btn").show();
            $("#password-span").show();
            $("#pw_error").text("");
            $("#password").val("");
            $("#confirmpassword").val("");
            $("#confirm_pw_error").text("");
        })

    </script>
    <script>
         $("#username-submit-btn").click(function(){
            var newUserName = $("#user_name").val();
         
         $.post('../ajax/userajax.php',{
                action: 'UpdateuserName',
                newUserName:newUserName,
                userId:<?php echo $_GET['user_id']; ?>,
            
            }, function(response){
                if(response == 1){
                    $("#username-div").hide();
                    $("#username-submit-btn-div").hide();
                    $("#username-edit-btn").show();
                    $("#username-span").show();
                    $("#username-span").text(newUserName);
                            
                }
                else if(response == -1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                   return false;

                }else if(response == 2){
                    $("#user_name_error").text("Username exist in the system!");
                }
                
            });
        });

        $("#user_name").keydown(function(){
            $("#user_name_error").text("");
        });
       
    </script>
    <script>
         $("#password-submit-btn").click(function(){
            
            var newPassword = $.trim($("#password").val());            
            var newconfirmpassword = $.trim($("#confirmpassword").val());
            
            if(newPassword.length < 8 ){
                $("#pw_error").text(" Password is Too Short");
                $("#password").focus();
                return false;
            }
            if(newPassword != newconfirmpassword){
                $("#confirmpassword").focus();
                $("#confirm_pw_error").text("Password do not match");
                return false;
             }
            
         
         $.post('../ajax/userajax.php',{
                action: 'Updatepassword',
                newPassword: newPassword,
                userId:<?php echo $_GET['user_id']; ?>
            
            }, function(response){
                if(response == 1){
                    $("#password-div").hide();
                    $("#confirmpassword-div").hide();
                    $("#password-submit-btn-div").hide();
                    $("#password-edit-btn").show();
                    $("#password-span").show();
                                    
                }
                else if(response == -1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                   return false;

                }
                
            });
        });
        
   
        $("#password").keydown(function(){
            $("#pw_error").text("");
        });
        $("#confirmpassword").keydown(function(){
            $("#confirm_pw_error").text("");
        });

    </script>
</body>
</html>
