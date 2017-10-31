<?php
session_start();
ob_start();
$_SESSION["email"] = trim(htmlspecialchars($_POST["email"]));
$_SESSION["password"] = trim(htmlspecialchars($_POST["password"]));
$login_page = "Location:login.php?msg=";
$index_page = "Location:index.php";
$msg = "Invalid login credentials.";

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
$index = array_search($_SESSION["email"], $_SESSION["email_array"]);
    if (is_numeric($index) && strcmp($_SESSION["email"], $_SESSION["email_array"][$index])==0 && strcmp($_SESSION["password"], $_SESSION["password_array"][$index])==0) {
        header($index_page);
    } else {
        unset($_SESSION["email"]);
        unset($_SESSION["password"]);
        header($login_page . $msg);
    }
