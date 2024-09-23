<?php
// Include your database connection configuration file (e.g., db-config.php)
include '../config/db-config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (replace these with your form fields)
    $add_name = $_POST['add_name'];
    $add_username = $_POST['add_username'];
    $add_password = $_POST['add_password'];
    $add_level = $_POST['add_level'];
    $add_sername =$_POST['add_sername'];

    
    if (empty($add_level)) {
        echo '<script>alert("กรุณาเลือก level"); window.location.href = "../employee_manage.php";</script>';
        exit;
    }


    // Create an INSERT query
    $sql = "INSERT INTO table_name (name,sername, username, password, level) VALUES ('$add_name', '$add_sername' , '$add_username', '$add_password', '$add_level')";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the insertion was successful
    if ($result === TRUE) {
        echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "../index.php";</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // Close the connection
    mysqli_close($connection);
}
?>