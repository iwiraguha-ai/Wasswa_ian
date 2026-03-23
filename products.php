<?php
session_start();

// Protect page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

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


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products - Ian Industries & Repairs</title>
   
   <style>
/* Footer */

footer{
background:#111;
color:white;
text-align:center;
padding:15px;
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

            .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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

<h1>Our Products</h1>

<div class="container">

<?php
$result = $conn->query("SELECT * FROM products");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='product'>
            <img src='{$row['image']}' alt='{$row['name']}'>
            <h3>{$row['name']}</h3>
            <p class='price'>{$row['price']}</p>
            <button>Buy Now</button>
        </div>
        ";
    }
} else {
    echo "<p>No products found</p>";
}
?>

</div>


<footer>
<p>© 2026 Ian Industries & Repairs</p>
</footer>

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