<?php

include '../config/db-config.php';

if(isset($_POST["date"]) && isset($_POST["Issue_Start"]) && isset($_POST["Issue_End"]) && isset($_POST["Issue_Total"]) && isset($_POST["Issue_Case"]) && isset($_POST["Resolve_Cause"]) && isset($_POST["Service_name"]) && isset($_POST["Category"]) && isset($_POST["State"]) && isset($_POST["Remark"]) && isset($_POST["ผู้รับเรื่อง"])){

    $date = mysqli_real_escape_string($connection, $_POST["date"]);
    $date = date("Y-m-d", strtotime($date)); // แปลงรูปแบบวันที่จาก d-m-Y เป็น Y-m-d
	
    $Issue_Start = mysqli_real_escape_string($connection,$_POST["Issue_Start"]);
    $Issue_End = mysqli_real_escape_string($connection,$_POST["Issue_End"]);
    $Issue_Total = mysqli_real_escape_string($connection,$_POST["Issue_Total"]);
    $Issue_Case = mysqli_real_escape_string($connection,$_POST["Issue_Case"]);
    $Resolve_Cause = mysqli_real_escape_string($connection,$_POST["Resolve_Cause"]);
    $Service_name = mysqli_real_escape_string($connection,$_POST["Service_name"]);
    $service_group = mysqli_real_escape_string($connection,$_POST["service_group"]);
    $Category = mysqli_real_escape_string($connection,$_POST["Category"]);
    $State = mysqli_real_escape_string($connection,$_POST["State"]);
    $Remark = mysqli_real_escape_string($connection,$_POST["Remark"]);
    $difference = mysqli_real_escape_string($connection,$_POST["difference"]);
    $ผู้รับเรื่อง = mysqli_real_escape_string($connection,$_POST["ผู้รับเรื่อง"]);


    if (empty($Service_name)) {
        $Service_name = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }
	
	if (empty($Issue_Case)) {
        $Issue_Case = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }
	
	if (empty($Resolve_Cause)) {
        $Resolve_Cause = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }
	
	if (empty($Remark)) {
        $Remark = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }
	
	if (empty($difference)) {
        $difference = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }
	
	if (empty($service_group)) {
        $service_group = "-"; // หากค่าว่างให้กำหนดค่าให้เป็น "-"
    }


    // Validate end time
    $startTimestamp = strtotime($Issue_Start);
    $endTimestamp = strtotime($Issue_End);

    if ($endTimestamp < $startTimestamp) {
        echo 'time_error';
        exit; // Stop further execution
    }

     $sql = "Update incident_report SET date = '$date', Issue_Start = '$Issue_Start', Issue_End = '$Issue_End', Issue_Total = '$Issue_Total',";
     $sql .= " Issue_Case = '$Issue_Case', Resolve_Cause = '$Resolve_Cause', Service_name = '$Service_name', difference = '$difference', service_group = '$service_group', Category = '$Category', State = '$State', Remark = '$Remark', ผู้รับเรื่อง = '$ผู้รับเรื่อง' WHERE id = ".$_POST["id"];

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
