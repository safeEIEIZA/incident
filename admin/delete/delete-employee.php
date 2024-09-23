<?php

include '../config/db-config.php';

if(isset($_POST["id"])){
    $sql = "delete from table_name where id = ".$_POST["id"];
    mysqli_query($connection,$sql);
}
