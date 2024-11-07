-- Create database
CREATE DATABASE rental_db1;

USE rental_db1;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Create vehicles table
CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50),
    model VARCHAR(50),
    year INT,
    price DECIMAL(10, 2),
    availability TINYINT,
    type ENUM('car', 'bike'),
    image VARCHAR(255)
);

-- Create bookings table
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle_id INT,
    start_date DATE,
    end_date DATE,
    location VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

-- Sample data for the users table
INSERT INTO users (name, email, password) VALUES
('John Doe', 'john@example.com', 'password123'),
('Jane Smith', 'jane@example.com', 'password456');

-- Sample data for the vehicles table
INSERT INTO vehicles (make, model, year, price, availability, type, image) VALUES
('Toyota', 'Camry', 2020, 50.00, 1, 'car', 'car1.jpg'),
('Honda', 'Civic', 2019, 45.00, 1, 'car', 'car2.jpg'),
('Yamaha', 'MT-09', 2021, 30.00, 1, 'bike', 'bike1.jpg'),
('Kawasaki', 'Ninja 650', 2022, 40.00, 1, 'bike', 'bike2.jpg');

-- Sample data for the bookings table
INSERT INTO bookings (user_id, vehicle_id, start_date, end_date, location) VALUES
(1, 1, '2024-11-01', '2024-11-05', '123 Main St'),
(1, 3, '2024-11-10', '2024-11-12', '456 Elm St');
