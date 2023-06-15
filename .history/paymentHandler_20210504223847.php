<?php

    require_once './resources/braintree-php-6.0.0/lib/Braintree.php';

    $pkgId = $_POST['pkg_id'];
    $arrivalDate=$_POST['arrival_date'];
    $leavingDate = $_POST['leaving_date'];

    // amount
    $amount = 0;

    $config = new Braintree\Configuration([
        'environment' => 'sandbox',
        'merchantId' => '4t6xbbcmmx5c2585',
        'publicKey' => 'yw23hhqqczy3gkm2',
        'privateKey' => '8ff1654c9dd4711461747b7c8be96d01'
    ]);
    $gateway = new Braintree\Gateway($config);

    // Then, create a transaction:
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => 'fake-valid-nonce',
        'options' => [ 'submitForSettlement' => true ]
    ]);

    if ($result->success) {
        echo 1;
    } else if ($result->transaction) {
        echo -1;
    } else {
        echo -1;
    }


?>