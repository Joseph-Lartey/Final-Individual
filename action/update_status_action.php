<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['propertyId']) && isset($_POST['status'])) {
        $propertyId = htmlspecialchars($_POST['propertyId']);
        $status = htmlspecialchars($_POST['status']);
        header("Location: ../view/Properties.php?msg=" . $status);

        

        include('../settings/connection.php');

        $query = "UPDATE properties SET status = ? WHERE property_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $propertyId);
        if ($stmt->execute()) {
            $msg = "Status updated successfully.";
        } else {
            $msg = "Failed to update status.";
        }

        $stmt->close();
        $conn->close();

        header("Location: ../view/Properties.php?msg=" . urlencode($msg));
        exit();
    } else {
        $msg = "Property ID and status are required.";
    }
} else {
    $msg = "Invalid request.";
}

header("Location: ../view/Properties.php?msg=" . urlencode($msg));
exit();
?>
