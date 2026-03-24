<!DOCTYPE html>
<html>
<head>
    <title>Ian Industries & Repairs</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        nav {
            background: #1f3c88;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        /* HERO */
        .hero {
            height: 100vh;
            background: url('images/logo.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            object-fit: cover;        
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero h1 {
            color: white;
            background: rgba(0,0,0,0.6);
            padding: 20px;
            border-radius: 10px;
        }

        /* ABOUT */
        .about {
            padding: 40px;
            text-align: center;
        }

        /* SERVICES */
        .services {
            display: flex;
            justify-content: space-around;
            padding: 30px;
        }

        .card {
            width: 30%;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #1f3c88;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        /* FOOTER */
        footer {
            background: #1f3c88;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav>
    <h2>Ian Industries</h2>
    <div>
        <a href="login.php">Login</a>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <h1>IAN INDUSTRIES & REPAIRS</h1>
</div>

<!-- ABOUT -->
<div class="about">
    <h2>About Us</h2>
    <p>
        We provide professional industrial repair services, machinery maintenance,
        and supply of quality spare parts.
    </p>

    <a href="login.php" class="btn">Login to Access Services</a>
</div>

<!-- SERVICES -->
<div class="services">
    <div class="card">
        <h3>Repairs</h3>
        <p>We fix industrial machines and equipment.</p>
    </div>

    <div class="card">
        <h3>Maintenance</h3>
        <p>Regular servicing to keep machines running.</p>
    </div>

    <div class="card">
        <h3>Spare Parts</h3>
        <p>We supply high-quality spare parts.</p>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 Ian Industries & Repairs</p>
</footer>

</body>
</html>