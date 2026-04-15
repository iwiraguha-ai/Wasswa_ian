<?php
session_start();

// 1. Session & Security Check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wasswa_ian";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message_sent = false;
$ai_reply = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $user_msg = $conn->real_escape_string($_POST['message']);
    
    // ... your AI logic here ...

  $country = $conn->real_escape_string($_POST['country']);

$sql = "INSERT INTO contacts (name, email, country, message, bot_response) 
        VALUES ('$name', '$email', '$country', '$user_msg', '$ai_reply')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        // THIS LINE WILL TELL YOU WHY IT IS FAILNG
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Ian Industries & Repairs</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #111; color: white; padding: 1rem; text-align: center; }
        nav ul { display: flex; justify-content: center; list-style: none; gap: 20px; padding: 0; }
        nav a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #1f3c88; text-align: center; }
        
        input, textarea { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #1f3c88; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #16306b; }

        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .ai-box { background: #eef2ff; border-left: 5px solid #1f3c88; padding: 15px; margin-top: 20px; font-style: italic; }
        
        footer { background: #2c3e50; color: white; text-align: center; padding: 20px; margin-top: 50px; border-top: 4px solid #27ae60; }
    </style>
</head>
<body>

<header>
    <h1>Ian Industries & Repairs</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contacts.php">Contact</a></li>
            <li><a href="logout.php" style="color: #ff4d4d;">Logout</a></li>
        </ul><?php
// admin.php - Management Dashboard
session_start();
require 'db.php';

// --- 1. SECURITY CHECK ---
// Ensures only logged-in users with the 'admin' role can see this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle adding a "Category Only" entry
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category_only'])) {
    $new_cat = $_POST['new_category_name'];
    
    // We insert a "dummy" product with 0 price and stock just to register the category
    // This allows the category to appear in your sidebar automatically
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image, category) VALUES ('Category Init', 0, 0, 'images/placeholder.png', ?)");
    $stmt->bind_param("s", $new_cat);

    if($stmt->execute()){
        echo "<script>alert('New Category Created!'); window.location='admin.php';</script>";
    }
    $stmt->close();
}

// --- 2. HANDLE PRODUCT ADDITION ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['image']; 
    
    // Logic to use custom category if text box is filled, otherwise use dropdown
    $category = !empty($_POST['custom_category']) ? $_POST['custom_category'] : $_POST['category'];

    // Updated SQL to include 'category'
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $stock, $image, $category);

    if($stmt->execute())<?php
session_start();

