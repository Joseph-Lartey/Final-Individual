<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_id = $_POST['property_id'];

    session_start();
    $user_id = $_SESSION['user_id'];

    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    $current_date = date('Y-m-d');
    if ($booking_date < $current_date) {
        header("Location: ../view/listing.php?msg=Booking date must be today or in the future.");
        exit();
    }

    if (strtotime($booking_time) < strtotime('09:00:00') || strtotime($booking_time) > strtotime('17:00:00')) {
        header("Location: ../view/listing.php?msg=Booking time must be between 9:00 AM and 5:00 PM.");
        exit();
    }

    $check_status_query = "SELECT status FROM properties WHERE property_id = ?";
    $stmt = $conn->prepare($check_status_query);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        if ($status != 'available') {
            header("Location: ../view/listing.php?msg=This property is not available for booking.");
            exit();
        }
    } else {
        header("Location: ../view/listing.php?msg=Property not found.");
        exit();
    }

    $query = "INSERT INTO bookings (property_id, user_id, booking_date, booking_time, status, created_at) VALUES (?, ?, ?, ?, 'pending', NOW())";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("iiss", $property_id, $user_id, $booking_date, $booking_time);

    if ($stmt->execute()) {
        header("Location: ../view/listing.php?msg=Booking successful!");
        exit();
    } else {
        header("Location: ../view/listing.php?msg=Error: " . $conn->error);
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../view/listing.php?msg=Invalid request method.");
    exit();
}

$conn->close();
?>
