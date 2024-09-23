<?php

include '../config/db-config.php';

if(isset($_POST["name"]) && isset($_POST["sername"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["level"])){

    $name = mysqli_real_escape_string($connection,$_POST["name"]);
    $sername = mysqli_real_escape_string($connection,$_POST["sername"]);
    $username = mysqli_real_escape_string($connection,$_POST["username"]);
    $password = mysqli_real_escape_string($connection,$_POST["password"]);
    $level = mysqli_real_escape_string($connection,$_POST["level"]);


     $sql = "Update table_name SET name = '$name' , sername = '$sername', username = '$username' , password = '$password' , level = '$level' WHERE id = ".$_POST["id"];;

    mysqli_query($connection,$sql);
  
    mysqli_close($connection);

}else{
    echo 'error';
}
