<?php
session_start();
session_unset();
session_destroy();
echo "You have been logged out!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Logout</h2>
        <a href="login.php">Login again</a>
    </div>
</body>
</html>
