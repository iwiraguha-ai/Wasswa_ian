<?php
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

    if($stmt->execute()){
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