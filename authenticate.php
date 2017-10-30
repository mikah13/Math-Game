<?php
session_start();
ob_start();
$_SESSION["email"] = htmlspecialchars($_POST["email"]);
$_SESSION["password"] = htmlspecialchars($_POST["password"]);
$login_page = "Location:login.php?msg=";
$index_page = "Location:index.php";
$msg = "Invalid login credentials.";
$line1 = explode("\n", file_get_contents("credentials.config") , 2) [0];
$line2 = explode("\n", file_get_contents("credentials.config") , 2) [1];
$_SESSION["account1"] = array(
	explode(",", $line1, 2) [0],
	explode(",", $line1, 2) [1]
);
$_SESSION["account2"] = array(
	explode(",", $line2, 2) [0],
	explode(",", $line2, 2) [1]
);

if ((strcmp($_SESSION["email"], $_SESSION["account1"][0]) === 0 && strcmp($_SESSION["password"], $_SESSION["account1"][1]) === - 1) || (strcmp($_SESSION["email"], $_SESSION["account2"][0]) === 0 && strcmp($_SESSION["password"], $_SESSION["account2"][1]) === - 2)) {
	header($index_page);
}
else {
	header($login_page . $msg);
}

?>
