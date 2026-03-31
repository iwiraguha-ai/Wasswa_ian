<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
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
<title>Ian Industries & Repairs</title>

<style>

body{
font-family: Arial, sans-serif;
margin:0;
background:#f4f4f4;
}

/* Header */

.main-header {
    position: absolute;
    top: 20px;
    font-family: 'Courier New', Courier, monospace;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.5);
    padding: 10px 20px;
    border-radius: 5px;
}
.main-header h1 {
    color: white;
    font-size: 32px;
    margin: 0;
}

.navbar 
{
display:flex;
justify-content:center;
gap: 20px;
align-items:center;
position:relative;
z-index: 1000;
}

nav ul{
list-style:none;
display:flex;
gap:20px;
}

.h1
{
    color: "purple"
}

nav ul li a{
color:white;
text-decoration:none;
font-weight:bold;
}

/* Hero Section */

.hero{
background:url('https://images.unsplash.com/photo-1511919884226-fd3cad34687c') center/cover no-repeat;
height:400px;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
color:white;
text-shadow:2px 2px 5px blueviolet;
}

.hero h2{
font-size:60px;
}

.hero p{
font-size:30px;
}

/* Services */

.services{
padding:40px;
text-align:center;
}

.service-box{
display:inline-block;
width:260px;
background:white;
margin:15px;
padding:20px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

.service-box h3{
color:#1f3c88;
}

.navbar
{

color:white;
text-align:center;
padding:40px;
}

/* Contact */

.contact{
background:#1f3c88;
color:white;
text-align:center;
padding:40px;
}

/* Footer */

footer{
background:#111;
color:white;
text-align:center;
padding:15px;
}

</style>
</head>

<body>

<header>
    <section class="main-header">
        <h1>IAN INDUSTRIES & REPAIRS</h1>
    </section>
</header>


<section class="hero">
<div class="slider">
<img id="slide" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70" width="100%">
</div>
</section>

<section>
<h2>Professional Car & Motorcycle Repairs</h2>
<p>Reliable mechanical services you can trust</p>

</section>

<section class= "navbar">
<nav>
    <h1>
<ul>
<li><a href="home.php">Home</a></li>
<li><a href="services.php">Services</a></li>
<li><a href="products.php">Products</a></li>
<li><a href="contacts.php">Contacts</a></li>
<li><a href="logout.php" style="color:red;">Logout</a></li>
</ul>
    </h1>
</nav>
</section>

<section class="contact">

<h2>Contact Ian Industries & Repairs</h2>

<p>Phone: +256 0771422965</p>
<p>Email: info@ianrepairs.com</p>
<p>Location: Kampala, Uganda</p>

</section>

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
let images = [
"https://images.unsplash.com/photo-1503376780353-7e6692767b70",
"https://images.unsplash.com/photo-1511919884226-fd3cad34687c",
"https://images.unsplash.com/photo-1558981806-ec527fa84c39"
];

let i = 0;

function slideShow(){
    document.getElementById("slide").src = images[i];
    i = (i + 1) % images.length;
}

setInterval(slideShow, 3000);
</script>
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