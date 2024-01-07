<?php
include('includes/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve scanned content from the AJAX call
    $content = $_POST['name']; // You might need to sanitize or validate this data

    // Update the entry time in the database
    $query = "UPDATE vehicle_info SET InTime = NOW() WHERE OwnerName = '$content'";

    if (mysqli_query($con, $query)) {
        echo 'alert(Entry time updated successfully!)';
    } else {
        echo 'alert(Error updating entry time: ' . mysqli_error($con).')';
    }
} else {
    echo 'Invalid request method';
}
?>
