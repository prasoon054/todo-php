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
if (!isset($_SESSION['user_id'])){
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ($_POST['action'] === 'Add'){
        $task = $_POST['task'];
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO todos (user_id, task) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $task);
        $stmt->execute();
    }
    if ($_POST['action'] === 'Update'){
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];
        $stmt = $conn->prepare("UPDATE todos SET status=? WHERE id=? AND user_id=?");
        $stmt->bind_param("sii", $status, $task_id, $_SESSION['user_id']);
        $stmt->execute();
    }
    if ($_POST['action'] === 'Delete'){
        $task_id = $_POST['task_id'];
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=? AND user_id=?");
        $stmt->bind_param("ii", $task_id, $_SESSION['user_id']);
        $stmt->execute();
    }
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM todos WHERE user_id=$user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        echo "<tr>
                <td>" . $row['task'] . "</td>
                <td>" . ucfirst($row['status']) . "</td>
                <td>
                    <form style='display:inline' action='todo.php' method='POST'>
                        <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                        <input type='hidden' name='status' value='" . ($row['status'] === 'pending' ? 'completed' : 'pending') . "'>
                        <input type='submit' name='action' value='Update'>
                    </form>
                    <form style='display:inline' action='todo.php' method='POST'>
                        <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                        <input type='submit' name='action' value='Delete'>
                    </form>
                </td>
              </tr>";
    }
}
else{
    echo "<tr><td colspan='3'>No tasks found</td></tr>";
}
$conn->close();
?>