<?php
include('../settings/connection.php');
session_start(); // Starting the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $propertyType = mysqli_real_escape_string($conn, $_POST['propertyType']);
    $bedrooms = mysqli_real_escape_string($conn, $_POST['bedrooms']);
    $sizeSqft = mysqli_real_escape_string($conn, $_POST['sizeSqft']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $user_id = $_SESSION['user_id']; // Get user_id from session

    // Query to insert into properties table
    $property_query = "INSERT INTO properties (title, description, price, property_type, bedrooms, size_sqft, address, city, state, status, user_id) 
                    VALUES ('$title', '$description', '$price', '$propertyType', '$bedrooms', '$sizeSqft', '$address', '$city', '$state', '$status', '$user_id')";

    // Check if property insertion is successful
    if (mysqli_query($conn, $property_query)) {
        $property_id = mysqli_insert_id($conn); // Get the last inserted property ID
        
        // Check if the file field is set and not empty
        if (isset($_FILES["propertyImage"]) && $_FILES["propertyImage"]["error"] == 0) {
            // File details
            $file_name = $_FILES["propertyImage"]["name"];
            $file_tmp = $_FILES["propertyImage"]["tmp_name"];
            $file_size = $_FILES["propertyImage"]["size"];
            $file_type = $_FILES["propertyImage"]["type"];
            
            // Check file size (assuming maximum size is 5MB)
            $max_file_size = 5 * 1024 * 1024; // 5MB in bytes
            if ($file_size > $max_file_size) {
                header("Location: ../view/listing.php?msg=File size exceeds the maximum limit (5MB).");
                exit();
            }
            
            // Check file type (assuming only image files are allowed)
            $allowed_types = array("image/jpeg", "image/png", "image/gif");
            if (!in_array($file_type, $allowed_types)) {
                header("Location: ../view/listing.php?msg=Only JPEG, PNG, and GIF files are allowed.");
                exit();
            }
            
            // Generate a unique file name
            $file_name = uniqid() . "_" . $file_name;
            
            // Move the uploaded file to the desired location
            $upload_path = "../property/";
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                // Insert image URL into the database
                $image_url = $upload_path . $file_name;
                $insert_image_query = "INSERT INTO property_images (property_id, image_url) VALUES ('$property_id', '$image_url')";
                if (mysqli_query($conn, $insert_image_query)) {
                    // Redirect to success page
                    header("Location: ../view/listing.php");
                    exit();
                } else {
                    header("Location: ../view/listing.php?msg=Error inserting image URL into database.");
                    exit();
                }
            } else {
                header("Location: ../view/listing.php?msg=Failed to move the uploaded file.");
                exit();
            }
        } else {
            header("Location: ../view/listing.php?msg=No file uploaded or an error occurred during file upload.");
            exit();
        }
    } else {
        header("Location: ../view/listing.php?msg=Error inserting property details into database.");
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
