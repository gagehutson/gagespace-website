<?php

ini_set("session.gc_maxlifetime", 500);
session_set_cookie_params(500);
session_start();

// Multiple valid credentials
$valid_accounts = [

];

// Trim input to remove any spaces accidentally added
$username = trim($_POST['uname'] ?? '');
$password = trim($_POST['psw'] ?? '');

// Debug: Uncomment if you need to see values
// echo "Username: $username<br>Password: $password<br>";

if (array_key_exists($username, $valid_accounts) && $valid_accounts[$username] === $password) {
    $_SESSION["loggedin"] = true;
    header("Location: generic.php");
    exit();
} else {
    echo "Invalid username or password.";
}
?>
