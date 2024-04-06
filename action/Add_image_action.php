<?php
include('../settings/connection.php');
session_start(); // Starting the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file field is set and not empty
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // File details
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];
        $file_type = $_FILES["image"]["type"];
        
        // Check file size (assuming maximum size is 5MB)
        $max_file_size = 5 * 1024 * 1024; // 5MB in bytes
        if ($file_size > $max_file_size) {
            header("Location: ../view/Profile.php?msg=" . urlencode("File size exceeds the maximum limit (5MB)."));
            exit();
        } elseif (!in_array($file_type, array("image/jpeg", "image/png", "image/gif"))) {
            header("Location: ../view/Profile.php?msg=" . urlencode("Only JPEG, PNG, and GIF files are allowed."));
            exit();
        } else {
            // Generate a unique file name
            $file_name = uniqid() . "_" . $file_name;
            
            // Move the uploaded file to the desired location
            $upload_path = "../uploads/";
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                // Update the user's profile image URL in the database
                $stmt = $conn->prepare("UPDATE users SET profile_image_url = ? WHERE user_id = ?");
                $stmt->bind_param("si", $file_name, $user_id); // Assuming $user_id is the user's ID
                $user_id = $_SESSION['user_id']; // Retrieve user ID from session
                $stmt->execute();

                // Check if the query was successful
                if ($stmt->affected_rows > 0) {
                    header("Location: ../view/Profile.php?msg=" . urlencode("Image uploaded successfully."));
                    exit();
                } else {
                    header("Location: ../view/Profile.php?msg=" . urlencode("Failed to upload image."));
                    exit();
                }

                // Close statement
                $stmt->close();
            } else {
                header("Location: ../view/Profile.php?msg=" . urlencode("Failed to move the uploaded file."));
                exit();
            }
        }
    } else {
        header("Location: ../view/Profile.php?msg=" . urlencode("No file uploaded or an error occurred during file upload."));
        exit();
    }
} else {
    header("Location: ../view/Profile.php?msg=" . urlencode("Invalid request method."));
    exit();
}
?>
