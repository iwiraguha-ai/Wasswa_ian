<?php
// 1. Start session and database at the VERY top
session_start();
require 'db.php';

// 2. Enable error reporting so you don't get a blank screen
ini_set('display_errors', 1);
error_reporting(E_ALL);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user    = $_POST['username'];
    $pass    = $_POST['password'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];
    $role    = 'user';

    // Hash the password for security
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // 3. Prepare the SQL
    $stmt = $conn->prepare("INSERT INTO users (username, password, role, email, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user, $hashed_pass, $role, $email, $contact);

    if ($stmt->execute()) {
        // --- SUCCESSFUL REGISTRATION ---
        
        // 4. Store user data in Session so the website "remembers" them
        $_SESSION['user_id']  = $stmt->insert_id;
        $_SESSION['username'] = $user;
        $_SESSION['role']     = $role;

        // 5. REDIRECT IMMEDIATELY to your home page
        header("Location: home.php"); // Change 'home.php' to your actual home page filename
        exit(); // Always use exit after a header redirect
        
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

 <style>
     /* 1. Background with a subtle gradient */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f47a5a 0%, #d14d33 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* 2. The Card Container */
    .register-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .register-card h2 {
        color: #333;
        margin-bottom: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* 3. Styling Input Fields */
    .register-card input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box; /* Important for width */
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .register-card input:focus {
        border-color: #f47a5a;
        outline: none;
        box-shadow: 0 0 5px rgba(244, 122, 90, 0.3);
    }

    /* 4. The Sign Up Button */
    .register-card button {
        width: 100%;
        padding: 14px;
        margin-top: 20px;
        background-color: #3b71ca;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .register-card button:hover {
        background-color: #2a5298;
        transform: translateY(-2px);
    }

    .register-card button:active {
        transform: translateY(0);
    }

    /* 5. Message and Link styling */
    .error-msg {
        color: #d9534f;
        background: #f9d6d5;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .login-link {
        margin-top: 20px;
        display: block;
        color: #666;
        font-size: 14px;
        text-decoration: none;
    }

    .login-link span {
        color: #3b71ca;
        font-weight: bold;
    }
 </style>

</head>
<body>
    <div class="register-card">
        <h2>Join Industries & Repairs</h2>

        <?php if($message != ""): ?>
            <div class="error-msg"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="contact" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Create Password" required>
            <label>
<input type="checkbox" onclick="togglePassword()"> Show Password
</label>
            
            <button type="submit">Sign Up</button>
        </form>

        <a href="login.php" class="login-link">Already a member? <span>Login here</span></a>
    </div>
</body>
</body>
</html>