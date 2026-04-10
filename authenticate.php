<?php
// authenticate.php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Fetch user by username ONLY
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 2. Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // --- NECESSARY UPDATES ---
            // Changed 'user' to 'username' to match your other pages
            $_SESSION['username'] = $row['username']; 
            $_SESSION['role'] = $row['role']; 
            // Added last_activity to fix the timeout redirect loop
            $_SESSION['last_activity'] = time(); 

            // 3. Redirect based on role
            if ($row['role'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            // Wrong password
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=1");
        exit();
    }
}
?>