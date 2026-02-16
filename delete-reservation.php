<?php
require 'vendor/autoload.php';

$m = new MongoDB\Client("mongodb://localhost:27017");

$db = $m->restaurantdb;

$collection = $db->Reservations;

if(isset($_POST['id'])){
	$reservationId = $_POST['id'];

	$filter = ['_id' => new MongoDB\BSON\ObjectID($reservationId)];

	$result = $collection->deleteOne($filter);
}

if ($result->getDeletedCount() > 0) {
    echo "Reservation deleted successfully";
} else {
    echo "Error deleting reservation";
}

?>

