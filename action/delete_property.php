<?php
include('../settings/connection.php');

// Check if property_id is provided in the URL
if(isset($_GET['property_id'])) {
    // Sanitize the property ID
    $property_id = mysqli_real_escape_string($conn, $_GET['property_id']);

    // Delete associated images from property_images table
    $delete_images_query = "DELETE FROM property_images WHERE property_id = '$property_id'";
    if(mysqli_query($conn, $delete_images_query)) {
        // Images deleted successfully, now delete the property record
        $delete_property_query = "DELETE FROM properties WHERE property_id = '$property_id'";
        if(mysqli_query($conn, $delete_property_query)) {
            // Property record deleted successfully
            header("Location: ../view/Properties.php?msg=Property deleted successfully");
            exit();
        } else {
            // Error deleting property record
            header("Location: ../view/Properties.php?msg=Error deleting property record");
            exit();
        }
    } else {
        // Error deleting associated images
        header("Location: ../view/Properties.php?msg=Error deleting associated images");
        exit();
    }
} else {
    // Property ID not provided in URL
    header("Location: ../view/Properties.php?msg=Property ID not provided");
    exit();
}

// Close database connection
$conn->close();
?>
