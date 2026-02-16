<?php
session_start();
require_once('dbconnect.php');
if (!isset($_SESSION['user'])) {
    header("Location: logout.php");
}

$userData = $db->users->findOne(array('_id' => $_SESSION['user']));
if (isset($_POST['body'])) {
    $body = $_POST['body'];
    $date = date('Y-m-d H:i:s');
    $fullname = $userData['fname'] . ' ' . $userData['lname'];

    // Check if the review already exists in the database
    $existingReview = $db->Reviews->findOne(array('username' => $fullname, 'body' => $body));
    if (!$existingReview) {
        $db->Reviews->insertOne(array('username' => $fullname, 'body' => $body, 'Date' => $date));
    }
}

// Redirect back to the original page
header('Location: phpReview.php');
exit();
?>