<?php 
    session_start();
    require_once('dbconnect.php');

    function is_valid_password($password){
        // Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password);
    }

    if(isset($_SESSION['user'])){
        header('Location: UserHome.php');
    }
    if(isset($_SESSION['admin'])){
        header('Location: AdminHome.php');
    }

    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $emailresultuser = $db->users->findOne(array('email'=>$email));
        $emailresultadmin = $db->admin->findOne(array('email'=>$email));

        if($emailresultuser || $emailresultadmin){
            header("Location: phpSignup.php?error=email in use");
            exit();
        }
        else {
            if(!is_valid_password($password)){
                header("Location: phpSignup.php?error=Weak Password");
                exit();
            }
            $password = hash('sha256', $password);
            $result = $db->users->findOne(array('email'=>$email, 'password'=>$password));
            $resultAdmin = $db->admin->findOne(array('email'=>$email, 'password'=>$password));
            if(!$result && !$resultAdmin){
                $result = $db->users->insertOne(array('email'=>$email, 'password'=>$password, 'fname'=>$fname, 'lname'=>$lname));
                $result = $db->users->findOne(array('email'=>$email, 'password'=>$password, 'fname'=>$fname, 'lname'=>$lname));
                $_SESSION['user'] = $result->_id;
                header('Location: UserHome.php');
            }
            else{
                header("Location: phpSignup.php?error=Already a user!");
                exit();
            }
        }
    }
?>
