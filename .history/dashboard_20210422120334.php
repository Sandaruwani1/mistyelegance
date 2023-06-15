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
<!-- <style>
@charset "UTF-8";
:root {
  --star-size: 30px;
  --star-color: #fff;
  --star-background: #fc0;
}

.Stars {
  --percent: calc(var(--rating) / 5 * 100%);
  display: inline-block;
  font-size: var(--star-size);
  font-family: Times;
  line-height: 1;
}
.Stars::before {
  content: "★★★★★";
  letter-spacing: 3px;
  background: linear-gradient(90deg, var(--star-background) var(--percent), var(--star-color) var(--percent));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

body {
  background: #eee;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

* {
  position: relative;
  box-sizing: border-box;
}
</style> -->

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
                            <img src="./resources/images/customers/default.png" alt="Image" width="80%" height="80%"
                                style="border-radius: 50%; margin: auto; display: block;">
                            <?php
                    } 
                    ?>
                            <button type="button"
                                class="btn btn-primary btn-sm tm-btn tm-btn-search-sm text-uppercase mb-2"
                                data-toggle="modal" data-target="#addimage" style="display:block; margin: auto;"> Add
                                Image
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
                                <span id="cus_fname_error" class="text text-danger"></span>
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
                                <span id="cus_lname_error" class="text text-danger"></span>
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
                                <input type="email" id="email" value="<?php echo $cusData['cus_email']; ?>"
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
                                <span id="tel_error" class="text text-danger"></span>
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
                                    <th>Advance Payment Amount</th>
                                    <th>Reservation Amount</th>

                                </tr>
                                <?php
                                    foreach($onGoingData as $data){
                                ?>
                                <tr>
                                    <td><?php echo $data['arrival_date']; ?></td>
                                    <td><?php echo $data['leaving_date']; ?></td>
                                    <td><?php echo $data['room_no']; ?></td>
                                    <td><?php echo $data['pkg_name']; ?></td>
                                    <td>$<?php echo $data['payment_amount']; ?></td>
                                    <td>$<?php echo $data['res_amount']; ?></td>

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
                                    <th>Arrival Date</th>
                                    <th>Leaving Date</th>
                                    <th>Amount</th>
                                    <th>Rating & Feedback</th>


                                </tr>
                                <?php
                                    foreach($resData as $data){
                                ?>
                                <tr id="<?php echo $data['pkg_id']; ?>">
                                    <td><?php echo $data['pkg_name']; ?></td>
                                    <td><?php echo $data['room_no']; ?></td>
                                    <td><?php echo $data['arrival_date']; ?></td>
                                    <td><?php echo $data['leaving_date']; ?></td>
                                    <td>$<?php echo $data['full_payment_amount']; ?></td>
                                    <?php
                                        
                                        if ($data['rating']== "" &&  $data['feedback'] == "") {
                                            ?>
                                    <td><button type="button"
                                            class="btn btn-primary tm-btn-primary tm-btn-send text-uppercase"
                                            data-toggle="modal" data-target="#exampleModalCenter"
                                            onclick="fillDataToModal(<?php echo $data['pkg_id']; ?>, '<?php echo $data['pkg_name']; ?>')">Add
                                            Rating & FeedBack</button>
                                    </td>
                                    <?php
                                        }else { ?>

                                    <td class="rating-td">
                                        <div class="Stars" style="--rating: <?php echo $data['rating']; ?>;"
                                            aria-label="Rating of this product is <?php echo $data['rating']; ?> out of 5.">
                                        </div>
                                        <br />
                                        <?php echo $data['feedback']; ?>


                                    </td>
                                    <?php } ?>
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
    <!--modal-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 1000000000;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedback-modal-heading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="rating"></div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea name="feedback" id="feedback" rows="8" placeholder="Feedback"
                                    style="width: 100%"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="feedback-pkg-id" value="" />
                    <input type="hidden" id="feedback-rating" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="feedback-modal-close-btn">Close</button>
                    <button type="submit" id="add-rating" class="btn btn-primary">Add Rating & Feedback</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Packages view modal -->
    <div class="modal fade" id="addimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="z-index: 1000000000;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">change user image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editImageForm" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label"> Image
                                </label></div>
                            <div class="col-12 col-md-9"><input type="file" id="cus-image" name="file-input"
                                    class="form-control-file" accept="image/*"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" value="editImage" />
                        <input type="hidden" name="customerId" value="<?php echo $cusData['cus_id'];?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- load JS files -->


    <script src="js/jquery-1.11.3.min.js"></script> <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script> <!-- https://popper.js.org/ -->
    <script src="js/bootstrap.min.js"></script> <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script> <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>
    <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script> <!-- http://kenwheeler.github.io/slick/ -->
    <script src="js/jquery.scrollTo.min.js"></script> <!-- https://github.com/flesler/jquery.scrollTo -->
    <script src="./resources/jQueryemojirating/jquery.emojiRatings.min.js"></script>
    <!-- sweetalert js -->
    <script type="text/javascript" src="./resources/sweetalert/sweetalert2.min.js"></script>
    <script>
    // rating plugin
    // Defaults
    options = {
        emoji: 'U+2B50',
        count: 5,
        fontSize: 16,
        inputName: 'rating',
        onUpdate: function(value) {
            $("#feedback-rating").val(value);
        }
    }

    $('#rating').emojiRating(options);


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
        event.preventDefault();
        var newfname = $("#first_name").val();
        var namePattern = /^[a-zA-Z]{1,}$/;
        if (!newfname.match(namePattern)) {
            $("#cus_fname_error").text("Invalid Format! First Name can have only one or more characters");
            $("#first_name").focus();
            return false;
        } else {
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
        }
    });

    $("#lname-submit-btn").click(function() {
        event.preventDefault();
        var newlname = $("#last_name").val();
        var namePattern = /^[a-zA-Z]{1,}$/;
        if (!newlname.match(namePattern)) {
            $("#cus_lname_error").text("Invalid Format! First Name can have only one or more characters");
            $("#last_name").focus();
            return false;
        } else {

            $.post('./dashboardajax.php', {
                action: 'editcusLname',
                newlname: newlname,
                cusId: "<?php echo $customerInfo['cus_id']; ?>"

            }, function(response) {
                if (response == 1) {
                    location.reload();
                    $("#lastname-div").addClass("form-group d-none");

                } else if (response == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                    return false;

                }

            });
        }
    });

    $("#email-submit-btn").click(function() {

        var newemail = $("#email").val();

        $.post('./dashboardajax.php', {
            action: 'editcusEmail',
            newemail: newemail,
            cusId: "<?php echo $customerInfo['cus_id']; ?>"

        }, function(response) {
            if (response == 1) {
                location.reload();
                $("#email-div").addClass("form-group d-none");

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
    $("#contact-submit-btn").click(function() {
        event.preventDefault();
        var newtel = $("#contact_no").val();
        var patterntel = /^[0-9]{9,12}$/;
        if (!newtel.match(patterntel)) {
            $("#tel_error").text("Invalid Format!");
            $("#contact_no").focus();
            return false;
        } else {

            $.post('./dashboardajax.php', {
                action: 'editcusTel',
                newtel: newtel,
                cusId: "<?php echo $customerInfo['cus_id']; ?>"

            }, function(response) {
                if (response == 1) {
                    location.reload();
                    $("#contact-div").addClass("form-group d-none");

                } else if (response == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'A system error has been occured!'
                    });
                    return false;

                }

            });
        }
    });

    function fillDataToModal(pkgId, pkgName) {
        $("#feedback-pkg-id").val(pkgId);
        $("#feedback-modal-heading").text(pkgName);
    }
    $("#add-rating").click(function() {

        var pkgId = $("#feedback-pkg-id").val();
        var rating = $("#feedback-rating").val();
        var feedback = $("#feedback").val();

        $.post('./dashboardajax.php', {
            action: 'addFeedback',
            pkgId: pkgId,
            rating: rating,
            feedback: feedback,
            cusId: "<?php echo $customerInfo['cus_id']; ?>",




        }, function(response) {
            if (response) {
                var data = jQuery.parseJSON(response);
                Swal.fire(
                    'Rating & feedback is added!',
                    'thank you'
                )

                var output = `
                                    <div class="Stars" style="--rating: ${data['rating']};" aria-label="Rating of this product is ${data['rating']} out of 5."></div>
                                    <br />
                                    ${data['feedback']}
                        `;

                $("#" + data['pkg_id'] + " .rating-td").html(output);
                $("#feedback-modal-close-btn").click();

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'A system error has been occured!'
                });
            }

        });


    });
    
        $("#editImageForm").on('submit', (function(e) {
           
            $.ajax({
                url: "./dashboardajax.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                success: function(data) {
                    if (data == 'invalid') {
                        // invalid file format.
                        $("#err").html("Invalid File !").fadeIn();
                    } else {
                        // view uploaded file.
                        $("#preview").html(data).fadeIn();
                        $("#form")[0].reset();
                    }
                }
            });
        }));
    
    </script>

</body>

</html>