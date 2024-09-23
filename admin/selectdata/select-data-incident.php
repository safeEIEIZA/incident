<?php

include '../config/db-config.php';

$sql = "select * from incident_report where id = ".$_POST["id"];
$rs = mysqli_query($connection,$sql);

while($row = mysqli_fetch_array($rs,MYSQLI_ASSOC)){
    $arr[] = $row;
}

echo json_encode($arr);

mysqli_free_result($rs);
mysqli_close($connection);
