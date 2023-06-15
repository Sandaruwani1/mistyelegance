<?php
    include 'sessionHandler.php';
    include '../controller/FoodController.php';
    include '../controller/ModuleController.php';

    $moduleController = new ModuleController();
    $userModules = $moduleController->getUserModule($loggedUser['desig_id']);
    if(!$userModules){
        header("Location: logout.php?err=true");
    }  
     
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $FoodController = new FoodController();
        $FoodController->addReservationFoods($_POST);
    }

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
                                    <li class="active">Restuarant Management</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="content">


            <button class="btn btn-primary" data-toggle="modal" data-target="#addFoodresForm"><i class="fa fa-plus"></i>
                Add Food Reservation</button>

            <div class="clearfix">&nbsp;</div>

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="restuarant-detail" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Reservation Id</th>
                                            <th>Food Name</th>
                                            <th>Food Category</th>
                                            <th>Price</th>
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

    <!-- Modal -->
    <div class="modal fade" id="addFoodresForm" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add Food Rservations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"
                        id="addFoodresForm">

                        <div class="card">
                            <div class="card-body">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input"
                                            class=" form-control-label">Resevation Id<span style="color: red;">*</span>
                                        </label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="res-id" name="res-id" placeholder="Reservation Id"
                                            value="" class="form-control" required>
                                        <span class="text text-danger small" id="res-id-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="foods">

                        </div>

                        <button class="btn btn-success btn-sm mb-3" type="button" id="addrow"><i
                                class="fa fa-plus"></i>Add Food</button>


                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>Amount:</h5></strong>
                            </div>
                            <div class="col-md-6 text-right" id="food-amount"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                            <button type="submit" class="btn btn-primary">Add Food Reservation</button>
                        </div>
                    </form>
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
        var foodresRecords = $('#restuarant-detail').DataTable({
            "lengthChange": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "../ajax/restuarantajax.php",
                type: "POST",
                data: {
                    action: 'getAllFoodreservations'
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
            "columnDefs": [{
                "data": "4",
                "render": function(data, type, row) {
                    return "<button class='btn btn-sm btn-outline-danger' onclick='cancelFoodres(" +
                        data + ")'><i class='fa fa-times'></i> Cancel</button> ";
                },
                "targets": 4
            }, ]
        });

    });
    </script>

    <script>
    $("#addrow").click(function() {
        var output = `
            <div class = "card">
                <div class="card-body">
                    <div class="row form-group"> 
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Food Name<span style="color: red;">*</span> </label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="food-name[]" id="food-name" onkeyup="getData(this)" placeholder="food Name" value="" class="form-control food-name" auto-complete="no-fill" required>
                            <div class="dropdown">
                                <div class="dropdown-content result"></div>          
                             </div>
                            <span class="text text-danger small" id="food-name-error"></span>
                            <input type="hidden" name="food-id[]" class="food-id" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Number of portions<span style="color: red;">*</span> </label></div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="food-portion" name="food-portion[]" onblur="getPortionData(this);" placeholder="food Portion" value="" class="form-control" required>
                            <span class="text text-danger small" id="food-portion-error"></span>
                        </div>
                    </div>
                    
                    <div class="row form-group food-price-row">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Food Price<span style="color: red;">*</span> </label></div>
                        <div class="col-12 col-md-9 food-price-col">
                            <input type="text" name="food-price[]" placeholder="food Price" onchange="setTotalAmount();" class="form-control food-price" readonly>
                            <span class="text text-danger small" id="food-price-error"></span>
                        </div>
                    </div>
                </div>
            </div>`;
        $("#foods").append(output);
    });



    function getData(e) {
        var foodName = $(e).val();
        if (foodName.length >= 2) {
            $.ajax({
                    url: '../ajax/restuarantajax.php',
                    method: 'Post',
                    data: {
                        action: 'searchfood',
                        foodName: foodName
                    },
                    success: function(data) {
                        if (data) {
                            $(e).siblings(".dropdown").children(".result").css('display', 'block');
                            $(e).siblings(".dropdown").children(".result").html(data);
                        } else {
                            $(e).siblings(".dropdown").children(".result").css('display', 'block');
                            $(e).siblings(".dropdown").children(".result").html("<p>No any record</p>");
                        }

                    },
                    dataType: 'text'
                }

            );
        } else {
            $("#result").css('display', 'none');
            $("#result").html("");
        }
    }


    function setData(e, id, name) {
        $(e).parent().parent().siblings(".food-name").val(name + " - " + id);
        $(e).parent().parent().siblings(".food-id").val(id);
        $(e).parent().css('display', 'none');
    }

    function setTotalAmount() {
        var foodAmount = 0;
        $('.food-price').each(function(i, obj) {
            foodAmount += parseInt($(obj).val());
        });
        $("#food-amount").text("$" + foodAmount);
    }

    $("#addFoodresForm").submit(function(e) {
        if ($.trim($("#food-amount").text()) == "" || $("#food-amount").text == "$0") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Select at least one food!'
            });
        }
    });


    function cancelFoodres(food_res_Id) {

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.post('../ajax/restuarantajax.php', {
                    action: 'cancelFoodres',
                    food_res_Id: food_res_Id
                }, function(response) {
                    if (response) {
                        Swal.fire(
                            'Deleted!',
                            'Food reservation  has been deleted.',
                            'success'
                        )
                        $("#restuarant-detail").DataTable().clear().draw();
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
    function getPortionData(e){
        
        var portion = $(e).val();
        var foodId = $('.food-id').val();

        $.ajax({
                url: '../ajax/restuarantajax.php',
                method: 'Post',
                data: {
                    action: 'foodpriceByportion',
                    portion: portion,
                    foodId: foodId
                },
                success: function(data) {
                    if (data) {
                            $(e).parent().parent().siblings(".food-price-row").children(".food-price-col").children(".food-price").val(data);
                        } else {
                           console.log("error");
                        }

                },
                dataType: 'text'
            }

        );

    
    }
    </script>



</body>

</html>