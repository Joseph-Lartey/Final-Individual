<?php
include('../settings/connection.php');
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page
    header("Location: ../login/login.php");
    exit();
}

// Retrieve the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve properties listed by the current user
$query = "SELECT p.*, pi.image_url
          FROM properties p
          LEFT JOIN property_images pi ON p.property_id = pi.property_id
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if properties are listed by the current user
if ($result->num_rows > 0) {
    // Display each property in the specified format
    while ($row = $result->fetch_assoc()) {
        echo '<div class="house-card">';
        echo '<div class="house-image">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
        echo '</div>'; // Close house-image div
        echo '<div class="house-details">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<ul>';
        echo '<li><strong>Property Type:</strong> ' . $row['property_type'] . '</li>';
        echo '<li><strong>Bedrooms:</strong> ' . $row['bedrooms'] . '</li>';
        echo '<li><strong>Size:</strong> ' . $row['size_sqft'] . ' sqft</li>';
        echo '<li><strong>Location:</strong> ' . $row['city'] . ', ' . $row['state'] . '</li>';
        echo '<li><strong>Price:</strong> $' . $row['price'] . '</li>';
        echo '<li><strong>Status:</strong> ' . $row['status'] . '</li>'; // Display property status
        echo '</ul>';
        // Add the property ID as a data attribute to the "Status" button
        echo '<button onclick="openStatusModal(' . $row['property_id'] . ')" class="book-btn" data-property-id="' . $row['property_id'] . '">Status</button>';
        // Add the "Delete" button with a link to delete_property.php
       
        echo '<a href="../action/delete_property.php?property_id=' . $row['property_id'] . '" class="delete-btn">Delete</a>';
        echo '</div>'; // Close house-details div
        echo '</div>'; // Close house-card div
    }
} else {
    // No properties listed, show SweetAlert
    echo "No properties Listed by current user ";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
