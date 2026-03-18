<?php
session_start();

// Protect page
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
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Ian Industries & Repairs</title>
   
   <style>
body{
    font-family: Arial;
    margin:0;
    background:#f4f4f4;
}

nav{
    background:#1f3c88;
    padding:15px;
    text-align:center;
}
nav a{
    color:white;
    margin:15px;
    text-decoration:none;
    font-weight:bold;
}

h1{
    text-align:center;
    margin:20px;
}

/* GRID */
.products{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    padding:20px;
}

/* CARD */
.product-card{
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    text-align:center;
    transition:0.3s;
}
.product-card:hover{
    transform:scale(1.05);
}

.product-card img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:8px;
}

.price{
    color:green;
    font-size:18px;
    margin:10px 0;
}

button{
    padding:10px;
    background:#1f3c88;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
button:hover{
    background:#16306b;
}
</style>
</head>

<body>

<nav>
    <a href="home.php">Home</a>
    <a href="service.php">Services</a>
    <a href="products.php">Products</a>
    <a href="contacts.php">Contact</a>
    <a href="logout.php" style="color:red;">Logout</a>
</nav>

<h1>Vehicles for Sale</h1>

<div class="products">

<!-- 5 VEHICLES -->

<div class="product-card">
<img src="https://images.unsplash.com/photo-1494905998402-395d579af36f">
<h3>Ford Ranger</h3>
<p class="price">UGX 70,000,000</p>
<button onclick="buyProduct('Ford Ranger')">Buy</button>
</div>

<div class="product-card">
<img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c">
<h3>Subaru Forester</h3>
<p class="price">UGX 30,000,000</p>
<button onclick="buyProduct('Subaru Forester')">Buy</button>
</div>

<div class="product-card">
<img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39">
<h3>Sport Motorcycle</h3>
<p class="price">UGX 8,000,000</p>
<button onclick="buyProduct('Sport Motorcycle')">Buy</button>
</div>

<div class="product-card">
<img src="https://images.unsplash.com/photo-1493238792000-8113da705763">
<h3>Toyota Corolla</h3>
<p class="price">UGX 18,000,000</p>
<button onclick="buyProduct('Toyota Corolla')">Buy</button>
</div>

<div class="product-card">
<img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d">
<h3>BMW X5</h3>
<p class="price">UGX 85,000,000</p>
<button onclick="buyProduct('BMW X5')">Buy</button>
</div>

</div>

<h1>Spare Parts Available</h1>

<div class="products">

<!-- 10 SPARE PARTS -->

<div class="product-card">
<img src="images/engine block.jfif">
<h3>Engine Block (Toyota)</h3>
<p class="price">UGX 4,500,000</p>
<button onclick="buyProduct('Engine Block')">Buy</button>
</div>

<div class="product-card">
<img src="images/car battery.jfif">
<h3>Car Battery (12V)</h3>
<p class="price">UGX 350,000</p>
<button onclick="buyProduct('Car Battery')">Buy</button>
</div>

<div class="product-card">
<img src="images/tires.jfif">
<h3>All-Season Tires (Set of 4)</h3>
<p class="price">UGX 900,000</p>
<button onclick="buyProduct('Car Tires')">Buy</button>
</div>

<div class="product-card">
<img src="images/oil filter.jfif">
<h3>Oil Filter</h3>
<p class="price">UGX 50,000</p>
<button onclick="buyProduct('Oil Filter')">Buy</button>
</div>

<div class="product-card">
<img src="images/brake pads.jfif">
<h3>Brake Pads (Front Set)</h3>
<p class="price">UGX 180,000</p>
<button onclick="buyProduct('Brake Pads')">Buy</button>
</div>

<div class="product-card">
<img src="images/spark plugs.jfif">
<h3>Spark Plugs (Set of 4)</h3>
<p class="price">UGX 80,000</p>
<button onclick="buyProduct('Spark Plugs')">Buy</button>
</div>

<div class="product-card">
<img src="images/radiators.jfif">
<h3>Radiator</h3>
<p class="price">UGX 600,000</p>
<button onclick="buyProduct('Radiator')">Buy</button>
</div>

<div class="product-card">
<img src="images/shock absorbers.jfif">
<h3>Shock Absorbers (Pair)</h3>
<p class="price">UGX 450,000</p>
<button onclick="buyProduct('Shock Absorbers')">Buy</button>
</div>

<div class="product-card">
<img src="images/chain kit.jfif">
<h3>Motorcycle Chain Kit</h3>
<p class="price">UGX 150,000</p>
<button onclick="buyProduct('Motorcycle Chain Kit')">Buy</button>
</div>

<div class="product-card">
<img src="images/clutch.jfif">
<h3>Clutch Plate</h3>
<p class="price">UGX 250,000</p>
<button onclick="buyProduct('Clutch Plate')">Buy</button>
</div>

</div>

<script>
function buyProduct(product){
    alert(product + " selected! Contact us to complete purchase.");
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