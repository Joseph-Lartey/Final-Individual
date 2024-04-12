<?php
// Include the connection script
include "../settings/connection.php";

// Check if the connection is successful
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query to fetch properties along with their images
$query = "SELECT p.*, pi.image_url 
          FROM properties p 
          LEFT JOIN property_images pi 
          ON p.property_id = pi.property_id 
          ORDER BY p.created_at DESC 
          LIMIT 8";

$result = mysqli_query($conn, $query);

// Check if the query was successful
if($result === false) {
    die("ERROR: Query failed. " . mysqli_error($conn));
}

// Check if any properties were found
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Generate HTML for each property card
        echo '<div class="property-card">';
        if(!empty($row['image_url'])) {
            echo '<img src="../images/' . $row['image_url'] . '" alt="Property">';
        } else {
            // Provide a default image if no image is available
            echo '<img src="../images/default.jpg" alt="Property">';
        }
        echo '<div class="property-details">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>Price: $' . $row['price'] . '</p>';
        echo '<p>Bedrooms: ' . $row['bedrooms'] . '</p>';
        echo '<p>Location: ' . $row['city'] . ', ' . $row['state'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No properties found.';
}

// Close the database connection
mysqli_close($conn);
?>
