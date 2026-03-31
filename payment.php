<?php
include("db.php");

// Initialize variables so the page doesn't crash if someone loads it directly
$name = "Customer";
$phone = "N/A";
$method = "N/A";

if (isset($_POST['place_order'])) {
    // Capture the data from the checkout form
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // CRITICAL: Clear the cart database now that the order is placed
    mysqli_query($conn, "DELETE FROM cart");
} else {
    // If someone tries to go to payment.php without clicking "Place Order"
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success - Ian Industries</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #eef2f3; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .receipt { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); text-align: center; max-width: 450px; width: 90%; position: relative; overflow: hidden; }
        .receipt::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: #27ae60; }
        .icon { font-size: 60px; color: #27ae60; margin-bottom: 10px; }
        h1 { color: #2c3e50; margin: 0; }
        .status { color: #27ae60; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: block; }
        .details-box { background: #f8f9fa; padding: 20px; border-radius: 10px; text-align: left; margin: 20px 0; border: 1px dashed #ccc; }
        .details-box div { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95em; }
        .details-box strong { color: #333; }
        .btn { display: block; background: #2c3e50; color: white; padding: 15px; text-decoration: none; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .btn:hover { background: #1a252f; }
    </style>
</head>
<body>

<div class="receipt">
    <div class="icon">check_circle</div>
    <h1>Thank You!</h1>
    <span class="status">Order Successfully Placed</span>
    
    <p>Hi <strong><?php echo htmlspecialchars($name); ?></strong>, we've received your order and are currently processing it for delivery.</p>

    <div class="details-box">
        <div><span>Phone Number:</span> <strong><?php echo htmlspecialchars($phone); ?></strong></div>
        <div><span>Payment Mode:</span> <strong><?php echo htmlspecialchars($method); ?></strong></div>
        <div><span>Order Status:</span> <strong>Pending Dispatch</strong></div>
    </div>

    <p style="font-size: 0.85em; color: #7f8c8d; margin-bottom: 25px;">You will receive a call from our delivery agent shortly to confirm your location.</p>
    
    <a href="products.php" class="btn">Return to Shop</a>
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

</body>
</html>