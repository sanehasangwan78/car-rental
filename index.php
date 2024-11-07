<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car and Bike Rental</title>
    <style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #D3D3D3;
    color: #333;
    padding-top: 70px; /* Offset for fixed navbar */
}

/* Navigation Styles */
nav {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #333;
    padding: 15px 0;
    display: flex;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

nav a {
    color: #fff;
    margin: 0 15px;
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s ease;
}

nav a:hover {
    text-decoration: underline;
    color: #ADD8E6;
}

/* Page Title */
h1 {
    text-align: center;
    margin: 20px 0;
    font-size: 2rem;
    color: #333;
}

/* Subtitle and Intro Text */
p {
    text-align: center;
    font-size: 1.1rem;
    color: #666;
    margin: 10px 20px;
}

/* Vehicle Container */
.vehicles {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Individual Vehicle Card */
.vehicle {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease;
}

.vehicle:hover {
    transform: scale(1.05);
}

.vehicle img {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #f4f4f4;
}

.vehicle h3 {
    font-size: 1.25rem;
    color: #333;
    margin: 15px 0;
}

.vehicle p {
    font-size: 1rem;
    color: #666;
}

.book-button {
    display: inline-block;
    margin: 10px 0 20px 0;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.book-button:hover {
    background-color:#4CBB17;
}
</style>
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="category.php">Book Now</a>
        <?php session_start(); if (isset($_SESSION['user_id'])): ?>
            <a href="orders.php">Bookings</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>

    <h1>Welcome to Car and Bike Rental!</h1>
    <p>Your adventure starts here. Rent a vehicle today!</p>

    <div class="vehicles">
        <?php
        include 'database.php'; 
        $sql = "SELECT * FROM vehicles"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <div class="vehicle">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['make'] . ' ' . $row['model']); ?>">
            <h3><?php echo htmlspecialchars($row['make'] . ' ' . $row['model']); ?> (<?php echo htmlspecialchars($row['year']); ?>)</h3>
            <p>Price: $<?php echo htmlspecialchars($row['price']); ?>/day</p>
            <a href="category.php" class="book-button">Book Now</a>
        </div>
        <?php
            }
        } else {
            echo "<p>No vehicles available.</p>";
        }
        $conn->close(); 
        ?>
    </div>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car and Bike Rental</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="category.php">Book Now</a>
        <?php session_start(); if (isset($_SESSION['user_id'])): ?>
            <a href="orders.php">Bookings</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>

    <h1>Welcome to Car and Bike Rental!</h1>
    <p>Your adventure starts here. Rent a vehicle today!</p>

    <div class="vehicles">
        <div class="vehicle">
            <img src="images/toyota_camry.jpg" alt="Car 1">
            <h3>Toyota Camry</h3>
            <p>Price: $50/day</p>
            <a href="category.php" class="book-button">Book Now</a>
        </div>
        <div class="vehicle">
            <img src="images/yamaha_mt09.jpg" alt="Bike 1">
            <h3>Yamaha MT-09</h3>
            <p>Price: $30/day</p>
            <a href="category.php" class="book-button">Book Now</a>
        </div>
    </div>
</body>
</html> -->

