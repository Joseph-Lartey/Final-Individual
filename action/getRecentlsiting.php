<?php
include "../settings/connection.php";

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "SELECT p.*, pi.image_url 
          FROM properties p 
          LEFT JOIN property_images pi 
          ON p.property_id = pi.property_id 
          ORDER BY p.created_at DESC 
          LIMIT 8";

$result = mysqli_query($conn, $query);

if($result === false) {
    die("ERROR: Query failed. " . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="property-card">';
        if(!empty($row['image_url'])) {
            echo '<img src="../images/' . $row['image_url'] . '" alt="Property">';
        } else {
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

mysqli_close($conn);
?>
