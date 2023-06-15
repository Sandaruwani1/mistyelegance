<?php
include_once './controller/PackagesController.php';
    


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
                                        <a class="nav-link " href="packages.php">Package</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contactus.php">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="login.php">Login or Register</a>
                                    </li>
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

                        <div class="row tm-banner-row tm-banner-row-header">
                            <div class="col-xs-12">
                                <div class="tm-banner-header">
                                    <h1 class="text-uppercase tm-banner-title">Let's begin</h1>
                                    <img src="img/dots-3.png" alt="Dots">
                                    <p class="tm-banner-subtitle">We assist you to choose the best.</p>
                                    <a href="javascript:void(0)" class="tm-down-arrow-link"><i class="fa fa-2x fa-angle-down tm-down-arrow"></i></a>       
                                </div>    
                            </div>  <!-- col-xs-12 -->                      
                        </div> <!-- row -->
                        <div class="row tm-banner-row" id="tm-section-search">

                            <form action="" method="get" class="tm-search-form tm-section-pad-2">
                                <div class="form-row tm-search-form-row">                                
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckIn">Check In Date</label>
                                        <input name="check-in" type="date" class="form-control" placeholder="Check In" required>
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                                        <label for="inputCheckOut">Check Out Date</label>
                                        <input name="check-out" type="date" class="form-control" placeholder="Check Out" required>
                                    </div>
                                    <div class="form-group tm-form-group tm-form-group-1">
                                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">                                       
                                            <label for="inputAdult">Adult</label>     
                                            <select name="adult" class="form-control tm-select" id="inputAdult">
                                                <option value="1" selected>1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>                                        
                                        </div>
                                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">

                                            <label for="inputChildren">Children</label>                                            
                                            <select name="children" class="form-control tm-select" id="inputChildren">
                                            	<option value="0" selected>0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>                                        
                                        </div>
                                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                                            <label for="btnSubmit">&nbsp;</label>
                                            <button type="submit" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Check Availability</button>                                       
                                        </div>
                                    </div>
                                </div> <!-- form-row -->                              
                            </form>                             

                        </div> <!-- row -->
                        <div class="tm-banner-overlay"></div>
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>
            
                  
            <div class="tm-container-outer" id="tm-section-3">
                <div class="tab-content clearfix">   
                    
                    <!-- Tab 4 -->
                    <div class="tab-pane fade show active" id="4a">
                    <!-- Current Active Tab WITH "show active" classes in DIV tag -->
                        <div class="tm-recommended-place-wrap">
                        <?php
                            if(count($AllpkgData) > 0){
                            foreach($AllpkgData as $AllpkgData){?>
                            
                            <div class="tm-recommended-place">
                            <?php
                            $imagePath = "./resources/images/packages/default.png";
                            if(file_exists("./resources/images/packages/" . $AllpkgData['pkg_id'])) {
                                $images = scandir("./resources/images/packages/" .$AllpkgData['pkg_id']);
                                
                                if (count($images) > 2) {
                                    $imagePath = "./resources/images/packages/" . $AllpkgData['pkg_id'] . "/" .$images[2];
                                }
                            }
                            ?>
                            <img src="<?php echo $imagePath; ?>" alt="Image" class="img-fluid tm-recommended-img">
                                <div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php  echo $AllpkgData['pkg_name'];?></h3>
                                    <p class="tm-text-highlight">Adults: <?php
                                                                        
                                                                            echo $AllpkgData['no_of_adults'];
                                                                        
                                                                    ?> | Children: <?php
                                                                    
                                                                        echo $AllpkgData['no_of_children'];
                                                                    
                                                                ?>  | Package Type:  <?php
                                                               
                                                                    echo $AllpkgData['pkg_cat'];
                                                                
                                                            ?>|Room size: <?php echo $AllpkgData['size_of_rooms'];?> m <sup>2</sup></p>
                                    <p class="tm-text-gray"> <?php echo $AllpkgData['pkg_des'];?> </p>   
                                    <button type="button" onclick="loadPkgData(<?php echo $AllpkgData['pkg_id'];?>)" class="btn btn-primary" data-toggle="modal" data-target="#pkgModal">
                                        View
                                    </button>
                                </div>
                                <a href="#" class="tm-recommended-price-box">
                                    <p class="tm-recommended-price">
                                    <?php
                                    $rate =$AllpkgData['rate_per_night'];
                                    if (($AllpkgData['discount_from'] <= date('Y-m-d') && $AllpkgData['discount_until'] >= date('Y-m-d'))) {

                                            echo  " <del style='font-size: 20px;'>  $$rate </del>"  . "    " . "$" .  $AllpkgData['discount'];
                                            
                                            } else {


                                            echo " $" . $rate;
                                        
                                            }
                                            ?>

                                    
                                    </p>
                                    <p class="tm-recommended-price-link">Book Now </p>
                                </a> 
                                                    
                            </div>
                            <?php
                            }
                        } 
                                ?>

                            
                                
                        </div>     
                    </div> <!-- tab-pane -->
                </div>
            </div>

            <footer class="tm-container-outer">
                <p class="mb-0">Copyright © <span class="tm-current-year">2018</span> Your Company 
                    
                . Designed by <a rel="nofollow" href="http://www.google.com/+templatemo" target="_parent">Template Mo</a></p>
            </footer>
        </div>
    </div> <!-- .main-content -->

    <!-- Packages view modal -->
    <div class="modal fade" id="pkgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 10%;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="row " ><div class="col-sm-12"></div></div>
                        <div class="row">
                            <div class="col-sm-12">
                            </div>
                        </div>
                                        
                            <section class="tm-slideshow-section">
                                <div class="tm-slideshow" id="slideshow">
                                </div>
                                <div class="tm-slideshow-description tm-bg-primary">
                                    <h1 class="" id="pkg-name" style="text-align:center"></h1>
                                    <p style="float:left">Package Category : </p> <p id="pkg_type"></p>
                                    <p style="float:left">Bed Type : </p> <p id="bed_type"></p>
                                    <p style="float:left">No Of Adults : </p> <p id="no_of_adults"></p>
                                    <p style="float:left">No Of Children : </p> <p id="no_of_children"></p>
                                    <p style="float:left">No Of Beds : </p> <p id="no_of_bed"></p>
                                    <p style="float:left">Package Description : </p> <p id="pkg_des" ></p>
                                    <p style="float:left">Package Services: </p> <p  id="services"></p>
                                    <p style="float:left">Size Of the Room : </p> <p id="size_of_rooms"></p>
                                     </br>
                                     </br>


                                    <a href="#" class="text-uppercase tm-btn tm-btn-white tm-btn-white-primary">Book Now</a>
                                </div>
                            </section>



                    </div>
                        
                </div>
            </div>
        </div>
    </div>

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

</body>
</html>