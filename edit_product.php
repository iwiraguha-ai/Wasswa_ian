<?php
session_start();
require 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// 1. Get current product details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

// 2. Handle the update when you click "Save Changes"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    $update = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, category=? WHERE id=?");
    $update->bind_param("sdisi", $name, $price, $stock, $category, $id);

    if ($update->execute()) {
        echo "<script>alert('Product updated successfully!'); window.location='admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Edit Product - Ian Industries</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: Arial; padding: 40px; background: #f4f4f4;">

    <div style="max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h2>Update Product Details</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label>Product Name:</label><br>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" style="width: 100%; padding: 10px; margin: 10px 0;"><br>

            <label>Category (Change to your wish):</label><br>
            <input type="text" name="category" value="<?php echo $product['category']; ?>" placeholder="e.g., Engine, Tires" style="width: 100%; padding: 10px; margin: 10px 0;"><br>

            <label>Price (UGX):</label><br>
            <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" style="width: 100%; padding: 10px; margin: 10px 0;"><br>

            <label>Stock Level:</label><br>
            <input type="number" name="stock" value="<?php echo $product['stock']; ?>" style="width: 100%; padding: 10px; margin: 10px 0;"><br>

            <button type="submit" name="update_product" style="background: #2c3e50; color: white; border: none; padding: 12px 20px; cursor: pointer; width: 100%; border-radius: 5px;">Save Changes</button>
            <br><br>
            <a href="admin.php" style="display: block; text-align: center; color: #666;">Cancel and Go Back</a>
        </form>
    </div>

</body>
</html>