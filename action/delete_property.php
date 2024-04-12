<?php
include('../settings/connection.php');

if(isset($_GET['property_id'])) {
    $property_id = mysqli_real_escape_string($conn, $_GET['property_id']);

    $delete_images_query = "DELETE FROM property_images WHERE property_id = '$property_id'";
    if(mysqli_query($conn, $delete_images_query)) {
        $delete_property_query = "DELETE FROM properties WHERE property_id = '$property_id'";
        if(mysqli_query($conn, $delete_property_query)) {
            header("Location: ../view/Properties.php?msg=Property deleted successfully");
            exit();
        } else {
            header("Location: ../view/Properties.php?msg=Error deleting property record");
            exit();
        }
    } else {
        header("Location: ../view/Properties.php?msg=Error deleting associated images");
        exit();
    }
} else {
    header("Location: ../view/Properties.php?msg=Property ID not provided");
    exit();
}

$conn->close();
?>
