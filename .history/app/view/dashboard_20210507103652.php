<?php
    include 'sessionHandler.php';
    include '../controller/UserController.php';
    include_once '../controller/dbconnection.php';
    include '../controller/ModuleController.php';

    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }

    $UserController = new UserController();
   //$userId=  $loggedUser['user_id']; 
   $paymentController = new PaymentController();
   $Fullrev = $paymentController->getFullrevenue();
  

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
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
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 99;
            margin-top: 0px;
            padding:0px;
            content:"";
            top:100%;
            left:0;
            right:0;
            
        }

        /* Links inside the dropdown */
        .dropdown-content button {
            color: black;
            padding: 12px 16px;
            width: 100%;
            text-decoration: none;
            display: block;
            float:right;
            z-index:99;
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
                            <a class="nav-link" href="profile.php?user_id=<?php echo $loggedUser['user_id']; ?> "><i class="fa fa- user"></i>My Profile</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="currency float-left mr-1">$</span>
                                        <span class="count">23569</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Revenue</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-cart"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-6">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count float-left">85</span>
                                        <span>%</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Dummy text here</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <div id="flotBar1" class="flotBar1"></div>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-3">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count">6569</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Total clients</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-2">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count">1490</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">New users</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <div id="flotLine1" class="flotLine1"></div>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->
            </div>
                <!-- /Widgets -->
                <div class="clearfix"></div>
                <div class="animated fadeIn">
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
 
                                    <table id="OngoingReservation-detail" class="table table-hover">
                                        <thead> 
                                            <tr>
                                                <th>Reservation Id</th>
                                                <th>Package Name</th>
                                                <th>Room Number</th>
                                                <th>Customer Name</th>
                                                <th>Arrival Date</th>
                                                <th>Leaving Date</th>
                                                <th></th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


                <!-- Modal - Calendar - Add New Event -->
                <!-- /#event-modal -->
                <!-- Modal - Calendar - Add Category -->
               <!-- /#add-category -->
            </div>
            <div id="changeDateModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">

		<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" id="dis-close-btn" class="close" data-dismiss="modal" aria-label="Close" onclick="closebtn()"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="exampleModalLabel"> Edit Reservation</h4>
     		 </div>
      		<div class="modal-body">
                    <div>
                

                        <div class="clearfix">&nbsp;</div>

                        <label> From: </label>
                        <input type="date" id="check_arrival_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
                        <div class="clearfix">&nbsp;</div>
                        <label> Until: </label>
                        <input type="date" id="check_leaving_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
                        <div class="clearfix">&nbsp;</div>
                    </div>
                    <input type="hidden" id="res-id" value="" />
                    <input type="hidden" id="no-of-adults" value="" />
                    <input type="hidden" id="no-of-children" value="" />


                    
                    
             </div>
      		
      		<div class="modal-footer">
				<button type="button" id="edit-res-btn-submit" class="btn btn-success" >Edit Reservation Dates </button>
        		<button type="button"  id="add-dis-btn-close" class="btn btn-default" onclick="closebtn()" data-dismiss="modal">Close</button>
        		<div class="loader-spin"></div>
      		</div>
        </div>
    	</div>
            
	</div>

    <div id="CompleteResModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">

		<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" id="dis-close-btn" class="close" data-dismiss="modal" aria-label="Close" onclick="closebtn()"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="exampleModalLabel">Complete</h4>
     		 </div>
      		<div class="modal-body">
                <div class="container-fluid">
                    <table width="100%" class="table table-bordered" align="center">
                        <thead>
                            <tr>
                                
                                <th style="width: 70%">Description</th>
                                <th style="width: 15%">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="res-prices">
                            
                        </tbody>
                    </table>   
                    <div class="row">
                        <div class="col-md-12 text-right"><h5 style="display: inline">Total: </h5><h5 style="display: inline" id="totalPrice"></h5></div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12 text-right"><h5 style="display: inline">Advance: </h5><h5 style="display: inline" id="advancePrice"></h5></div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12 text-right"><h5 style="display: inline">Balance: </h5><h4 style="display: inline" id="balancePrice"></h4></div>
                    </div>  
                </div>
      		</div>
      		<div class="modal-footer">
                <input type="hidden" name="res_id" id="res_id"/>
				<button type="button" id="compelete-btn-submit" class="btn btn-success" >Confirm Completion</button>
        		<button type="button"  id="complete-btn-close" class="btn btn-default" onclick="closebtn()" data-dismiss="modal">Close</button>
        		<div class="loader-spin"></div>
      		</div>
    	</div>

	</div>

            <!-- .animated -->
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
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


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
        
    </script>
    <script>
        $(document).ready(function (){

// display user data table
 var reservationRecords = $('#OngoingReservation-detail').DataTable({
    "lengthChange": true,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
        url:"../ajax/reservationajax.php",
        type:"POST",
        data:{action:'ongoingReservations'}
    },
     "columns":[
        {"data":"0"},
        {"data":"1"},
        {"data":"2"},
        {"data":"3"},
        {"data":"4"},
        {"data":"5"},
        {"data":"6"},
        {"data":"7"},
        
        

      ],
      "columnDefs":[
                        {
                            "data":"7",
                            "render": function(data,type,row){
                                return "<button class='btn btn-sm btn-success' onclick='complete(" + row['0'] +")' data-toggle='modal' data-target='#CompleteResModal'>Complete</button>  <button class='btn btn-sm btn-outline-danger' onclick='cancelReservation(" + row['0'] +")'><i class='fa fa-times'></i> Cancel </button>";
                            },
                            "targets":7, "width": "20%"
                        },
                        {
                            "data":"6",
                            "render": function(data,type,row){
                                return " <button class='btn btn-sm btn-outline-secondary' onclick=  'changeDates(\"" + row['0'] + "\"," + row['6'] + "," + row['7'] + ","+row['4']+","+row['5']+")'; data-toggle='modal' data-target='#changeDateModal'><i class='fa fa-pencil'></i> Change Dates</button>";
                            },
                            "targets":6, "width": "10%"
                        },
                   ]
     
});

});



    </script>
    <script>
     function complete(reservationId){

        $.post('../ajax/dashboardajax.php',{
            
                    action: 'getResamount',
                    reservationId : reservationId,
                    
                 },function (response){
                    $("#res_id").val(reservationId);
				var data = jQuery.parseJSON(response);
				if(data){
                    var totalPrice = parseInt(data[0].res_amount);
                    var resAmountOutput = `
                        <tr>
                            <td>Reservation Amount</td>
                            <td style="text-align: right;" class="res_amount">$${data[0].res_amount}</td>
                        </tr>
                    `;
                    for(var i = 0; i < data[1].length; i++){
                        resAmountOutput += `
                        <tr>
                            <td>${data[1][i].food_name}</td>
                            <td style="text-align: right;" class="res_amount">$${data[1][i].price}</td>
                        </tr>
                        `;
                        totalPrice += parseInt(data[1][i].price);
                    }
                    var advancePrice= parseInt(data[2].payment_amount);
                    var balancePrice = parseInt(totalPrice) -parseInt(advancePrice);
                    $("#res-prices").html(resAmountOutput);
                    $("#totalPrice").text('$' + totalPrice);
                    $("#advancePrice").text('$' + advancePrice);
                    $("#balancePrice").text('$' + balancePrice);

                    
				}
				
			});
           

        }

        
        function changeDates(resId,adults,children,arrivaldate,leavingdate){
            $('#res-id').val(resId);
            $('#no-of-adults').val(adults);
            $('#no-of-children').val(children);
            $('#check_arrival_date').val(arrivaldate);
            $('#check_leaving_date').val(leavingdate);


        }
       


        $("#edit-res-btn-submit").click(function(){
        var resId = $("#res-id").val();
        var arrival_date = $("#check_arrival_date").val();
        var leaving_date= $("#check_leaving_date").val();
        var adults = $("#no-of-adults").val();
        var children = $("#no-of-children").val();
       
if(arrival_date == "" || leaving_date == ""|| adults == "" || children == ""){
    Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Fill all fields!',
    })
    return false;
}

