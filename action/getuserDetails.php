<?php
include "../settings/connection.php";

function getUserProfileDetails() {
    global $conn;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        die();
    }

    $userID = $_SESSION['user_id'];

    $profile_data_query = "SELECT fname, lname, email, phone_number, gender, DOB FROM `users` WHERE user_id = '$userID'";

    $profile_data_result = mysqli_query($conn, $profile_data_query);

    $result = mysqli_fetch_assoc($profile_data_result);

    $profileDetails = "<p><strong>Name:</strong> " . $result['fname'] . ' ' . $result['lname'] . "</p>";
    $profileDetails .= "<p><strong>Email:</strong> " . $result['email'] . "</p>";
    $profileDetails .= "<p><strong>Phone Number:</strong> " . $result['phone_number'] . "</p>";
    $profileDetails .= "<p><strong>Date of Birth:</strong> " . $result['DOB'] . "</p>";

    return $profileDetails;
}

function getUserProfileImage() {
    global $conn;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT profile_image_url FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($profile_image_url);
        $stmt->fetch();

        if ($profile_image_url) {
            return '<img src="../uploads/' . $profile_image_url . '" alt="Profile Picture">';
        } else {

            return '<img src="../images/default-profile-image.png" alt="Profile Picture">';
        }
    } else {
        return '<img src="../images/default-profile-image.png" alt="Profile Picture">';
    }

    $stmt->close();
}
?>
