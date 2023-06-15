<?php
session_start();
if(!isset($_SESSION['customer_info'])){
    header("Location: index.php");
}
$customerInfo = $_SESSION['customer_info'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap style -->

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    <style>
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div id="dropin-container"></div>
                <button id="submit-button" class="button button--small button--green">Purchase</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>


    <script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
        // Insert your tokenization key here
        authorization: 'sandbox_w3z5z9k8_4t6xbbcmmx5c2585',
        container: '#dropin-container'
    }, function(createErr, instance) {
        button.addEventListener('click', function() {
            instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                // When the user clicks on the 'Submit payment' button this code will send the
                // encrypted payment information in a variable called a payment method nonce
                $.ajax({
                    type: 'POST',
                    url: './paymentHandler.php',
                    data: {
                        'paymentMethodNonce': payload.nonce,
                        arrival_date: '<?php echo $_GET['arr_date']; ?>',
                        leaving_date: '<?php echo $_GET['lev_date']; ?>',
                        pkg_id: '<?php echo $_GET['pkg_id']; ?>'

                    }
                }).done(function(result) {
                    // Tear down the Drop-in UI
                    instance.teardown(function(teardownErr) {
                        if (teardownErr) {
                            console.error('Could not tear down Drop-in UI!');
                        } else {
                            console.info('Drop-in UI has been torn down!');
                            // Remove the 'Submit payment' button
                            $('#submit-button').remove();
                        }
                    });

                    if (result == 1) {
                        //ajax
                        $.post('./reservationajax.php', {
                            action: 'addReservation',
                            arrival_date: '<?php echo $_GET['arr_date']; ?>',
                            leaving_date: '<?php echo $_GET['lev_date']; ?>',
                            adults: '<?php echo $_GET['adults']; ?>',
                            children: '<?php echo $_GET['children']; ?>',
                            pkg_id: '<?php echo $_GET['pkg_id']; ?>',
                            cus_id: '<?php echo $customerInfo['cus_id']; ?>'

                        }, function(data) {

                            if (data == -1) {
                                alert('Something went wrong!');
                                window.location = 'index.php';
                            } else {
                                window.open('invoicepdf.php?payment_id=' +
                                    data + '&type=advance', '_blank');
                                window.location = 'dashboard.php';
                            }

                        });
                    } else {
                        console.log(result);
                        $('#checkout-message').html(
                            '<h1>Error</h1><p>Check your console.</p>');
                    }
                });
            });
        });
    });
    </script>

</html>