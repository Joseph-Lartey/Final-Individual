<?php
include('../settings/connection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php?msg=" . urlencode("Please log in to access this page."));
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$error_message = '';

$bookings_found = false;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $property_id = $row['property_id'];

        $booking_query = "SELECT CONCAT(users.fname, ' ', users.lname) AS full_name, users.phone_number, properties.title, bookings.booking_date, bookings.booking_time
                          FROM bookings
                          INNER JOIN users ON bookings.user_id = users.user_id
                          INNER JOIN properties ON bookings.property_id = properties.property_id
                          WHERE bookings.property_id = ?";
        $booking_stmt = $conn->prepare($booking_query);
        $booking_stmt->bind_param("i", $property_id);
        $booking_stmt->execute();
        $booking_result = $booking_stmt->get_result();

        if ($booking_result->num_rows > 0) {
            while ($booking_row = $booking_result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $booking_row['full_name'] . '</td>
                        <td>' . $booking_row['phone_number'] . '</td>
                        <td>' . $booking_row['title'] . '</td>
                        <td>' . $booking_row['booking_date'] . '</td>
                        <td>' . $booking_row['booking_time'] . '</td>
                      </tr>';
            }
            $bookings_found = true;
        }
    }
}

if (!$bookings_found) {
    $error_message = 'No bookings found for any property.';
}

$stmt->close();
$conn->close();

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
