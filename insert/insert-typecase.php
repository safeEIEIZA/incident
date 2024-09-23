<?php
include '../config/db-config.php';
// Check if the request is coming from an AJAX call
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (replace these with your form fields)
    $addtype_name = $_POST['addtype_name'];


    // Create an INSERT query
    $sql = "INSERT INTO type_case (type_name) VALUES ('$addtype_name')";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the insertion was successful
    if ($result === TRUE) {
        echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "../typecase_manage.php";</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // Close the connection
    mysqli_close($connection);
}
?>

