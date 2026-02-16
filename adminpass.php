<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['admin'])) {
        header("Location: PhpLogin.php");
    }
    $adminData = $db->admin->findOne( array('_id'=>$_SESSION['admin']));

	function is_valid_password($password){
        // Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password);
    }

	if(isset($_POST['password'])){
		$password = $_POST['password'];
		
		if(!is_valid_password($password)){
			header("Location: AdminProfile.php?message=Weak Password");
			exit();
		}
		
		$password = hash('sha256', $_POST['password']);
		$updateResult = $db->admin->updateOne(
			[ '_id' => $adminData['_id']],
			[ '$set' => ['password' => $password]]
			);
		header("Location: AdminProfile.php?message=Password changed");
		
	}
?>