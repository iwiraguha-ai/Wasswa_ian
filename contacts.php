<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// 20 minutes
$timeout = 1200;

if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > $timeout) {
        session_unset();
        session_destroy();
        header("Location: login.php?timeout=1");
        exit();
    }
}

$_SESSION['last_activity'] = time();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact | Ian Industries & Repairs</title>

<style>
body{
    font-family: Arial, sans-serif;
    margin:0;
    background:#f4f4f4;
}

header{
    background:#111111;
    color:white;
    padding:15px;
}

nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

nav ul{
    list-style:none;
    display:flex;
    gap:20px;
}

nav ul li a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.title{
    text-align:center;
    padding:40px;
    background:#1f3c88;
    color:white;
}

.contact-form{
    max-width:500px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

.contact-form h2{
    text-align:center;
    color:#1f3c88;
}

.contact-form input, 
.contact-form textarea{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

.contact-form button{
    width:100%;
    padding:12px;
    background:#1f3c88;
    color:white;
    border:none;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}

.contact-form button:hover{
    background:#16306b;
}

footer{
    background:#111;
    color:white;
    text-align:center;
    padding:15px;
    margin-top:40px;
}

</style>
</head>
<body>

<header>
<nav>
<h1>Ian Industries & Repairs</h1>
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="services.php">Services</a></li>
<li><a href="products.php">Products</a></li>
<li><a href="contacts.php">Contact</a></li>
<li><a href="logout.php" style="color:red;">Logout</a></li>
</ul>
</nav>
</header>

<section class="title">
<h2>Contact Ian Industries & Repairs</h2>
<p>Send us a message or request service</p>
</section>

<div class="contact-form">
<h2>Contact Form</h2>
<form action="contact.php" method="POST" onsubmit="return validateForm()">
<input type="text" name="name" placeholder="Your Name" required>
<input type="email" name="email" placeholder="Your Email" required>
<input type="text" name="subject" placeholder="Subject" required>
<textarea name="message" rows="5" placeholder="Your Message" required></textarea>
<button type="submit">Send Message</button>
</form>
</div>

<footer style="
    text-align: center; 
    padding: 30px; 
    background: #2c3e50; 
    color: white; 
    margin-top: 50px; 
    border-top: 4px solid #27ae60;
    font-family: 'Segoe UI', Tahoma, sans-serif;
">
    <p style="margin: 0; font-weight: bold; letter-spacing: 1px;">
        &copy; <?php echo date("Y"); ?> IAN INDUSTRIES & REPAIRS 
        | Car & Motorcycle Specialists
    </p>
    <p style="margin-top: 10px; font-size: 0.85em; color: #bdc3c7;">
        Kampala, Uganda | Quality Service Guaranteed
    </p>
</footer>

<script>
let timeout = 1200000; // 20 minutes

let timer;

function resetTimer() {
    clearTimeout(timer);
    timer = setTimeout(() => {
        window.location.href = "logout.php";
    }, timeout);
}

document.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
</script>

</body>
</html>