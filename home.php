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

header{
background:rgb(22, 2, 109);
color:rgb(0, 0, 0);
padding:10px;
}

nav{
display:flex;
justify-content:space-between;
align-items:center;
position:relative;
z-index: 1000;
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

<nav>

<h1>Ian Industries & Repairs</h1>

<ul>
<li><a href="home.php">Home</a></li>
<li><a href="services.php">Services</a></li>
<li><a href="products.php">Products</a></li>
<li><a href="contacts.php">Contacts</a></li>
<li><a href="logout.php" style="color:red;">Logout</a></li>
</ul>

</nav>

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


<section class="services">

<h2>Our Services</h2>

<div class="service-box">
<h3>Car Engine Repair</h3>
<p>Complete engine diagnostics and repair for all car models.</p>
</div>

<div class="service-box">
<h3>Motorcycle Service</h3>
<p>Maintenance and repair for motorcycles and scooters.</p>
</div>

<div class="service-box">
<h3>Brake & Oil Service</h3>
<p>Brake repair, oil change and vehicle inspection.</p>
</div>

<div class="service-box">
<h3>Electrical Repairs</h3>
<p>Vehicle wiring, battery and electrical system repair.</p>
</div>

</section>


<section class="contact">

<h2>Contact Ian Industries & Repairs</h2>

<p>Phone: +256 0771422965</p>
<p>Email: info@ianrepairs.com</p>
<p>Location: Kampala, Uganda</p>

</section>

<footer>
<p>© 2026 Ian Industries & Repairs | Car & Motorcycle Specialists</p>
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