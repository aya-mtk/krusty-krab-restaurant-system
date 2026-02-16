<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
        header("Location: logout.php");
    }
    $userData = $db->users->findOne( array('_id'=>$_SESSION['user']));
    
	function is_valid_password($password){
        // Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password);
    }

	if(isset($_POST['password'])){
		$password = $_POST['password'];
		
		if(!is_valid_password($password)){
			header("Location: UserProfile.php?message=Weak Password");
			exit();
		}
		$password = hash('sha256', $_POST['password']);
		$updateResult = $db->users->updateOne(
			[ '_id' => $userData['_id']],
			[ '$set' => [ 'password' => $password]]
		);
		
		header("Location: UserProfile.php?message=Password changed");
	}
?>