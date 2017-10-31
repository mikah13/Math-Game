<?php
session_start();
ob_start();
echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Math Game">
    <meta name="author" content="Jeff Wasty, Mike Hoang">
    <link rel="icon" href="images/icon.png">

    <title>Math Game</title>

    <!-- Bootstrap core CSS -->
    <link href="https://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://v4-alpha.getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- Custom stylesheet-->
    <link href="css/main.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
</head>

<body>
<h1 id="title">The Math Game</h1>
';
$login_page = "Location:login.php";
if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
    header($login_page);
}

$total = isset($_POST["total"]) ? (int)$_POST["total"] : 0;
$score = isset($_POST["score"]) ? (int)$_POST["score"] : 0;
$answer = $_POST["answer"];
$first_number = rand(0, 50);
$second_number = rand(0, 50);
$rand_operation = rand(0, 2);
$array = array(
    "+",
    "-",
    "*"
);
$math_operation = $array[$rand_operation];

function calculate($first, $second, $operator)
{
    if ($operator === "+") {
        return $first + $second;
    } elseif ($operator === "-") {
        return $first - $second;
    } else {
        return $first * $second;
    }
}

$last_result = calculate($_POST["first_number"], $_POST["second_number"], $_POST["math_operation"]);

if (isset($answer) && is_numeric($answer)) {
    if ((int)$answer !== (int)$last_result) {
        $message = "INCORRECT, " . $_POST["first_number"] . " " . $_POST["math_operation"] . " " . $_POST["second_number"] . " = " . $last_result . "<br";
        $correct = " ";
    } else {
        $message = " ";
        $correct = "Correct!";
        $score++;
    }

    $total++;
} elseif (isset($answer) && (empty($answer) || !is_numeric($answer))) {
    $message = "You must enter a number for your answer";
    $correct = " ";
}

echo '<div class="container">
        <form class="form-signin" action="index.php" method="post" autocomplete="off">
        <h4 id="question">Calculate: ' . $first_number . $math_operation . $second_number . '</h4>
        <input type="hidden" name="first_number" value="' . $first_number . ' "/>
        <input type="hidden" name="math_operation" value="' . $math_operation . '"/>
        <input type="hidden" name="second_number" value="' . $second_number . '"/>
        <input type="hidden" name="total" value="' . $total . ' "/>
        <input type="hidden" name="score" value="' . $score . ' "/>
        <input type="text" class="form-control" placeholder="Enter answer" name="answer">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button><hr />
        <h4 id="score">Score:
        ' . $score . ' / ' . $total . '
        </h4><div class="error-message">' . $message . '</div>
        <div class="correct-message">' . $correct . '</div>
        </form>
    </div>
    <div class="container">
        <form class="form-signin" action="logout.php" method="post">
        <button class="btn btn-lg btn-warning btn-block" id="logout" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>';
