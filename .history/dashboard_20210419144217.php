<?php
include_once './controller/CustomerController.php';
session_start();
if(!isset($_SESSION['customer_info'])){
    header("Location: index.php");
}
$customerInfo = $_SESSION['customer_info'];
$customerController = new CustomerController();
$cusData = $customerController->getCustomer($customerInfo['cus_id']);
$onGoingData =$customerController->OngoingresData($customerInfo['cus_id']);
$resData =$customerController->ReshistoryData($customerInfo['cus_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Misty Elegance web</title>
    <!-- 
Journey Template 
http://www.templatemo.com/tm-511-journey
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" href="css/templatemo-style.css"> <!-- Templatemo style -->

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
                        <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse"
                            data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="packages.php">Package</a>
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
                                    <a class="nav-link active" href="dashboard.php">Account</a>
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




        <div class="tm-container-outer" id="tm-section-3">
            <div class="tab-content clearfix">
                <!-- tab-pane -->


                <div class="tm-container-outer" id="tm-section-2">
                    <section class="tm-slideshow-section">
                        <div class="tm-slideshow">
                            <?php
                    if (file_exists("./resources/images/customers/" . $customerInfo['cus_id'])) {
                        ?>
                            <img src="./resources/images/customers/<?php echo $customerInfo['cus_id']; ?>" alt="Image"
                                width="600" height="600" style="border-radius: 50%">
                            <?php
                    }else{
                        ?>
                            <img src="./resources/images/customers/default.png" alt="Image" width="600" height="600"
                                style="border-radius: 50%">
                            <?php
                    } 
                    ?>

                        </div>

                        <div class="tm-slideshow-description tm-bg-primary">

                            <div class="form-group">
                                <div id="firstname11-div">
                                    <label for="name" class=" form-control-label">First Name</label>
                                    <br />
                                    <span>
                                        <h4 style="float: left;"><?php echo  $cusData['cus_fname']; ?></h4>
                                        <button type="button"
                                            class="btn btn-primary btn-sm tm-btn tm-btn-search-sm text-uppercase"
                                            id="editfnamebtn" style="font-size:xx-small;">edit</button>
                                    </span>
                                </div>

                            </div>
                            <div class="form-group d-none" id="firstname-div">
                                <input type="text" id="first_name" value="<?php echo $cusData['cus_fname']; ?>"
                                    placeholder="Enter Username" class="form-control">
                                <span id="user_name_error" class="text text-danger"></span>
                                <div class="form-group" id="username-submit-btn-div">
                                    <button class="btn btn-sm btn-outline-success" id="fname-submit-btn">Submit</button>
                                    <button class="btn btn-sm btn-outline-danger" id="fname-cancel-btn"><i
                                            class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class=" form-control-label">Last Name</label>
                                <br />
                                <span>
                                    <h4 style="float: left;"><?php echo  $cusData['cus_lname']; ?></h4>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm tm-btn tm-btn-search-sm text-uppercase"
                                        id="editlnamebtn" style="font-size :xx-small;">edit</button>
                                </span>
                            </div>
                            <div class="form-group d-none" id="lastname-div">
                                <input type="text" id="last_name" value="<?php echo $cusData['cus_lname']; ?>"
                                    placeholder="Enter Username" class="form-control">
                                <span id="user_name_error" class="text text-danger"></span>
                                <div class="form-group" id="username-submit-btn-div">
                                    <button class="btn btn-sm btn-outline-success" id="lname-submit-btn">Submit</button>
                                    <button class="btn btn-sm btn-outline-danger" id="lname-cancel-btn"><i
                                            class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class=" form-control-label">Email</label>
                                <br />
                                <span>
                                    <h4 style="float: left;"><?php echo  $cusData['cus_email']; ?></h4>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm tm-btn tm-btn-search-sm text-uppercase"
                                        id="editemailbtn" style="font-size :xx-small;">edit</button>
                                </span>
                            </div>
                            <div class="form-group d-none" id="email-div">
                                <input type="text" id="email" value="<?php echo $cusData['cus_email']; ?>"
                                    placeholder="Enter Username" class="form-control">
                                <span id="user_name_error" class="text text-danger"></span>
                                <div class="form-group" id="username-submit-btn-div">
                                    <button class="btn btn-sm btn-outline-success" id="email-submit-btn">Submit</button>
                                    <button class="btn btn-sm btn-outline-danger" id="email-cancel-btn"><i
                                            class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class=" form-control-label">Contact Number</label>
                                <br />
                                <span>
                                    <h4 style="float: left;"><?php echo  $cusData['cus_tel'] ; ?></h4>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm tm-btn tm-btn-search-sm text-uppercase"
                                        id="editcontactbtn" style="font-size :xx-small;">edit</button>
                                </span>
                            </div>
                            <div class="form-group d-none" id="contact-div">
                                <input type="text" id="contact_no" value="<?php echo $cusData['cus_tel']; ?>"
                                    placeholder="Enter Username" class="form-control">
                                <span id="user_name_error" class="text text-danger"></span>
                                <div class="form-group" id="username-submit-btn-div">
                                    <button class="btn btn-sm btn-outline-success"
                                        id="contact-submit-btn">Submit</button>
                                    <button class="btn btn-sm btn-outline-danger" id="contact-cancel-btn"><i
                                            class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class=" form-control-label">NIC</label>
                                <br />
                                <span>
                                    <h4><?php echo  $cusData['cus_id']; ?></h4>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Country </label>
                                <br />
                                <span>
                                    <h4><?php echo  $cusData['cus_country']; ?></h4>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Gender</label>
                                <br />
                                <span>
                                    <h4><?php echo  $cusData['cus_gender']; ?></h4>
                                </span>
                            </div>
                        </div>
                    </section>

                </div>

            </div>

            <div class="tm-container-outer mt-4 mb-4">
                <div class="card">
                    <div class="card-header">Ongoing Reservation</div>
                    <div class="card-body">

                        <div style="overflow-x:auto;">
                            <table class="table table-striped">
                                <tr>
                                    <th>Arrival Date</th>
                                    <th>Leaving Date</th>
                                    <th>Room No</th>
                                    <th>Package Name</th>
                                    <th>Payment Amount</th>
                                    <th>Discount</th>

                                </tr>
                                <?php
                                    foreach($onGoingData as $data){
                                ?>
                                <tr>
                                    <td><?php echo $data['arrival_date']; ?></td>
                                    <td><?php echo $data['leaving_date']; ?></td>
                                    <td><?php echo $data['room_no']; ?></td>
                                    <td><?php echo $data['pkg_name']; ?></td>
                                    <td><?php echo $data['payment_amount']; ?></td>
                                    <td><?php echo $data['discount']; ?></td>

                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tm-container-outer mt-4 mb-4">
                <div class="card">
                    <div class="card-header">Reservation History</div>
                    <div class="card-body">
                        
                        <div style="overflow-x:auto;">
                            <table class="table table-striped">
                                <tr>
                                    <th>Package Name</th>
                                    <th>Room Number</th>
                                    <th>Rating</th>
                                    <th>FeedBack</th>
                                    

                                </tr>
                                <?php
                                    foreach($resData as $data){
                                ?>
                                <tr>
                                    <td><?php echo $data['pkg_name']; ?></td>
                                    <td><?php echo $data['room_no']; ?></td>
                                    <td><?php echo $data['rating']; ?></td>
                                    <td><?php echo $data['feedback']; ?></td>
                                    

                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="tm-container-outer">
                <p class="mb-0">Copyright © <span class="tm-current-year">2018</span> Your Company

                    . Designed by <a rel="nofollow" href="http://www.google.com/+templatemo" target="_parent">Template
                        Mo</a></p>
            </footer>
        </div>
    </div> <!-- .main-content -->

    <!-- Packages view modal -->

    <!-- load JS files -->


    <script src="js/jquery-1.11.3.min.js"></script> <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script> <!-- https://popper.js.org/ -->
    <script src="js/bootstrap.min.js"></script> <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script> <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>
    <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script> <!-- http://kenwheeler.github.io/slick/ -->
    <script src="js/jquery.scrollTo.min.js"></script> <!-- https://github.com/flesler/jquery.scrollTo -->
    <script>
    /* DOM is ready
        ------------------------------------------------*/
    $(function() {

        // Change top navbar on scroll
        $(window).on("scroll", function() {
            if ($(window).scrollTop() > 100) {
                $(".tm-top-bar").addClass("active");
            } else {
                $(".tm-top-bar").removeClass("active");
            }
        });

        // Smooth scroll to search form
        $('.tm-down-arrow-link').click(function() {
            $.scrollTo('#tm-section-search', 300, {
                easing: 'linear'
            });
        });

        // Date Picker in Search form
        var pickerCheckIn = datepicker('#inputCheckIn');
        var pickerCheckOut = datepicker('#inputCheckOut');

        // Update nav links on scroll
        $('#tm-top-bar').singlePageNav({
            currentClass: 'active',
            offset: 60
        });

        // Close navbar after clicked
        $('.nav-link').click(function() {
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
    $("#editfnamebtn").click(function() {
        $("#firstname-div").removeClass("form-group d-none");

    });
    $("#fname-cancel-btn").click(function() {
        $("#firstname-div").addClass("form-group d-none");
    });
    $("#editlnamebtn").click(function() {
        $("#lastname-div").removeClass("form-group d-none");

    });
    $("#lname-cancel-btn").click(function() {
        $("#lastname-div").addClass("form-group d-none");
    });
    $("#editemailbtn").click(function() {
        $("#email-div").removeClass("form-group d-none");

    });
    $("#email-cancel-btn").click(function() {
        $("#email-div").addClass("form-group d-none");
    });
    $("#editcontactbtn").click(function() {
        $("#contact-div").removeClass("form-group d-none");

    });
    $("#contact-cancel-btn").click(function() {
        $("#contact-div").addClass("form-group d-none");
    });
    </script>
    <script>
    $("#fname-submit-btn").click(function() {

        var newfname = $("#first_name").val();

        $.post('./dashboardajax.php', {
            action: 'editcusFname',
            newfname: newfname,
            cusId: "<?php echo $customerInfo['cus_id']; ?>"

        }, function(response) {
            if (response == 1) {
                location.reload();
                $("#firstname-div").addClass("form-group d-none");

            } else if (response == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'A system error has been occured!'
                });
                return false;

            }

        });
    });
    </script>

</body>

</html>