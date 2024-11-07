<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
        }

        nav a:hover {
            text-decoration: underline;
            color: #ADD8E6;
        }

        /* Page Title */
        h1 {
            padding-top: 50px;
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
        }

        /* Vehicles Grid */
        .vehicles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .vehicle {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 15px;
            text-align: center;
        }

        .vehicle:hover {
            transform: scale(1.05);
        }

        .vehicle img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .vehicle h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 5px;
        }

        .vehicle p {
            font-size: 1rem;
            color: #666;
            margin: 5px 0;
        }

        .book-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .book-button:hover {
            background-color: #4CBB17;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .vehicles {
                grid-template-columns: 1fr;
            }
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

    <h1>Available Vehicles</h1>
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
            <p>Type: <?php echo htmlspecialchars($row['type']); ?></p>
            <a href="booking.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="book-button">Book It</a>
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
    <title>Category</title>
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

    <h1>Available Vehicles</h1>
    <div id="vehicle-list"></div>

    <script>
    fetch('vehicle.php?type=all')
        .then(response => response.json())
        .then(data => {
            const vehicleList = document.getElementById('vehicle-list');
            vehicleList.innerHTML = '';
            data.forEach(vehicle => {
                const vehicleItem = document.createElement('div');
                vehicleItem.className = 'vehicle-item';
                vehicleItem.innerHTML = `
                    <img src="images/${vehicle.image}" alt="${vehicle.make} ${vehicle.model}">
                    <h3>${vehicle.make} ${vehicle.model}</h3>
                    <p>Year: ${vehicle.year}</p>
                    <p>Price: $${vehicle.price}/day</p>
                    <p>Type: ${vehicle.type}</p>
                    <a href="booking.php?id=${vehicle.id}" class="book-button">Book It</a>
                `;
                vehicleList.appendChild(vehicleItem);
            });
        });
    </script>
</body>
</html> -->
