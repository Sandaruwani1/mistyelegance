<?php
include_once './controller/PackagesController.php';
session_start();
if(!isset($_SESSION['customer_info'])){
    header("Location: index.php");
}
$customerInfo = $_SESSION['customer_info'];


if (!isset($_GET['arr-date']) || !isset($_GET['lev-date']) || !isset($_GET['adults']) || !isset($_GET['children']) || !isset($_GET['pkg_id'])) {
    
  //  $packagesController = new PackagesController();
  // $AllpkgData=$packagesController->getAllPackages();


    $packagesController = new PackagesController();
    $pkgData = $packagesController->getPkg($_GET['pkg_id']);
}

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Journey HTML CSS Template</title>
<!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
      </head>

      <body>
        <div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>    
            <div class="tm-top-bar" id="tm-top-bar">
                <div class="container">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto" href="#">
                                <img src="./resources/images/logo.jpg" alt="Site logo">
                                Misty Elegance
                            </a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="packages.php">Package</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contactus.php">Contact Us</a>
                                    </li>
                                    <?php
                                        
                                        if(!isset($_SESSION['customer_info'])){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Login or Register</a>
                                    </li>
                                    <?php
                                        }else{
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="dashboard.php">Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                        </div>                            
                    </nav>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- .tm-top-bar -->

        <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
                <div class="tm-container-outer tm-banner-bg">
                    <div class="container">
                        <div class="row tm-banner-row" id="tm-section-search">
                        <div class="tm-banner-header" style="text-align:center"> <h1 class="text-uppercase tm-banner-title"> Reservation Summery</h1> </div>
                        <div class="card">
                    <div class="card-header">
                        Confirm reservation
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="card-title">Package: <?php echo $pkgData['pkg_name']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="card-title">Customer Name: <?php echo $customerInfo['cus_fname'] . " " . $customerInfo['cus_lname']; ?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="card-title">Arrival Date: <?php echo $_GET['arr-date']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="card-title">Leaving Date: <?php echo $_GET['lev-date']; ?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="card-title">Adults: <?php echo $_GET['adults']; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="card-title">Children: <?php echo $_GET['children']; ?> </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <h6 class="card-title">Amount:<?php

                                                                $date1 = date_create($_GET['arr']);
                                                                $date2 = date_create($_GET['lev']);
                                                                $diff = date_diff($date1, $date2);
                                                                $dateCount = $diff->format("%a");
                                                                $rate = $pkgData['rate_per_night'] * $dateCount;
                                                                $advancePayment = 0;

                                                                if (($pkgData['discount_from'] <= date('Y-m-d') && $pkgData['discount_until'] >= date('Y-m-d'))) {

                                                                    echo  " $<del>$rate </del>" . "  " . "$" . $pkgData['discount'] * $dateCount;
                                                                    $advancePayment = ($pkgData['discount'] * $dateCount) * 0.25;
                                                                } else {


                                                                    echo " $" . $rate;
                                                                    $advancePayment = $rate * 0.25;
                                                                }

                                                                ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="card-title">Advance Payment: $<?php echo round($advancePayment); ?> </h6>
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
                        </div>
                        <div class="tm-banner-overlay"></div>
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>
            
                  
            <div class="tm-container-outer" id="tm-section-3">
                <div class="tab-content clearfix">   
                     <!-- tab-pane -->
                </div>
            </div>

            <footer class="tm-container-outer">
                <p class="mb-0">Copyright © <span class="tm-current-year">2018</span> Your Company 
                    
                . Designed by <a rel="nofollow" href="http://www.google.com/+templatemo" target="_parent">Template Mo</a></p>
            </footer>
        </div>
    </div> <!-- .main-content -->

    <!-- Packages view modal -->
    
    <!-- load JS files -->
     

    <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
    <script src="js/jquery.scrollTo.min.js"></script>           <!-- https://github.com/flesler/jquery.scrollTo -->
    <script> 
        

        /* DOM is ready
        ------------------------------------------------*/
        $(function(){

            // Change top navbar on scroll
            $(window).on("scroll", function() {
                if($(window).scrollTop() > 100) {
                    $(".tm-top-bar").addClass("active");
                } else {                    
                 $(".tm-top-bar").removeClass("active");
                }
            });

            // Smooth scroll to search form
            $('.tm-down-arrow-link').click(function(){
                $.scrollTo('#tm-section-search', 300, {easing:'linear'});
            });

            // Date Picker in Search form
            var pickerCheckIn = datepicker('#inputCheckIn');
            var pickerCheckOut = datepicker('#inputCheckOut');

            // Update nav links on scroll
            $('#tm-top-bar').singlePageNav({
                currentClass:'active',
                offset: 60
            });

            // Close navbar after clicked
            $('.nav-link').click(function(){
                $('#mainNav').removeClass('show');
            });

            // Slick Carousel
            $('.tm-slideshow').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        
        });

    </script>     
    <script>
    function loadPkgData(pkgId){

        $.post('./packagesajax.php',{
            action: 'getPkgbyId',
             pkgId : pkgId,
                    

        },function (response){

            var data = jQuery.parseJSON(response);
            var pkgName = data['pkg_name'];
            var bedType = data['bed_type'];
            var pkgType = data['pkg_cat'];
            var discount = data['discount'];
            var disFrom = data['discount_from'];
            var disUntil = data['discount_until'];
            var adultsNo = data['no_of_adults'];
            var childrenNo = data['no_of_children'];
            var bedNo = data['no_of_bed'];
            var pkgDes = data['pkg_des'];
            var rate = data['rates_per_night'];
            var services = data['services'];
            var roomSize = data['size_of_rooms'];
            var disRate = data['discount_rate'];

            $("#pkg-name").text(pkgName);
            $("#pkg_type").text(pkgType);
            $("#bed_type").text(bedType);
            $("#no_of_adults").text(adultsNo);
            $("#no_of_children").text(childrenNo);
            $("#no_of_bed").text(bedNo);
            $("#pkg_des").text(pkgDes);
            $("#rates_per_night").text(rate);
            $("#services").text(services);
            $("#size_of_rooms").text(roomSize);

            if(adultsNo== "" ){
                $("#no_of_adults").text("0");
            }
            if( childrenNo == "" ){
                $("#no_of_children").text("0");
            }
             if(bedNo == ""){
                $("#no_of_bed").text("0");

            } 
            if( pkgDes =="" ){
                $("#pkg_des").text("-");
            } 
            if(services == "" ){
                $("#services").text("-");
            }
            if(roomSize == ""){
                $("#size_of_rooms").text("0");
            }
            

            
            var slideshow = "";

            if(data['imageArray'].length > 0){
                slideshow += `
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                `;
                for(var i = 0; i < data['imageArray'].length; i++){
                    slideshow += `
                            <li data-target="#carouselExampleIndicators" data-slide-to="${i}" class="${(i == 0)? 'active': ''}"></li>
                    `;
                }
                slideshow += `
                        </ol>
                            <div class="carousel-inner">
                `;
                for(var i = 0; i < data['imageArray'].length; i++){
                    slideshow += `
                        <div class="carousel-item ${(i == 0)? 'active': ''}">
                            <img class="d-block w-100" style="height: 250px;" src="./resources/images/packages/${data['pkg_id']}/${data['imageArray'][i]}" alt="First slide">
                        </div>
                    
                    `;
                }
                slideshow += `
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
                `;
            }else{
                slideshow += `
                    <img src="./resources/images/packages/default.png" />
                `;
            }
 
            $('#slideshow').html(slideshow);

        });
   

    }
    
    </script>   

    <script>
    
        function bookNow(pkgId){

            var arrDate = $("#check-in").val();
            var levDate = $("#check-out").val();
            var adults = $("#inputAdult").val();
            var children = $("#inputChildren").val();

            if(arrDate == '' || levDate == ''){
                alert('You need to provide Arrival Date and Leaving Date to continue!');
                return false;
            }
            window.location = `login.php?pkg_id=${pkgId}&arr_date=${arrDate}&lev_date=${levDate}&adults=${adults}&children=${children}`;
        }

    </script>     

</body>
</html>