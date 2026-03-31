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

<title>Services | Ian Industries & Repairs</title>

<style>

body{
font-family: Arial, sans-serif;
margin:0;
background:#f4f4f4;
}

/* Navigation */
header{
background:#111;
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

/* Title */
.title{
background:#1f3c88;
color:white;
text-align:center;
padding:40px;
}

/* Services */
.services{
display:flex;
flex-wrap:wrap;
justify-content:center;
padding:40px;
gap:20px;
}

.service-box{
width:260px;
background:white;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
overflow:hidden;
text-align:center;
}

.service-box img{
width:100%;
height:180px;
object-fit:cover;
}

.service-box:hover{
transform: scale(1.05);
transition: 0.3s;
cursor:pointer;
}

.service-box h3{
color:#1f3c88;
margin:10px 0;
}

.service-box p{
padding:0 10px 20px;
}

/* Footer */
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
<li><a href="contacts.php">Contacts</a></li>
<li><a href="logout.php" style="color:red;">Logout</a></li>
</ul>

</nav>

</header>

<section class="title">

<h2>Our Car & Motorcycle Services</h2>
<p>Professional repair and maintenance services</p>

</section>

<section class="services">

<div class="service-box" onclick="bookService('Car Engine Repair')">

<img src="https://images.unsplash.com/photo-1625047509168-a7026f36de04">

<h3>Car Engine Repair</h3>

<p>Full engine diagnostics and repair for all car models.</p>

</div>

<div class="service-box" onclick="bookService('Motorcycle Repair')">

<img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39">

<h3>Motorcycle Repair</h3>

<p>Professional motorcycle servicing and maintenance.</p>

</div>

<div class="service-box" onclick="bookService('Brake Repair')">

<img src="images/brake repair.jfif">

<h3>Brake Repair</h3>

<p>Brake pad replacement and braking system repair.</p>

</div>

<div class="service-box" onclick="bookService('Oil Change')">

<img src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc">

<h3>Oil Change</h3>

<p>Engine oil replacement to improve vehicle performance.</p>

</div>

<div class="service-box" onclick="bookService('Battery Replacement')">

<img src="images/battery recplacement.jfif">

<h3>Battery Replacement</h3>

<p>Battery testing and installation of new batteries.</p>

</div>

<div class="service-box" onclick="bookService('Electrical Repairs')">

<img src="images/electrical repairs.jfif">

<h3>Electrical Repairs</h3>

<p>Repair of vehicle wiring and electrical systems.</p>

</div>

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
function bookService(service){
    alert("You selected: " + service + ". Please contact us to book.");
}
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