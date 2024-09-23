<?php

include '../config/db-config.php';

if(isset($_POST["state_name"])){

    $system_name = mysqli_real_escape_string($connection,$_POST["state_name"]);


     $sql = "Update table_state SET state_name = '$system_name' WHERE id = ".$_POST["id"];;

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
