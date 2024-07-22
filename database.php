<?php
class Database 
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'mydatabase';
    private static $instance = null;
    private $conn;

    private function __construct() 
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) 
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() 
    {
        if (self::$instance === null) 
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() 
    {
        return $this->conn;
    }


// Method to get a user by username
    public function getUserByUsername($username) 
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }


// Method to get a user by email
    public function getUserByEmail($email) 
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
}
?>
