<?php
include('../settings/connection.php');

$query = "SELECT p.*, pi.image_url FROM properties p
          LEFT JOIN property_images pi ON p.property_id = pi.property_id";

$result = mysqli_query($conn, $query);

if ($result) {
    // Check if there are properties in the database
    if (mysqli_num_rows($result) > 0) {
        // Loop through each property
        while ($row = mysqli_fetch_assoc($result)) {
            // Output property details in the desired format
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
            // Add the property ID as a data attribute to the "Book" button
            echo '<button class="book-btn" data-property-id="' . $row['property_id'] . '">Book</button>';
            echo '</div>'; // Close house-details div
            echo '</div>'; // Close house-card div
        }
    } else {
        // If no properties found in the database
        echo '<p>No properties found.</p>';
    }
} else {
    // If query execution fails
    echo '<p>Error retrieving properties: ' . mysqli_error($conn) . '</p>';
}

// Close database connection
mysqli_close($conn);
?>