$(".loader-spin").css('display', 'block');
$("#edit-res-btn-submit").attr('disabled',true);

$.post('../ajax/reservationajax.php',{
        action: 'editreservation',
        resId:resId,
        arrival_date : arrival_date,
        leaving_date : leaving_date,
        adults:adults,
        children:children
        
    },function (data){
    $(".loader-spin").css('display', 'none');
    $("#edit-res-btn-submit").attr('disabled',false);

    if(data > 0){
        window.location = 'viewavailablepackgesOndatechange.php?arr=' + arrival_date + '&lev=' + leaving_date + '&adults=' + adults + '&children=' + children + '&resid=' + resId;
    }else{
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'No Available Packages!',
        })
    }
    
    });
        })



        
    
        function cancelReservation(resId){
            Swal.fire({
              title: 'Are you sure?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
              if (result.value) {
                $.post('../ajax/reservationajax.php',{
                    action: 'cancelReservation',
                    resId: resId
                }, function (response){
                    if(response){
                       Swal.fire(
                          'Canceled!',
                          'Reservation Has been Canceled.',
                          'success'
                        ) 
                        $("#OngoingReservation-detail").DataTable().clear().draw();
                   }else{
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

    
    $("#compelete-btn-submit").click(function(){
        var resId = $("#res_id").val();
        $.post('../ajax/dashboardajax.php',{
                    action: 'completeReservation',
                    resId: resId
                }, function(response){
                    if (response == -1){
                        Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'A system error has been occured!'
                                });
                            

                    }
                    else{
                        $("#OngoingReservation-detail").DataTable().clear().draw();

                        window.open(`invoicepdf.php?payment_id=${response}&type=balance`);
                               
                        
                    }
                });
               
    })

        
    </script>
</body>
</html>
