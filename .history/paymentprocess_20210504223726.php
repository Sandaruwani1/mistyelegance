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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .spinner {
        width: 140px;
        height: 140px;
        margin: 10px auto;
        background-color: #333;

        border-radius: 100%;
        -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
        animation: sk-scaleout 1.0s infinite ease-in-out;
    }

    @-webkit-keyframes sk-scaleout {
        0% {
            -webkit-transform: scale(0)
        }

        100% {
            -webkit-transform: scale(1.0);
            opacity: 0;
        }
    }

    @keyframes sk-scaleout {
        0% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        100% {
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
            opacity: 0;
        }
    }

    h3 {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="content">
        <h3>Payment Process</h3>
        <div class="spinner"></div>
    </div>

</body>

<script src="js/jquery-1.11.3.min.js"></script>

<script>
// $(document).ready(function (){
//     setTimeout(function (){
//         //ajax
//         $.post('./reservationajax.php', {
//             action: 'addReservation',
//             arrival_date: '<?php echo $_GET['arr_date']; ?>',
//             leaving_date: '<?php echo $_GET['lev_date']; ?>',
//             adults: '<?php echo $_GET['adults']; ?>',
//             children: '<?php echo $_GET['children']; ?>',
//             pkg_id: '<?php echo $_GET['pkg_id']; ?>',
//             cus_id: '<?php echo $customerInfo['cus_id']; ?>'

//         }, function(data) {

//             if(data == -1){
//                 alert('Something went wrong!');
//                 window.location = 'index.php';
//             }else{
//                 window.open('invoicepdf.php?payment_id=' + data +'&type=advance', '_blank');
//                 window.location = 'dashboard.php';
//             }

//         });

//     }, 5000)
// });

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
                    adults: '<?php echo $_GET['adults']; ?>',
                    children: '<?php echo $_GET['children']; ?>',
                    pkg_id: '<?php echo $_GET['pkg_id']; ?>',
                    cus_id: '<?php echo $customerInfo['cus_id']; ?>'

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

                if (result.success) {
                    $('#checkout-message').html(
                        '<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>'
                        );
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