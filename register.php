<?php
session_start(); // 1. Start the session at the very top
require 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email']; 
    $contact = $_POST['contact'];

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $role = 'user'; 

    $stmt = $conn->prepare("INSERT INTO users (username, password, role, email, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user, $hashed_pass, $role, $email, $contact);

    if ($stmt->execute()) {
        // 2. Create the login session immediately
        $_SESSION['user_id'] = $stmt->insert_id; // Gets the ID of the new user
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $role;

        // 3. Redirect them straight to the main page
        header("Location: home.php"); 
        exit(); // Always use exit after a redirect
    } else {
        $message = "Error: Username might already be taken.";
    }
}
?>