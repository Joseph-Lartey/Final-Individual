<?php
include('../settings/connection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php?msg=" . urlencode("Please log in to access this page."));
    exit();
}

// Retrieve the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Check if the current user has any properties listed
$query = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize a variable to hold error message
$error_message = '';

// Check if properties are listed by the current user
if ($result->num_rows > 0) {
    // Display the booking details for each property
    while ($row = $result->fetch_assoc()) {
        $property_id = $row['property_id'];

        // Retrieve bookings for the current property
        $booking_query = "SELECT CONCAT(users.fname, ' ', users.lname) AS full_name, users.phone_number, properties.title, bookings.booking_date, bookings.booking_time
                          FROM bookings
                          INNER JOIN users ON bookings.user_id = users.user_id
                          INNER JOIN properties ON bookings.property_id = properties.property_id
                          WHERE bookings.property_id = ?";
        $booking_stmt = $conn->prepare($booking_query);
        $booking_stmt->bind_param("i", $property_id);
        $booking_stmt->execute();
        $booking_result = $booking_stmt->get_result();

        // Check if there are bookings for the property
        if ($booking_result->num_rows > 0) {
            // Display the booking details
            while ($booking_row = $booking_result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $booking_row['full_name'] . '</td>
                        <td>' . $booking_row['phone_number'] . '</td>
                        <td>' . $booking_row['title'] . '</td>
                        <td>' . $booking_row['booking_date'] . '</td>
                        <td>' . $booking_row['booking_time'] . '</td>
                      </tr>';
            }
        } else {
            $error_message .= 'No bookings found for property';
        }
    }
} else {
    $error_message = 'No properties listed by the current user.';
}

// Close statements and database connection
$stmt->close();
$conn->close();

// Display error message using SweetAlert
if (!empty($error_message)) {
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "' . $error_message . '"
            });
          </script>';
}
?>
