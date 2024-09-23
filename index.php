<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])){
    ?>
    <h2 id="form-title">Login</h2>
    <form action="login.php" method="POST" id="login-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <form action="signup.php" method="POST" id="signup-form" style="display: none;">
        <label for="new_username">Username:</label>
        <input type="text" id="new_username" name="username" required><br><br>
        <label for="new_password">Password:</label>
        <input type="password" id="new_password" name="password" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>
        <a href="#" id="toggle-link">Signup instead</a>
    </p>
    <script>
        const toggleLink = document.getElementById('toggle-link');
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        const formTitle = document.getElementById('form-title');
        toggleLink.addEventListener('click', function (event) {
            event.preventDefault();
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
                formTitle.textContent = 'Login';
                toggleLink.textContent = 'Signup instead';
            }
            else{
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
                formTitle.textContent = 'Sign Up';
                toggleLink.textContent = 'Login instead';
            }
        });
    </script>
    <?php
}
else{
    ?>
    <h2>Welcome, <?php echo $_SESSION['username']?>!</h2>
    <a href="logout.php">Logout</a><br><br>
    <h2>Your To-Do List</h2>
    <form action="todo.php" method="POST">
        <input type="text" name="task" placeholder="New Task" required>
        <input type="submit" name="action" value="Add">
    </form>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'todo.php';?>
        </tbody>
    </table>
    <?php
}
?>
