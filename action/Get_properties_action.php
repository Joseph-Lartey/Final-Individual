<?php
include('../settings/connection.php');

$query = "SELECT p.*, pi.image_url FROM properties p
          LEFT JOIN property_images pi ON p.property_id = pi.property_id";

$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
            echo '<button class="book-btn" data-property-id="' . $row['property_id'] . '">Book</button>';
            echo '</div>'; 
            echo '</div>'; 
        }
    } else {
        echo '<p>No properties found.</p>';
    }
} else {
    echo '<p>Error retrieving properties: ' . mysqli_error($conn) . '</p>';
}

mysqli_close($conn);
?>
