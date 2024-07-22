<?php
include '../database.php';
session_start();

if (isset($_SESSION['username'])) 
{
    header('Location: welcome.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database = Database::getInstance();
    $conn = $database->getConnection();

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) 
    {
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit();
    } else {
        echo "Invalid username or password!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2 class="container__heading">Login</h2>
        <form class="form" method="post" action="login.php" onsubmit="return validateLoginForm()">
            Username: <input class="form__input" type="text" name="username" required><br>
            Password: <input class="form__input" type="password" name="password" required><br>
            <input class="form__submit" type="submit" value="Login">
        </form>
        <p>Create a new account? <a href="register.php">Register</a></p>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
