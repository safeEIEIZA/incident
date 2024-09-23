<?php

include '../config/db-config.php';

if(isset($_POST["system_name"])){

    $system_name = mysqli_real_escape_string($connection,$_POST["system_name"]);


     $sql = "Update table_system SET system_name = '$system_name' WHERE id = ".$_POST["id"];;

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
