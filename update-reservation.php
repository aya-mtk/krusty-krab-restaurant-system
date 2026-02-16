<?php

require 'vendor/autoload.php';

$m = new MongoDB\Client("mongodb://localhost:27017");

$db = $m->restaurantdb;

$collection = $db->Reservations;

if(isset($_POST['fullName'])){
$reservationId = $_POST['id'];
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$numGuests = $_POST['numGuests'];
$comments = $_POST['comments'];

$filter = ['_id' => new MongoDB\BSON\ObjectID($reservationId)];
$update = [
    '$set' => [
        'fullName' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'date' => $date,
        'startTime' => $startTime,
        'endTime' => $endTime,
        'numGuests' => $numGuests,
        'comments' => $comments
    ]
];

$result = $collection->updateOne($filter, $update);
}
if ($result->getModifiedCount() === 1) {
    echo 'Reservation updated successfully';
} else {
    echo 'Failed to update reservation';
}

?>
