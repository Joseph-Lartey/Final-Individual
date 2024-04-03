-- Create database if not exists
CREATE DATABASE IF NOT EXISTS house_rental;
USE house_rental;

-- Create users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    profile_image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create properties table
CREATE TABLE properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    property_type VARCHAR(50),
    bedrooms INT,
    size_sqft INT,
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(100),
    status ENUM('available', 'pending', 'sold') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create property_images table
CREATE TABLE property_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    image_url VARCHAR(255),
    FOREIGN KEY (property_id) REFERENCES properties(property_id)
);

-- Create bookings table
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    user_id INT,
    booking_date DATE,
    booking_time TIME,
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(property_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert sample data into users table
INSERT INTO users (fname, lname, email, password_hash, phone_number) 
VALUES 
('John', 'Doe', 'user1@example.com', 'hashed_password1', '123-456-7890'),
('Jane', 'Smith', 'user2@example.com', 'hashed_password2', '987-654-3210');

-- Insert sample data into properties table
INSERT INTO properties (title, description, price, property_type, bedrooms, size_sqft, address, city, state, status, user_id) 
VALUES 
('Cozy Apartment', 'A cozy apartment in the heart of the city.', 1500.00, 'Apartment', 1, 800, '123 Main St', 'Cityville', 'StateA', 'available', 1),
('Spacious House', 'A spacious house with a beautiful backyard.', 2500.00, 'House', 3, 2000, '456 Elm St', 'Townsville', 'StateB', 'available', 2);

-- Insert sample data into property_images table
INSERT INTO property_images (property_id, image_url) 
VALUES 
(1, 'https://example.com/apartment1.jpg'),
(1, 'https://example.com/apartment2.jpg'),
(2, 'https://example.com/house1.jpg'),
(2, 'https://example.com/house2.jpg');

-- Insert sample data into bookings table
INSERT INTO bookings (property_id, user_id, booking_date, booking_time, status) 
VALUES 
(1, 2, '2024-04-10', '14:00:00', 'confirmed'),
(2, 1, '2024-04-15', '11:00:00', 'pending');
