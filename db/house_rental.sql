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
    gender ENUM('male', 'female'),
    DOB DATE,
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
    status ENUM('available', 'unavailable') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add foreign key constraint to properties table
ALTER TABLE properties
ADD CONSTRAINT fk_user_id
FOREIGN KEY (user_id) REFERENCES users(user_id);

-- Add foreign key constraint to property_images table
ALTER TABLE property_images
ADD CONSTRAINT fk_property_id
FOREIGN KEY (property_id) REFERENCES properties(property_id);

-- Add foreign key constraint to bookings table for property_id
ALTER TABLE bookings
ADD CONSTRAINT fk_property_id
FOREIGN KEY (property_id) REFERENCES properties(property_id);

-- Add foreign key constraint to bookings table for user_id
ALTER TABLE bookings
ADD CONSTRAINT fk_user_id
FOREIGN KEY (user_id) REFERENCES users(user_id);
