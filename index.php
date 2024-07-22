<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login-Register Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container--center">
        <h2 class="container__heading">Register yourself to access exclusive content and features! </h2><br>
        <br>

        <form class="form" action="pages/register.php" method="get">
            <input class="form__submit" type="submit" value="Registration form">
        </form>
        <br>
        <form class="form" action="pages/login.php" method="get">
            <input class="form__submit" type="submit" value="Login form">
        </form>
    </div>
</body>
</html>
