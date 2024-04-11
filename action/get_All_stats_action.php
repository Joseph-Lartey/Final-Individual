<?php
include('../settings/connection.php');


// Function to get the total number of listings
function getTotalListings() {
    global $conn;
    $query = "SELECT COUNT(*) AS total_listings FROM properties";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total_listings'];
}



// Function to get the total number of bookings for a property
function getTotalBookings($user_id) {
    global $conn;

    // First, retrieve all properties posted by the user
    $query = "SELECT property_id FROM properties WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $total_bookings = 0;

    // Loop through each property and sum up the bookings
    while ($row = $result->fetch_assoc()) {
        $property_id = $row['property_id'];
        $total_bookings += getBookingsForProperty($property_id);
    }

    return $total_bookings;
}

function getBookingsForProperty($property_id) {
    global $conn;
    $query = "SELECT COUNT(*) AS total_bookings FROM bookings WHERE property_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_bookings'];
}
// Function to count the number of available properties
function getAvailablePropertiesCount() {
    global $conn;
    $query = "SELECT COUNT(*) AS available_properties FROM properties WHERE status = 'available'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['available_properties'];
}



// // Close database connection
// $conn->close();
?>
