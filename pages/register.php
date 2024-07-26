<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check for duplicate username or email
    if (isset($_POST['check_duplicate'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $database = Database::getInstance();
        $existingUser = $database->getUserByUsername($username);
        $existingEmail = $database->getUserByEmail($email);

        $response = array('username_exists' => false, 'email_exists' => false);

        if ($existingUser) {
            $response['username_exists'] = true;
        }
        if ($existingEmail) {
            $response['email_exists'] = true;
        }

        echo json_encode($response);
        exit();
    }

    // Handle the registration process
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $database = Database::getInstance();
    $conn = $database->getConnection();

    // Check if username or email already exists
    $existingUser = $database->getUserByUsername($username);
    $existingEmail = $database->getUserByEmail($email);

    if ($existingUser) {
        echo "Username already exists!";
        exit();
    }
    if ($existingEmail) {
        echo "Email already exists!";
        exit();
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password_hash);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2 class="container__heading">Register</h2>
        <form class="form" method="post" action="register.php" onsubmit="return validateForm()">
            Username: <input class="form__input" type="text" name="username" required><br>
            Email: <input class="form__input" type="text" name="email" required><br>
            Password: <input class="form__input" type="password" name="password" id="password" required><br>
            Confirm Password: <input class="form__input" type="password" name="confirm_password" id="confirm_password" required><br>
            <input class="form__submit" type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
