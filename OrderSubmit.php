<?php
session_start();
require_once('dbconnect.php');
if (!isset($_SESSION['user'])) {
    header("Location: logout.php");
}

$userData = $db->users->findOne(array('_id' => $_SESSION['user']));
$userID = $userData->_id;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
   $dishes = json_decode($_POST['dishes']);

    // Handle payment method
    if ($_POST['payment'] == 'cash') {
        // Handle cash payment here
        $paymentMethod = 'Cash on Delivery';
        $creditCardData = null;
    } else {
        // Handle credit card payment here
        $paymentMethod = 'Credit Card';
        $ccName = $_POST['cc-name'];
        $ccNumberHash = hash('sha256', $_POST['cc-number']);
        $ccExpiration = $_POST['cc-expiration'];
        $ccSecurityCodeHash = hash('sha256', $_POST['cc-security-code']);
        $creditCardData = array(
            'number' => $ccNumberHash,
            'expiration' => $ccExpiration
        );
    }

    // Insert the order into the database
    $order = array(
        'clientid' => $userID->__toString(),
        'dishes' => $dishes,
        'status' => 'pending',
        'payment_method' => $paymentMethod,
        'credit_card' => $creditCardData,
        'delivery_address' => array(
            'full_name' => $_POST['firstname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'city' => $_POST['city']
        ),
        'order_date' => new MongoDB\BSON\UTCDateTime(),
    );

    $result = $db->orders->insertOne($order);

    if ($result->getInsertedCount() == 1) {
        // Redirect the user to a success page
        header("Location: order_success.php");
    } else {
        // Redirect the user to an error page
        header("Location: order_error.php");
    }
}


?>
