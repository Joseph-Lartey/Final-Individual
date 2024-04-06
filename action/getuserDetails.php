<?php
include "../settings/connection.php";

function getUserProfileDetails() {
    global $conn;

    // Check if a session is active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        die();
    }

    // Get the user ID
    $userID = $_SESSION['user_id'];

    // SQL query to fetch user profile details
    $profile_data_query = "SELECT fname, lname, email, phone_number, gender, DOB FROM `users` WHERE user_id = '$userID'";

    // Execute the query
    $profile_data_result = mysqli_query($conn, $profile_data_query);

    // Fetch the result as an associative array
    $result = mysqli_fetch_assoc($profile_data_result);

    // Format profile details as a string
    $profileDetails = "<p><strong>Name:</strong> " . $result['fname'] . ' ' . $result['lname'] . "</p>";
    $profileDetails .= "<p><strong>Email:</strong> " . $result['email'] . "</p>";
    $profileDetails .= "<p><strong>Phone Number:</strong> " . $result['phone_number'] . "</p>";
    $profileDetails .= "<p><strong>Date of Birth:</strong> " . $result['DOB'] . "</p>";

    // Return profile details string
    return $profileDetails;
}

// Function to get user's profile image HTML
function getUserProfileImage() {
    global $conn;

    // Check if a session is active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or handle unauthorized access
        header("Location: ../login/login.php");
        exit();
    }

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Fetch user's profile image URL from the database
    $stmt = $conn->prepare("SELECT profile_image_url FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        // Bind the result variable
        $stmt->bind_result($profile_image_url);
        $stmt->fetch();

        // Check if the profile image URL exists
        if ($profile_image_url) {
            // Return HTML code for displaying the user's profile image
            return '<img src="../uploads/' . $profile_image_url . '" alt="Profile Picture">';
        } else {
            // No profile image found for the user, you can serve a default image or return an error message
            // For example:
            // return '<img src="../path/to/default/image.png" alt="Profile Picture">';
            return '<img src="../images/default-profile-image.png" alt="Profile Picture">';
        }
    } else {
        // User not found in the database, you can return an error message
        return '<img src="../images/default-profile-image.png" alt="Profile Picture">';
    }

    // Close statement
    $stmt->close();
}
?>
