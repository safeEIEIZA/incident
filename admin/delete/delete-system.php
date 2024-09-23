<?php

include '../config/db-config.php';

if(isset($_POST["id"])){
    $sql = "delete from table_system where id = ".$_POST["id"];
    mysqli_query($connection,$sql);
}
