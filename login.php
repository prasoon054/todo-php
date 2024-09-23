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
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0){
        $stmt->bind_result($user_id, $username);
        $stmt->fetch();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }
    else{
        echo "Invalid username or password!";
    }
}
$stmt->close();
$conn->close();
?>