if (!isset($_SESSION['username'])) {
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

if (!isset($_SESSION['username'])) {
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
<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li><a href="admin.php" style="color:red;">Admin Panel</a></li>
<?php endif; ?>
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
</html>{
        echo "<script>alert('Product Added Successfully!'); window.location='admin.php';</script>";
    }
    $stmt->close();
}

// --- 3. HANDLE PRODUCT DELETION ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Fetch all products for the management table
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ian Industries</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header style="background: #2c3e50; padding: 15px; color: white; display: flex; justify-content: space-between; align-items: center;">
    <h1>Admin Panel</h1>
    <nav>
        <a href="home.php" style="color: white; margin-right: 15px; text-decoration: none;">User View</a>
        <a href="logout.php" style="color: #ff4d4d; text-decoration: none; font-weight: bold;">Logout</a>
    </nav>
</header>

<main class="container" style="padding: 20px;">
    <h2>Inventory Management</h2>

    <!-- Section 1: Low Stock Alerts -->
    <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeeba;">
        <h3>⚠️ Low Stock Alerts</h3>
        <ul>
            <?php
            $alert_res = $conn->query("SELECT name, stock FROM products WHERE stock < 5");
            if ($alert_res->num_rows > 0) {
                while($item = $alert_res->fetch_assoc()) {
                    echo "<li><strong>" . htmlspecialchars($item['name']) . "</strong> is low on stock (" . $item['stock'] . " left)</li>";
                }
            } else {
                echo "<li>All stock levels are healthy.</li>";
            }
            ?>
        </ul>
    </div>
    
<!-- New Section: Create Category Only -->
<div class="card" style="margin-bottom: 20px; padding: 20px; background: #ebedef; border: 1px dashed #2c3e50;">
    <h3>Create New Category Only</h3>
    <p style="font-size: 0.85em; color: #555;">This will add the category to your sidebar immediately.</p>
    <form action="admin.php" method="POST" style="display: flex; gap: 10px; margin-top: 10px;">
        <input type="text" name="new_category_name" placeholder="Enter Category Name (e.g. Interior Parts)" required style="flex: 1; padding: 10px;">
        <button type="submit" name="add_category_only" class="btn" style="background: #2c3e50; color: white; padding: 10px 20px; border: none; cursor: pointer;">Create Category</button>
    </form>
</div>

    <!-- Section 2: Add New Product Form -->
    <div class="card" style="text-align: left; margin-bottom: 40px; padding: 20px; background: #f9f9f9; border: 1px solid #ddd;">
        <h3>Add New Product</h3>
        <form action="admin.php" method="POST" style="display: grid; gap: 10px; margin-top: 15px;">
            <input type="text" name="name" placeholder="Product Name" required style="padding: 10px;">
            <input type="number" step="0.01" name="price" placeholder="Price (UGX)" required style="padding: 10px;">
            <input type="number" name="stock" placeholder="Initial Stock Quantity" required style="padding: 10px;">
            <input type="text" name="image" placeholder="Image Path (e.g., images/engine.jpg)" required style="padding: 10px;">
            
            <label>Category Selection:</label>
            <select name="category" style="padding: 10px;">
                <option value="General">General</option>
                <option value="Phones">Phones & Tablets</option>
                <option value="Electronics">Electronics</option>
                <option value="Computing">Computing</option>
                <option value="Parts">Spare Parts</option>
            </select>

            <label>OR Create New Category:</label>
            <input type="text" name="custom_category" placeholder="e.g., Engine Parts, Accessories" style="padding: 10px;">
            
            <button type="submit" name="add_product" class="btn" style="background: #27ae60; color: white; padding: 10px; border: none; cursor: pointer;">Add Product</button>
        </form>
    </div>

    <!-- Section 3: Inventory Table -->
    <h3>Current Inventory</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff;">
        <thead>
            <tr style="background: #2c3e50; color: #fff; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Name</th>
                <th style="padding: 12px;">Category</th>
                <th style="padding: 12px;">Price</th>
                <th style="padding: 12px;">Stock</th>
                <th style="padding: 12px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px;"><?php echo $row['id']; ?></td>
                <td style="padding: 12px;"><?php echo htmlspecialchars($row['name']); ?></td>
                <td style="padding: 12px;"><?php echo htmlspecialchars($row['category']); ?></td>
                <td style="padding: 12px;">UGX <?php echo number_format($row['price']); ?></td>
                <td style="padding: 12px;"><?php echo $row['stock']; ?></td>
<td style="padding: 12px;">
    <!-- 1. The Edit Link -->
    <a href="edit_product.php?id=<?php echo $row['id']; ?>" 
       style="color: #2c3e50; margin-right: 10px; text-decoration: none; font-weight: bold;">
       Edit
    </a> | 

    <!-- 2. The Delete Link -->
    <a href="admin.php?delete=<?php echo $row['id']; ?>" 
       style="color: #e74c3c; text-decoration: none; font-weight: bold;" 
       onclick="return confirm('Are you sure you want to delete this item?')">
       Delete
    </a>
</td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php $conn->close(); ?>
</body>
</html>
    </nav>
</header>

<div class="container">
    <h2>Contact Us</h2>
    
    <?php if ($message_sent): ?>
        <div class="alert success">Message saved successfully!</div>
        <div class="ai-box">
            <strong>Instant Response:</strong><br>
            <?php echo $ai_reply; ?>
        </div>
    <?php endif; ?>

    <form action="contacts.php" method="POST">
       <label for="country-choice">Country:</label>
<input list="countries" name="country" id="country-choice" placeholder="Type or select a country" required>

<datalist id="countries">
    <option value="Uganda">
    <option value="Kenya">
    <option value="Tanzania">
    <option value="Rwanda">
    <option value="United States">
    <option value="United Kingdom">
    <option value="United Arab Emirates">
    <option value="India">
    <option value="China">
    <option value="Japan">
    </datalist>

<script>
// Optional: Auto-detect country based on IP
fetch('https://ipapi.co/json/')
  .then(response => response.json())
  .then(data => {
    const countrySelect = document.getElementById('country');
    // This looks for the country name in your dropdown list
    for (let i = 0; i < countrySelect.options.length; i++) {
        if (countrySelect.options[i].value === data.country_name) {
            countrySelect.selectedIndex = i;
            break;
        }
    }
  });
</script>
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="subject" placeholder="Subject (e.g. Spare Parts)" required>
        <textarea name="message" rows="5" placeholder="How can we help you?" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> IAN INDUSTRIES & REPAIRS | Car & Motorcycle Specialists</p>
    <p style="font-size: 0.8em; color: #bdc3c7;">Kampala, Uganda | Quality Service Guaranteed</p>
</footer>

</body>
</html>