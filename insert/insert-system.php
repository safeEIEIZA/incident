<?php
include '../config/db-config.php';
// Check if the request is coming from an AJAX call
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (replace these with your form fields)
    $addsystem_name = $_POST['addsystem_name'];


    // Create an INSERT query
    $sql = "INSERT INTO table_system (system_name) VALUES ('$addsystem_name')";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the insertion was successful
    if ($result === TRUE) {
        echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "../system_manage.php";</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // Close the connection
    mysqli_close($connection);
}
?>

