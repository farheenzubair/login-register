<?php
session_start();

if (!isset($_SESSION['username'])) 
{
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <p>This is your exclusive content and features area.</p>
        <p>Want to logout? <a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
