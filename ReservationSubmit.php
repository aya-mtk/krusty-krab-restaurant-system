<?php
session_start();
require_once('dbconnect.php');
if (!isset($_SESSION['user'])) {
	header("Location: logout.php");
}

$UserData = $db->users->findOne( array('_id'=>$_SESSION['user']));
$theme = $_GET['theme'];
$id =$UserData['_id'];

if(isset($_POST['fullname']) || isset($_POST['email']) || isset($_POST['phone']) || isset($_POST['date']) || isset($_POST['startTime']) || isset($_POST['endTime']) || isset($_POST['numGuests']) || isset($_POST['comments'])) {
// Validate and sanitize input data
$fullname = isset($_POST['fullname']) ? htmlspecialchars(trim($_POST['fullname'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
$phone = isset($_POST['phone']) ? filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING) : '';
$date = isset($_POST['date']) ? htmlspecialchars(trim($_POST['date'])) : '';
$startTime = isset($_POST['startTime']) ? htmlspecialchars(trim($_POST['startTime'])) : '';
$endTime = isset($_POST['endTime']) ? htmlspecialchars(trim($_POST['endTime'])) : '';
$numGuests = isset($_POST['numGuests']) ? intval($_POST['numGuests']) : 0;
$comments = isset($_POST['comments']) ? htmlspecialchars(trim($_POST['comments'])) : '';

// Validate input data
$errors = [];
if (empty($fullname)) {
    $errors[] = 'Full Name is required';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}
if (empty($phone)) {
    $errors[] = 'Phone number is required';
}
if (empty($date)) {
    $errors[] = 'Date is required';
}
if (empty($startTime)) {
    $errors[] = 'Start time is required';
}
if (empty($endTime)) {
    $errors[] = 'End time is required';
}
if ($numGuests < 1) {
    $errors[] = 'Number of guests should be greater than zero';
}

// Check for availability
if (empty($errors)) {
    $result = $db->Reservations->find([
        'date' => $date,
        '$or' => [
            [
                'startTime' => ['$lte' => $startTime],
                'endTime' => ['$gt' => $startTime],
            ],
            [
                'startTime' => ['$lt' => $endTime],
                'endTime' => ['$gte' => $endTime],
            ]
        ]
    ]);

    $documents = iterator_to_array($result);
    $count = count($documents);

    if ($count == 0) {
        // Insert new reservation
        $result = $db->Reservations->insertOne([
            'fullName' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'numGuests' => $numGuests,
            'comments' => $comments,
            'userId' => $id,
            'createdAt' => date('Y-m-d')
        ]);

        if ($result->getInsertedCount() === 1) {
            // Reservation created successfully, redirect to success page
            header("Location: ReservationOrder.php?theme=$theme&message=Reservation was successfully inserted");
            exit();
        } else {
				header("Location: ReservationOrder.php?theme=$theme&message=Error occurred while inserting reservation");
			}
		}
	   
	   else {
		   header("Location: ReservationOrder.php?theme=$theme&message=Already Reserved, try with a different time!");
	   }

	}
}
?>