<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "todo_app";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0){
        echo "Username already exists!";
    }
    else{
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()){
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }
        else{
            echo "Error: Could not sign up.";
        }
    }
    $stmt->close();
}
$conn->close();
?>
