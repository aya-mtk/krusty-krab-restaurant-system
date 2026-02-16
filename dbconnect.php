<?php

require 'vendor/autoload.php';

$m = new MongoDB\Client("mongodb://localhost:27017");

$db = $m->restaurantdb; 

?>