<?php

include('../settings/connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["Firstname"]) && isset($_POST["username"]) && !empty($_POST["Firstname"]) && !empty($_POST["username"])) {

        $firstname = htmlspecialchars($_POST["Firstname"]);
        $lastname = htmlspecialchars($_POST["username"]);

        $stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $firstname, $lastname, $user_id);

        $user_id = $_SESSION['user_id'];

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../view/Profile.php?msg=Profile updated successfully");
            exit();
        } else {
            header("Location: ../view/Profile.php?msg=Failed to update profile. Please try again.");
            exit();
        }

        $stmt->close();

    } else {
        header("Location: ../view/Profile.php?msg=Please fill in all the required fields.");
        exit();
    }

} else {
    header("Location: ../view/Profile.php?msg=Invalid request method. Please try again.");
    exit();
}

?>