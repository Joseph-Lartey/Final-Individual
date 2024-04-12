<?php
session_start();

include '../settings/connection.php';


function validatePassword($password) {
    $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";
    return preg_match($regex, $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        header("Location: ../view/Profile.php?msg=New password and confirm password do not match.");
        exit();
    } elseif (!validatePassword($newPassword)) {
        header("Location: ../view/Profile.php?msg=Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
        exit();
    } else {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $query = "SELECT password_hash FROM users WHERE user_id = ?";
            $statement = $conn->prepare($query);
            $statement->bind_param("i", $userId);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $currentHashedPassword = $row['password_hash'];

            if (password_verify($currentPassword, $currentHashedPassword)) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

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
            header("Location: ../login/login.php?msg=Session data not found. Please log in again.");
            exit();
        }
    }
}
?>