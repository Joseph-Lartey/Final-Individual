<?php
// Start the session
session_start();

// Include your database connection file
include '../settings/connection.php';


// Function to validate password based on conventions
function validatePassword($password) {
    // Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character
    $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";
    return preg_match($regex, $password);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Perform validation
    if ($newPassword !== $confirmPassword) {
        // Passwords do not match, handle error
        header("Location: ../view/Profile.php?msg=New password and confirm password do not match.");
        exit();
    } elseif (!validatePassword($newPassword)) {
        // New password does not meet password conventions, handle error
        header("Location: ../view/Profile.php?msg=Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
        exit();
    } else {
        // Continue with password change process
        // Retrieve user's current password hash from the database
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            // Assuming you have stored user_id in session
            $query = "SELECT password_hash FROM users WHERE user_id = ?";
            $statement = $conn->prepare($query);
            $statement->bind_param("i", $userId);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $currentHashedPassword = $row['password_hash'];

            // Verify if the current password matches the one provided
            if (password_verify($currentPassword, $currentHashedPassword)) {
                // Hash the new password
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateQuery = "UPDATE users SET password_hash = ? WHERE user_id = ?";
                $updateStatement = $conn->prepare($updateQuery);
                $updateStatement->bind_param("si", $newHashedPassword, $userId);
                if ($updateStatement->execute()) {
                    header("Location: ../login/login.php?msg=Password updated successfully.");
                    exit();
                } else {
                    header("Location: ../view/Profile.php?msg=Error updating password: " . $conn->error);
                    exit();
                }
            } else {
                header("Location: ../view/Profile.php?msg=Current password is incorrect.");
                exit();
            }
        } else {
            // Handle the case where user_id is not set in session
            header("Location: ../login/login.php?msg=Session data not found. Please log in again.");
            // Replace with your login page URL
            exit();
        }
    }
}
?>