<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: PhpLogin.php');
}

unset($_SESSION['user']);
session_unset();
session_destroy();
header('Location: PhpLogin.php');
exit;