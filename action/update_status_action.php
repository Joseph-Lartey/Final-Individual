<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the property ID and status are set
    if (isset($_POST['propertyId']) && isset($_POST['status'])) {
        // Sanitize input
        $propertyId = htmlspecialchars($_POST['propertyId']);
        $status = htmlspecialchars($_POST['status']);
        header("Location: ../view/Properties.php?msg=" . $status);

        
        // Here you can perform your database update operation
        // For example, using PDO:
        include('../settings/connection.php');

        // Prepare and execute the update query
        $query = "UPDATE properties SET status = ? WHERE property_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $propertyId);
        if ($stmt->execute()) {
            $msg = "Status updated successfully.";
        } else {
            $msg = "Failed to update status.";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();

        // Redirect back to the Properties page with a message
        header("Location: ../view/Properties.php?msg=" . urlencode($msg));
        exit();
    } else {
        $msg = "Property ID and status are required.";
    }
} else {
    $msg = "Invalid request.";
}

// Redirect back to the Properties page with an error message
header("Location: ../view/Properties.php?msg=" . urlencode($msg));
exit();
?>
