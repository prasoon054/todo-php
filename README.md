# To-Do List Application with User Authentication

This is a simple To-Do list web application built with PHP and MySQL. It allows users to sign up, log in, and manage their personal to-do lists. Users can create, read, update, and delete (CRUD) tasks after authenticating. 

---

## Features

- **User Authentication**: Users can sign up and log in securely.
- **To-Do List Management**: Users can add, update, delete, and view their to-do items.
- **Session Management**: Each user has a separate to-do list managed using sessions.
- **MySQL Database**: The application uses MySQL for storing user information and to-do tasks.

---

## Prerequisites

- PHP 7.0 or higher
- MySQL 5.7 or higher
- Browser with JavaScript enabled

---

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/prasoon054/todo-app.git
```
### 2. Navigate to the Project Directory
```bash
cd todo-app
```
### 3. Set up the Database
- Open your MySQL client
- Create a new database by executing the SQL commands in tododb.sql
### 4. Configure the Database in the Project
- Open the project files (login.php, signup.php, and todo.php) and ensure the database credentials are correct:
```php
$servername = "localhost"; // Update if necessary
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "todo_app"; // The database name created earlier
```
### 5. Start the PHP Server
You can start a local PHP development server by running this command:
php -S localhost:8080
Then, visit http://localhost:8080 in your browser
