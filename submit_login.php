<?php
$sessionTimeout = 1800; // Session timeout duration in seconds (30 minutes)
session_set_cookie_params($sessionTimeout);
session_start();

require_once('dbconnect.php');

$maxFailedAttempts = 3; // Maximum number of failed attempts before account is locked
$lockoutDuration = 1800; // Lockout duration in seconds (30 minutes)

if(isset($_SESSION['user'])){
    // Check if the session has timed out
    if(isset($_SESSION['lastActivity']) && time() - $_SESSION['lastActivity'] > $sessionTimeout) {
        session_unset();
        session_destroy();
        header('Location: PhpLogin.php');
        exit();
    }
    $_SESSION['lastActivity'] = time();
    header('Location: UserHome.php');
    exit();
}

if(isset($_SESSION['admin'])){
    // Check if the session has timed out
    if(isset($_SESSION['lastActivity']) && time() - $_SESSION['lastActivity'] > $sessionTimeout) {
        session_unset();
        session_destroy();
        header('Location: PhpLogin.php');
        exit();
    }
    $_SESSION['lastActivity'] = time();
    header('Location: AdminHome.php');
    exit();
}

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $password = hash('sha256', $_POST['password']);
    $resultUser = $db->users->findOne(array('email'=>$email, 'password'=>$password));
    $resultAdmin = $db->admin->findOne(array('email'=>$email, 'password'=>$password));

    // Check if the account is locked
    if(isset($_SESSION['failedAttempts']) && $_SESSION['failedAttempts'] >= $maxFailedAttempts && time() - $_SESSION['lastLoginAttempt'] < $lockoutDuration) {
        $remainingLockoutTime = $lockoutDuration - (time() - $_SESSION['lastLoginAttempt']);
        header("Location: PhpLogin.php?error=Account locked. Please try again in $remainingLockoutTime seconds");
        exit();
    }

    if(!$resultUser && !$resultAdmin){
        // Increment the failed login attempt counter
        $_SESSION['failedAttempts'] = isset($_SESSION['failedAttempts']) ? $_SESSION['failedAttempts'] + 1 : 1;
        $_SESSION['lastLoginAttempt'] = time();
        header("Location: PhpLogin.php?error=Incorrect email or password");
        exit();
    }
    else if($resultUser && !$resultAdmin){
        $_SESSION['user'] = $resultUser->_id;
        $_SESSION['lastActivity'] = time();
        // Reset the failed login attempt counter
        unset($_SESSION['failedAttempts']);
        header('Location: UserHome.php');
        exit();
    }
    else if(!$resultUser && $resultAdmin){
        $_SESSION['admin'] = $resultAdmin->_id;
        $_SESSION['lastActivity'] = time();
        // Reset the failed login attempt counter
        unset($_SESSION['failedAttempts']);
        header('Location: AdminHome.php');
        exit();
    }
}



?>
