<?php
  include './controller/CustomerController.php';
  session_start();
$urlData = '';
if(isset($_GET['arr_date']) && isset($_GET['lev_date'])){
    $urlData .= "?arr_date=" . $_GET['arr_date'] . '&lev_date=' . $_GET['lev_date'] . '&adults=' . $_GET['adults'] . '&children=' . $_GET['children'];
    if(isset($_SESSION['customer_info'])){
        header("Location: reservationsummary.php" . $urlData);
    }  
}

  if(isset($_SESSION['customer_info'])){
      header("Location: index.php");
  }
if(isset($_POST['submit'])){
  

    $customerController = new CustomerController();
    $customerController->Login($_POST['user-name'], sha1($_POST['password']));

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $customerController = new customerController();
    $customerController->addCustomer($_POST);
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
 <!-- row -->
                        <div class="row tm-banner-row" id="tm-section-search">
                        <div class="col-sm-5"  >
                        <div class="tm-banner-header" style="text-align:center"> <h1 class="text-uppercase tm-banner-title"> LOGIN</h1> </div>
                        <div style="padding-top: 100px;">
                        
                        <form action="login.php" method="post" enctype="multipart/form-data" class="form-horizontal tm-search-form tm-section-pad-2" id="adduser">
                                   
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label"> User Name</label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="user-name" name="user-name" placeholder="Enter Your User Name" class="form-control" required>
                                           <span class="text text-danger small" id="user-name-error"></span>
                                       </div>
                                   </div>
                                   
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="password" id="password" name="password" placeholder="Enter your Password" class="form-control" required>
                                           <span class="text text-danger small" id="pw-error"></span>
                                       </div>
                                   </div>

                                   <div class="text text-danger small text-right" id="cus-login-error">
                                    <?php
                                        if(isset($_GET['err'])){
                                            echo base64_decode($_GET['err']);
                                        }
                                    ?>
                                    </div>
                                             
                                    <div class="modal-footer">
                                    
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                    </div>
                        </form>
                        </div>
                        </div>
                        <div class="col-sm-2 tm-banner-header" style="top:250px; text-align:center"><h1 class="text-uppercase tm-banner-title" > OR</h1></div>
                        <div class="col-sm-5">
                        <div class="tm-banner-header" style="text-align:center"><h1 class="text-uppercase tm-banner-title"> Register</h1></div>
                        <div style="padding-bottom: 100px;">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal tm-search-form tm-section-pad-2" id="addCustomerForm">
                                   
                                   <div class="row form-group">
                                   <div class="col col-md-3"><label for="text-input" class=" form-control-label" > Fist Name<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-fname" name="cus-fname" placeholder=" First Name" class="form-control" required>
                                           <span class="text text-danger small" id="cus-fname-error"></span>
                                       </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label" > Surname<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-lname" name="cus-lname" placeholder=" Surame" class="form-control" required>
                                           <span class="text text-danger small" id="cus-lname-error"></span>
                                   </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Country<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-country" name="cus-country" placeholder=" Country" class="form-control" required>
                                           <span class="text text-danger small" id="cus-country-error"></span>
                                       </div>
                                   </div>
                                  
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email <span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="email" id="cus-email" name="cus-email" placeholder=" Email" class="form-control" required>
                                           <span class="text text-danger small" id="cus-email-error"></span>
                                       </div>
                                   </div>

                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIC Number<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-nic" name="cus-nic" placeholder="NIC" class="form-control" required>
                                           <span class="text text-danger small" id="cus-nic-error"></span>
                                       </div>
                                   </div>
                                  
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date Of Birth<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9"><input type="date" id="cus-dob" name="cus-dob" placeholder=" Date Of Birth" class="form-control" max="<?php echo date('Y-m-d', strtotime('-18 year')) ?>" required></div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contact number<span style="color: red;">*</span> </label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="cus-tel" name="cus-tel" placeholder="Phone number" class="form-control" required>
                                           <span class="text text-danger small" id="cus-tel-error"></span>
                                       </div>
                                   </div>

                                  
                                   <div class="row form-group" required>
                                       <div class="col col-md-3"><label class=" form-control-label">Gender<span style="color: red;">*</span> </label></div>
                                       <div class="col col-md-9">
                                        <div class="form-check-inline form-check">

                                               <label for="inline-radio1" class="form-check-label ">
                                                   <input type="radio" id="cus-genderf" name="cus-gender" value="Female" class="form-check-input">Female 
                                               </label>

                                               <label for="inline-radio2" class="form-check-label ">
                                                   <input type="radio" id="cus-genderm" name="cus-gender" value="Male" class="form-check-input" checked>Male
                                               </label>  
                                        </div>
                                       </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="text-input" class=" form-control-label"> User Name<span style="color: red;">*</span></label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="text" id="reg-user-name" name="reg-user-name" placeholder="Enter Your User Name" class="form-control" required>
                                           <span class="text text-danger small" id="reg-user-name-error"></span>
                                       </div>
                                   </div>
                                   
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password <span style="color: red;">*</span></label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="password" id="regpassword" name="regpassword" placeholder="Enter your Password" class="form-control" required>
                                           <span class="text text-danger small" id="regpw-error"></span>
                                       </div>
                                   </div>
                                   <div class="row form-group">
                                       <div class="col col-md-3"><label for="password-confirm" class=" form-control-label">Confirm Password <span style="color: red;">*</span></label></div>
                                       <div class="col-12 col-md-9">
                                           <input type="password" id="regpassword-confirm" name="password-input" placeholder="Confirm Your Password" class="form-control" required>
                                           <span class="text text-danger small" id="regconfirm-pw-error"></span>
                                       </div>
                                   </div>
                                   
                                                  
                                    <div class="modal-footer">
                                    
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                        </div>
                                                    
                        </div>
                        </div>
                        <div class="tm-banner-overlay"></div>
                    </div>  <!-- .container -->                   
                </div>     <!-- .tm-container-outer -->                 
            </section>
            
                  
            <div class="tm-container-outer" id="tm-section-3">
                <div class="tab-content clearfix">   
                    
                    <!-- Tab 4 -->
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
    $("#addCustomerForm").submit(function (event){
            event.preventDefault();
            var fName = $("#cus-fname").val();
            var lname = $("#cus-lname").val();
            var email = $("#cus-email").val();
            var nic = $("#cus-nic").val();
            var tel = $("#cus-tel").val();
            var password = $("#regpassword").val();
            var confirmpassword = $("#regpassword-confirm").val();
            var username = $("#reg-user-name").val();
           
            

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
            if(!nic.match(patternnicold) && !nic.match(patternnicnew) ){
                $("#cus-nic-error").text("Invalid Format!");
                $("#cus-nic").focus();
                return false;
            }
            if(!tel.match(patterntel)){
                $("#cus-tel-error").text("Invalid Format!");
                $("#cus-tel").focus();
                return false;
            }
            if(password.length < 8 ){
						$("#regpw-error").text(" Password is Too Short");
						$("#regpassword").focus();
						return false;
                    }
                if(password != confirmpassword){
                            $("#regpassword").focus();
                            $("#regconfirm-pw-error").text("Password do not match");
                            return false;
                }
            
            

            $.post('./packagesajax.php',{
                action: 'checkEmailANDNicExistence',
                email: email,
                nic: nic,
                username: username
            
            }, function(response){
                if(response == 1){
                    $("#reg-user-name-error").text("User Name exist in the system. Please enter different User Name address");
                    $("#reg-user-name").focus();
                    return false; 
                }else if(response == 2){
                    $("#cus-nic-error").text("NIC exist in the system. Please Login");
                    $("#cus-nic").focus();
                    return false;
                }
                else if(response == 3){
                    $("#reg-user-name-error").text("User name exist in the system. Please enter different email address");
                    $("#cus-nic").focus();
                    $("#cus-nic-error").text("NIC exist in the system. Please Login");
                    return false; 
                }

                else if(response==4){
                    $("#cus-email-error").text("Email address exist in the system. Please enter different email address");
                    $("#cus-email").focus();
                }
            
                else if(response == 6){
                    $("#cus-email-error").text("Email address exist in the system. Please enter different email address");
                    $("#cus-email").focus();
                    $("#cus-nic-error").text("NIC exist in the system. Please Login");
                    return false; 
                }
                else if(response==4){
                    $("#cus-email-error").text("Email address exist in the system. Please enter different email address");
                    $("#cus-email").focus();
                   

                }
                else if(response==5){
                    $("#cus-email-error").text("Email address exist in the system. Please enter different email address");
                    $("#cus-email").focus();
                    $("#reg-user-name-error").text("Email address exist in the system. Please enter different email address");
                   

                }
               
                else if(response == -1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                   return false;

                }
               
                else{
                    $("#addCustomerForm").unbind('submit').submit();
                }
            });

        });

        $("#cus-fname").keyup(function (){
            $("#cus-fname-error").text("");
        });

        $("#cus-lname").keyup(function (){
            $("#cus-lname-error").text("");
        });

        $("#cus-nic").keyup(function (){
            $("#cus-nic-error").text("");
        });

        $("#cus-tel").keyup(function (){
            $("#cus-tel-error").text("");
        });
        $("#cus-email").keyup(function (){
            $("#cus-email-error").text("");
        });
        $("#reg-user-name").keydown(function(){
        $("#reg-user-name-error").text("");

        });
        $("#regpassword").keydown(function(){
            $("#regpw-error").text("");
        });
        $("#regpassword-confirm").keydown(function(){
            $("#regconfirm-pw-error").text("");
        });

    
        </script>  


          

</body>
</html>