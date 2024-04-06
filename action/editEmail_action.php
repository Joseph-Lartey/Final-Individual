<?php
// Include the file containing database connection
include('../settings/connection.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both old and new email are provided
    if (!empty($_POST['old_email']) && !empty($_POST['new_email'])) {
        // Database connection assumed to be established previously and stored in $conn variable

        // Retrieving old email from the form
        $oldEmail = $_POST['old_email'];

        // Retrieving new email from the form
        $newEmail = $_POST['new_email'];

        // Prepare and execute SELECT query to check if old email exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $oldEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        // If old email exists, proceed to update
        if ($result->num_rows > 0) {
            // Prepare and execute UPDATE query to update user's email
            $stmt = $conn->prepare("UPDATE users SET email = ? WHERE email = ?");
            $stmt->bind_param("ss", $newEmail, $oldEmail);
            $stmt->execute();

            // Check if the query was successful
            if ($stmt->affected_rows > 0) {
                // Success message
                header("Location: ../view/Profile.php?msg=Email updated successfully.");
                exit();
            } else {
                // Error message if the update fails
                header("Location: ../view/Profile.php?msg=Failed to update email.");
                exit();
            }
        } else {
            // Error message if old email does not exist
            header("Location: ../view/Profile.php?msg=Old email does not exist.");
            exit();
        }
    } else {
        // If old or new email is empty, redirect with an error message
        header("Location: ../view/Profile.php?msg=Old and new email must not be empty.");
        exit();
    }
} else {
    // If the request method is not POST, redirect with an error message
    header("Location: ../view/Profile.php?msg=Invalid request method.");
    exit();
}
?>
