<?php

include '../config/db-config.php';

if(isset($_POST["id"])){
    $sql = "delete from incident_report where id = ".$_POST["id"];
    mysqli_query($connection,$sql);
}