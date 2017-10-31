<?php
session_start();
ob_start();
$signup_email = trim(htmlspecialchars($_POST["signup_email"]));
$signup_password = trim(htmlspecialchars($_POST["signup_password"]));
$signup_page = "Location:signup.php?msg=";
$login_page ="Location:login.php?msg=";
$login_page_success="Location:login.php?success=";
$_SESSION["email_array"]= array();
$_SESSION["password_array"]= array();
if ($file = fopen("credentials.config", "r")) {
    while (!feof($file)) {
        $line = explode(",", fgets($file), 2);
        array_push($_SESSION["email_array"], trim($line[0]));
        array_push($_SESSION["password_array"], trim($line[1]));
    }
    fclose($file);
}

if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
    $msg = "Invalid email";
    header($signup_page.$msg);
} else {
    if (empty($signup_password)) {
        $msg = "Enter a password";
        header($signup_page.$msg);
    } else {
        if (is_numeric(array_search($signup_email, $_SESSION["email_array"]))) {
            $msg = "Account is already existed!";
            header($signup_page.$msg);
        } else {
            $new_account = $signup_email.",".$signup_password;
            file_put_contents("credentials.config", $new_account.PHP_EOL, FILE_APPEND);
            $success = "New Account Created!";
            header($login_page_success.$success);
        }
    }
}
