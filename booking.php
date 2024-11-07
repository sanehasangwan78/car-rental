<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';

$vehicle_id = $_GET['id'];

// Fetch vehicle details from the database
$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vehicle_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Vehicle not found.</p>";
    exit();
}

$vehicle = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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

/* Vehicle Details Section */
.vehicle-details {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.vehicle-details img {
    width: 100%;
    max-width: 400px;
    height: auto;
    border-radius: 8px;
    margin-bottom: 20px;
}

.vehicle-details h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #333;
}

.vehicle-details p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 5px;
}

/* Booking Form */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form label {
    font-size: 1rem;
    color: #333;
    margin-top: 10px;
    margin-bottom: 5px;
}

form input[type="date"],
form input[type="text"] {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
}

form button {
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    background-color: #333;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #555;
}

/* Responsive Design */
@media (max-width: 600px) {
    nav a {
        margin: 0 10px;
        font-size: 0.9rem;
    }

    h1 {
        font-size: 1.5rem;
    }

    .vehicle-details, form {
        width: 90%;
    }

    .vehicle-details img {
        max-width: 100%;
    }
}
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="category.php">Book Now</a>
        <a href="orders.php">Bookings</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h1>Booking Details</h1>
    <div class="vehicle-details">
        <!-- Display the vehicle image and details -->
        <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" alt="<?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?>">
        <h3><?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?> (<?php echo htmlspecialchars($vehicle['year']); ?>)</h3>
        <p>Price: $<?php echo htmlspecialchars($vehicle['price']); ?>/day</p>
        <p>Type: <?php echo htmlspecialchars($vehicle['type']); ?></p>
    </div>

    <form action="confirmation.php" method="POST">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required>
        <label for="location">Location:</label>
        <input type="text" name="location" placeholder="Location" required>
        <button type="submit">Complete Your Booking</button>
    </form>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>








<!-- <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$vehicle_id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="category.php">Book Now</a>
        <a href="orders.php">Bookings</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h1>Booking Details</h1>
    <form action="confirmation.php" method="POST">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <input type="text" name="location" placeholder="Location" required>
        <button type="submit">Complete Your Booking</button>
    </form>
</body>
</html> -->
