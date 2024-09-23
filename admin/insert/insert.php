<?php
// Include your database connection configuration file (e.g., db-config.php)
include '../config/db-config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (replace these with your form fields)
    $date = $_POST['date'];
    $Issue_Start = $_POST['Issue_Start'];
    $Issue_End = $_POST['Issue_End'];
    $Issue_Total = $_POST['Issue_Total'];
    $Issue_Case = $_POST['Issue_Case'];
    $Resolve_Cause = $_POST['Resolve_Cause'];
    $Service_name = $_POST['Service_name'];
    $Category = $_POST['Category'];
    $State = $_POST['State'];
    $Remark = $_POST['Remark'];
    $ผู้รับเรื่อง = $_POST['ผู้รับเรื่อง'];
    $system = $_POST['system'];
    $service_group = $_POST['service_group'];

    if (empty($Service_name)) {
        $Service_name = "-"; // Set a default value if Service_name is empty
    }
	
	if (empty($Issue_Case)) {
        $Issue_Case = "-"; // Set a default value if Service_name is empty
    }
	
	if (empty($Resolve_Cause)) {
        $Resolve_Cause = "-"; // Set a default value if Service_name is empty
    }
	
	if (empty($Remark)) {
        $Remark = "-"; // Set a default value if Service_name is empty
    }
	
	if (empty($service_group)) {
        $service_group = "-"; // Set a default value if Service_name is empty
    }
	
	$date = DateTime::createFromFormat('d-m-Y', $_POST['date'])->format('Y-m-d');

    // Compare Issue_End and Issue_Start timestamps
    $issueEndTimestamp = DateTime::createFromFormat('d-m-Y : H:i', $Issue_End)->getTimestamp();
    $issueStartTimestamp = DateTime::createFromFormat('d-m-Y : H:i', $Issue_Start)->getTimestamp();

    if ($issueEndTimestamp < $issueStartTimestamp) {
        echo '<script>alert("วันที่และเวลา END ต้องไม่น้อยกว่า START"); window.history.back();</script>';
    } else {
        // Create an INSERT query
        $sql = "INSERT INTO incident_report (date, Issue_Start, Issue_End, Issue_Total, Issue_Case, Resolve_Cause, Service_name, Category, State, Remark, ผู้รับเรื่อง, system, service_group) VALUES ('$date', '$Issue_Start', '$Issue_End', '$Issue_Total', '$Issue_Case', '$Resolve_Cause', '$Service_name', '$Category', '$State', '$Remark', '$ผู้รับเรื่อง', '$system','$service_group')";

        // Execute the query
        $result = mysqli_query($connection, $sql);

        // Check if the insertion was successful
        if ($result === TRUE) {
            echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "../index.php";</script>';
        } else {
            echo "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }

    // Close the connection
    mysqli_close($connection);
}
?>
