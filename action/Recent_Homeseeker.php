<?php
include('../settings/connection.php');

function getRecentHomeSeekers($user_id) {
    global $conn;

    $image_base_url = '../uploads/'; 

    $query = "SELECT users.fname, users.lname, users.phone_number, users.profile_image_url
              FROM bookings
              INNER JOIN users ON bookings.user_id = users.user_id
              INNER JOIN properties ON bookings.property_id = properties.property_id
              WHERE properties.user_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $profile_image_url = $image_base_url . $row['profile_image_url'];
            
            echo '<tr>';
            echo '<td width="60px"><div class="imgBx"><img src="' . $profile_image_url . '" alt=""></div></td>';
            echo '<td><h4>' . $row['fname'] . ' ' . $row['lname'] . '</h4></td>';
            echo '<td><h4>' . $row['phone_number'] . '</h4></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3">No home seekers found.</td></tr>';
    }
}


?>
