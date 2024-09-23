<?php
include '../config/db-config.php';
// Check if the request is coming from an AJAX call
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (replace these with your form fields)
    $addname_service = $_POST['addname_service'];
    $addservice_group = $_POST['addservice_group'];

    // Create an INSERT query
    $sql = "INSERT INTO service_name (name_service,service_group) VALUES ('$addname_service','$addservice_group')";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the insertion was successful
    if ($result === TRUE) {
        echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "../service_manage.php";</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $connection->error;
    }

    // Close the connection
    mysqli_close($connection);
}
?>

