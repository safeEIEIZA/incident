<?php

include '../config/db-config.php';

if(isset($_POST["name_service"]) && isset($_POST["service_group"])) {
    
    $name_service = mysqli_real_escape_string($connection,$_POST["name_service"]);
    $service_group = mysqli_real_escape_string($connection,$_POST["service_group"]);

     $sql = "Update service_name SET name_service = '$name_service' WHERE id = ".$_POST["id"];;

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
