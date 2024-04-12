<?php
include('../settings/connection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT p.*, pi.image_url
          FROM properties p
          LEFT JOIN property_images pi ON p.property_id = pi.property_id
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="house-card">';
        echo '<div class="house-image">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
        echo '</div>'; 
        echo '<div class="house-details">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<ul>';
        echo '<li><strong>Property Type:</strong> ' . $row['property_type'] . '</li>';
        echo '<li><strong>Bedrooms:</strong> ' . $row['bedrooms'] . '</li>';
        echo '<li><strong>Size:</strong> ' . $row['size_sqft'] . ' sqft</li>';
        echo '<li><strong>Location:</strong> ' . $row['city'] . ', ' . $row['state'] . '</li>';
        echo '<li><strong>Price:</strong> $' . $row['price'] . '</li>';
        echo '<li><strong>Status:</strong> ' . $row['status'] . '</li>'; 
        echo '</ul>';
        echo '<button onclick="openStatusModal(' . $row['property_id'] . ')" class="book-btn" data-property-id="' . $row['property_id'] . '">Status</button>';
       
        echo '<a href="../action/delete_property.php?property_id=' . $row['property_id'] . '" class="delete-btn">Delete</a>';
        echo '</div>'; 
        echo '</div>'; 
    }
} else {
    echo "No properties Listed by current user ";
}

$stmt->close();
$conn->close();
?>
