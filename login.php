<?php session_start(); 
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}
if (isset($_GET['timeout'])) {
    echo "<p style='color:red;'>You were logged out due to inactivity</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ian Industries & Repairs</title>
    
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('images/logo.png') no-repeat center center;
    background-size: cover;
    object-fit: cover;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box
{
    width: 300px;
    height: 200px;
    margin: 100px auto;
    padding: 20px;
    background: rgba(0, 0, 0, 0.7); /* dark transparent */
    color: white;
    border-radius: 10px;
}

.login-box {
    background: white;
    padding: 30px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
}

.company-name{
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
    color:#1f3c88;
}

.login-box h2 {
    margin-bottom: 20px;
}

input {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #1f3c88;
    color: white;
    border: none;
    border-radius:5px;
    font-size:16px;
    cursor: pointer;
}

button:hover {
    background: #16306b;
}

.footer{
    margin-top:15px;
    font-size:12px;
    color:gray;
}
</style>

</head>
<body>

<div class="login-box">

<div class="company-name">
<h1>IAN INDUSTRIES $ REPAIRS</h1>
</div>

    <h2>Login</h2>

    <form action="authenticate.php" method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <label>
<input type="checkbox" onclick="togglePassword()"> Show Password
</label>
        <button type="submit">Login</button>
    </form>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>Invalid Login Details</p>";
    }
    ?>
    <div class="footer">
© 2026 Ian Industries & Repairs
</div>
</div>

<script>
function togglePassword(){
    var pass = document.querySelector('input[name="password"]');
    pass.type = (pass.type === "password") ? "text" : "password";
}

function validateLogin(){
    let user = document.querySelector('input[name="username"]').value;
    let pass = document.querySelector('input[name="password"]').value;

    if(user === "" || pass === ""){
        alert("Please fill all fields");
        return false;
    }

    return true; // VERY IMPORTANT
}

</script>

</body>
</html>