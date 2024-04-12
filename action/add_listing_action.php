<?php
include('../settings/connection.php');
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $propertyType = mysqli_real_escape_string($conn, $_POST['propertyType']);
    $bedrooms = mysqli_real_escape_string($conn, $_POST['bedrooms']);
    $sizeSqft = mysqli_real_escape_string($conn, $_POST['sizeSqft']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $user_id = $_SESSION['user_id']; 

    
    $property_query = "INSERT INTO properties (title, description, price, property_type, bedrooms, size_sqft, address, city, state, user_id) 
                    VALUES ('$title', '$description', '$price', '$propertyType', '$bedrooms', '$sizeSqft', '$address', '$city', '$state', '$user_id')";

   
    if (mysqli_query($conn, $property_query)) {
        $property_id = mysqli_insert_id($conn); 
        

        if (isset($_FILES["propertyImage"]) && $_FILES["propertyImage"]["error"] == 0) {
            
            $file_name = $_FILES["propertyImage"]["name"];
            $file_tmp = $_FILES["propertyImage"]["tmp_name"];
            $file_size = $_FILES["propertyImage"]["size"];
            $file_type = $_FILES["propertyImage"]["type"];
            
            $max_file_size = 5 * 1024 * 1024; 
            if ($file_size > $max_file_size) {
                header("Location: ../view/listing.php?msg=File size exceeds the maximum limit (5MB).");
                exit();
            }
            
            $allowed_types = array("image/jpeg", "image/png", "image/gif");
            if (!in_array($file_type, $allowed_types)) {
                header("Location: ../view/listing.php?msg=Only JPEG, PNG, and GIF files are allowed.");
                exit();
            }
            
            $file_name = uniqid() . "_" . $file_name;
            
            $upload_path = "../property/";
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                $image_url = $upload_path . $file_name;
                $insert_image_query = "INSERT INTO property_images (property_id, image_url) VALUES ('$property_id', '$image_url')";
                if (mysqli_query($conn, $insert_image_query)) {
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
