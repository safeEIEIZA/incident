<?php

include '../config/db-config.php';

if(isset($_POST["type_name"])){

    $type_name = mysqli_real_escape_string($connection,$_POST["type_name"]);


     $sql = "Update type_case SET type_name = '$type_name' WHERE id = ".$_POST["id"];;

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
