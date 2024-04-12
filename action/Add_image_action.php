<?php
include('../settings/connection.php');
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];
        $file_type = $_FILES["image"]["type"];
        
        $max_file_size = 5 * 1024 * 1024; 
        if ($file_size > $max_file_size) {
            header("Location: ../view/Profile.php?msg=" . urlencode("File size exceeds the maximum limit (5MB)."));
            exit();
        } elseif (!in_array($file_type, array("image/jpeg", "image/png", "image/gif"))) {
            header("Location: ../view/Profile.php?msg=" . urlencode("Only JPEG, PNG, and GIF files are allowed."));
            exit();
        } else {
            $file_name = uniqid() . "_" . $file_name;
            
            $upload_path = "../uploads/";
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                $stmt = $conn->prepare("UPDATE users SET profile_image_url = ? WHERE user_id = ?");
                $stmt->bind_param("si", $file_name, $user_id); 
                $user_id = $_SESSION['user_id']; 
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: ../view/Profile.php?msg=" . urlencode("Image uploaded successfully."));
                    exit();
                } else {
                    header("Location: ../view/Profile.php?msg=" . urlencode("Failed to upload image."));
                    exit();
                }

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
