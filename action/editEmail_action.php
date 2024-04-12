<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['old_email']) && !empty($_POST['new_email'])) {

        $oldEmail = $_POST['old_email'];

        $newEmail = $_POST['new_email'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $oldEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE users SET email = ? WHERE email = ?");
            $stmt->bind_param("ss", $newEmail, $oldEmail);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: ../view/Profile.php?msg=Email updated successfully.");
                exit();
            } else {
                header("Location: ../view/Profile.php?msg=Failed to update email.");
                exit();
            }
        } else {
            header("Location: ../view/Profile.php?msg=Old email does not exist.");
            exit();
        }
    } else {
        header("Location: ../view/Profile.php?msg=Old and new email must not be empty.");
        exit();
    }
} else {
    header("Location: ../view/Profile.php?msg=Invalid request method.");
    exit();
}
?>
