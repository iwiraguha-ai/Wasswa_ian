<?php
include("db.php");

// Fetch cart items to show the summary
$cart_query = mysqli_query($conn, "SELECT * FROM cart");
$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Checkout - Ian Industries</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px; }
        
        .checkout-container { 
            max-width: 1000px; 
            margin: 20px auto; 
            display: grid; 
            grid-template-columns: 1.5fr 1fr; /* Two column layout */
            gap: 30px; 
        }

        .section-box { 
            background: white; 
            padding: 25px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
        }

        h2 { border-bottom: 2px solid #eee; padding-bottom: 10px; color: #333; }

        /* Form Styling */
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input, select { 
            width: 100%; padding: 12px; border: 1px solid #ddd; 
            border-radius: 5px; box-sizing: border-box; font-size: 14px;
        }

        /* Order Summary Styling */
        .summary-item { 
            display: flex; justify-content: space-between; 
            padding: 10px 0; border-bottom: 1px solid #f1f1f1; 
        }
        .summary-total { 
            font-size: 1.4em; font-weight: bold; color: #2c3e50; 
            margin-top: 20px; display: flex; justify-content: space-between;
        }

        .place-order-btn { 
            background: #27ae60; color: white; border: none; 
            width: 100%; padding: 15px; font-size: 1.1em; 
            font-weight: bold; border-radius: 5px; cursor: pointer; 
            margin-top: 20px; transition: 0.3s;
        }
        .place-order-btn:hover { background: #219150; }

        /* Responsive - stack on mobile */
        @media (max-width: 768px) {
            .checkout-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="checkout-container">
    
    <div class="section-box">
        <h2>Shipping Details</h2>
        <form action="process_payment.php" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="customer_name" placeholder="Ian Wasswa" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="07XXXXXXXX" required>
            </div>
            <div class="form-group">
                <label>Delivery Address</label>
                <input type="text" name="address" placeholder="Street name, Kampala" required>
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <select name="payment_method">
                    <option value="Mobile Money">MTN/Airtel Mobile Money</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" name="place_order" class="place-order-btn">Confirm & Place Order</button>
        </form>
    </div>

    <div class="section-box">
        <h2>Order Summary</h2>
        <?php 
        if(mysqli_num_rows($cart_query) > 0) {
            while($row = mysqli_fetch_assoc($cart_query)) {
                $grand_total += (float)$row['price'];
                echo "<div class='summary-item'>
                        <span>{$row['product_name']}</span>
                        <strong>UGX ".number_format($row['price'])."</strong>
                      </div>";
            }
        }
        ?>
        <div class="summary-total">
            <span>Total to Pay:</span>
            <span>UGX <?php echo number_format($grand_total); ?></span>
        </div>
        <p style="font-size: 0.8em; color: #888; margin-top: 15px;">
            * Delivery fees are calculated based on your location.
        </p>
    </div>

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