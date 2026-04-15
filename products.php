<?php
// products.php - User Product View
session_start();
require 'db.php';

// --- PAGE PROTECTION & TIMEOUT ---
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 20 minute session timeout logic
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

// --- CATEGORY FILTERING ---
$category = $_GET['cat'] ?? 'All';

if ($category == 'All') {
    // Change Line 29 to:
    $stmt = $conn->prepare("SELECT * FROM products WHERE name != 'Category Init' ORDER BY id DESC");
} else {
    // Change Line 31 to:
   $stmt = $conn->prepare("SELECT * FROM products WHERE category = ? AND name != 'Category Init' ORDER BY id DESC");
    $stmt->bind_param("s", $category);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Ian Industries & Repairs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Sidebar layout styles */
        .main-layout {
            display: flex;
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }
        .products-display { flex: 3; }
        .sidebar {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            height: fit-content;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }
        .sidebar h3 { border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar li { padding: 10px 0; border-bottom: 1px solid #eee; }
        .sidebar a { text-decoration: none; color: #333; font-weight: bold; }
        .sidebar a:hover { color: #27ae60; }
    </style>
</head>
<body>

    <header style="background:#111; color:white; padding:15px;">
        <nav style="display:flex; justify-content:space-between; align-items:center;">
            <h1>Ian Industries & Repairs</h1>
            <ul style="list-style:none; display:flex; gap:20px;">
                <li><a href="home.php" style="color:white; text-decoration:none;">Home</a></li>
                <li><a href="services.php" style="color:white; text-decoration:none;">Services</a></li>
                <li><a href="products.php" style="color:white; text-decoration:none;">Products</a></li>
                <li><a href="cart.php" style="color:white; text-decoration:none;">Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li><a href="admin.php" style="color:red;">Admin Panel</a></li>
<?php endif; ?>
                <li><a href="logout.php" style="color:red; text-decoration:none; font-weight:bold;">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-layout">
        <!-- LEFT SIDE: Products Grid -->
        <div class="products-display">
            <h2>Showing: <?php echo htmlspecialchars($category); ?></h2>
            <div class="grid-container" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:20px;">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="card" style="border:1px solid #ddd; padding:15px; text-align:center; background:#fff; border-radius:8px;">
                            <img src="<?php echo $row['image']; ?>" style="width:100%; height:200px; object-fit:cover;">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="price" style="color:#27ae60; font-weight:bold;">UGX <?php echo number_format($row['price']); ?></p>
                            
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="image" value="<?php echo $row['image']; ?>" >
                                <button type="submit" name="add_to_cart" class="btn" style="background:#2980b9; color:white; border:none; padding:10px 20px; cursor:pointer; border-radius:5px;">Add to Cart</button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products found in this category.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT SIDE: Category Sidebar -->
        <aside class="sidebar">
            <h3>Categories</h3>
                <ul>
    <li><a href="products.php?cat=All">All Products</a></li>
    <?php
    // This fetches every unique category currently in your database
    $cat_query = "SELECT DISTINCT category FROM products WHERE category != ''";
    $cat_result = $conn->query($cat_query);
    while($cat_row = $cat_result->fetch_assoc()):
    ?>
        <li>
            <a href="products.php?cat=<?php echo urlencode($cat_row['category']); ?>">
                <?php echo htmlspecialchars($cat_row['category']); ?>
            </a>
        </li>
    <?php endwhile; ?>
</ul>
            
        </aside>
    </div>

    <footer style="text-align:center; padding:30px; background:#2c3e50; color:white; margin-top:50px; font-family: 'Segoe UI', Tahoma, sans-serif;">
        <p style="font-weight:bold;">&copy; <?php echo date("Y"); ?> IAN INDUSTRIES & REPAIRS | Car & Motorcycle Specialists</p>
        <p style="font-size:0.85em; color:#bdc3c7;">Kampala, Uganda | Quality Service Guaranteed</p>
    </footer>

    <!-- JavaScript for Auto-Logout Timer -->
    <script>
        let timeout = 1200000; // 20 minutes in milliseconds
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