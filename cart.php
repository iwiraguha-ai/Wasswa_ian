<?php
include("db.php");

// 1. HANDLE ADDING TO CART
if (isset($_POST['add_to_cart'])) {
    $p_name = mysqli_real_escape_string($conn, $_POST['name']);
    $p_price = mysqli_real_escape_string($conn, $_POST['price']);
    $p_image = mysqli_real_escape_string($conn, $_POST['image']);

    // Using column names from your database: product_name, price, image
    $insert = "INSERT INTO cart (product_name, price, image) 
               VALUES ('$p_name', '$p_price', '$p_image')";
    mysqli_query($conn, $insert);
    header("Location: cart.php");
    exit();
}

// 2. HANDLE REMOVING FROM CART
if (isset($_POST['remove_item'])) {
    $id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$id'");
    header("Location: cart.php");
    exit();
}

// 3. FETCH ITEMS
$cart_items = mysqli_query($conn, "SELECT * FROM cart");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Shopping Cart</title>
    <style>
        .cart-container { max-width: 800px; margin: auto; font-family: sans-serif; }
        .cart-item { display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 10px; }
        .cart-item img { width: 100px; margin-right: 20px; }
        .remove-btn { background: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <?php
    $total = 0;
    if (mysqli_num_rows($cart_items) > 0) {
        while ($item = mysqli_fetch_assoc($cart_items)) {
            // MATH: Using 'price' to match your DB screenshot
            $total += (float)$item['price']; 
            ?>
            <div class="cart-item">
                <img src="<?php echo $item['image']; ?>" alt="Product">
                <div style="flex-grow: 1;">
                    <h3><?php echo $item['product_name']; ?></h3>
                    <p>Price: UGX <?php echo number_format((float)$item['price']); ?></p>
                </div>
                <form method="POST">
                    <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                </form>
            </div>
            <?php
        }
        ?>
        <h3>Grand Total: UGX <?php echo number_format($total); ?></h3>
        <a href="checkout.php"><button style="padding:10px 20px; background:green; color:white; border:none;">Proceed to Checkout</button></a>
        <?php
    } else {
        echo "<p>Your cart is empty. <a href= 'products.php'>Go shopping</a></p>";
    }
    ?>
</div>

<script>
    // 5-minute inactivity timer
    let timeout;
    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            alert("Session expired due to inactivity.");
            window.location.href = "products.php";
        }, 300000); 
    }
    document.onmousemove = document.onkeypress = resetTimer;
</script>

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

</body>
</html>