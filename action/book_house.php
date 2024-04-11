<?php
include('../settings/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the property_id and user_id from the form data
    $property_id = $_POST['property_id'];

    // Assuming the property_id is sent via POST
    // You need to retrieve the user_id from the session or wherever it's stored
    session_start();
    $user_id = $_SESSION['user_id'];

    // Assuming the user_id is stored in the session
    // Get the booking_date and booking_time from the form data
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    // Validate booking date
    $current_date = date('Y-m-d');
    if ($booking_date < $current_date) {
        // Past date, redirect with error message
        header("Location: ../view/listing.php?msg=Booking date must be today or in the future.");
        exit();
    }

    // Validate booking time
    if (strtotime($booking_time) < strtotime('09:00:00') || strtotime($booking_time) > strtotime('17:00:00')) {
        // Booking time is before 9:00 AM or after 5:00 PM, redirect with error message
        header("Location: ../view/listing.php?msg=Booking time must be between 9:00 AM and 5:00 PM.");
        exit();
    }

    // Check if the property is available
    $check_status_query = "SELECT status FROM properties WHERE property_id = ?";
    $stmt = $conn->prepare($check_status_query);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        if ($status != 'available') {
            // Property is not available for booking
            header("Location: ../view/listing.php?msg=This property is not available for booking.");
            exit();
        }
    } else {
        // Property not found
        header("Location: ../view/listing.php?msg=Property not found.");
        exit();
    }

    // Insert the booking details into the bookings table
    $query = "INSERT INTO bookings (property_id, user_id, booking_date, booking_time, status, created_at) VALUES (?, ?, ?, ?, 'pending', NOW())";

    // Prepare the SQL statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("iiss", $property_id, $user_id, $booking_date, $booking_time);

    // Execute the statement
    if ($stmt->execute()) {
        // Booking successful
        header("Location: ../view/listing.php?msg=Booking successful!");
        exit();
    } else {
        // Booking failed
        header("Location: ../view/listing.php?msg=Error: " . $conn->error);
        exit();
    }

    // Close statement
    $stmt->close();
} else {
    // If the form is not submitted via POST method
    header("Location: ../view/listing.php?msg=Invalid request method.");
    exit();
}

// Close database connection
$conn->close();
?>
