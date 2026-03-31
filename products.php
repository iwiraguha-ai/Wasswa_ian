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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;

        }
        .product{
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .product :hover{
            transform: translateY(-5px);
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .price{
            color: #27ae60;
            font-weight: bold;
            font-size: 1.2rem;
        }
        button[name="cart"]{
            background: #2980b9;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
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
<li><a href="contacts.php">Contacts</a></li>
<li><a href="cart.php">Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
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
        // We close the PHP tag so we can write clean HTML
        ?>
        <div class="product">
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:200px; height:auto;">
            <h3><?php echo $row['name']; ?></h3>
            
            <p class="price">UGX <?php echo number_format((float)$row['price']); ?></p>
            
            <form action="cart.php" method="POST">
                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
        <?php 
    } // This bracket closes the while loop
} else {
    echo "<p>No products found.</p>";
}
?>

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