<?php 
session_start();
if(isset($_POST['username'])){
    include("../config/db-config.php");
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql="SELECT * FROM table_name 
    WHERE  username='".$username."' 
    AND  password='".$password."' ";
    $result = mysqli_query($connection,$sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);

        $_SESSION["id"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["level"] = $row["level"];

        $_SESSION["expiration"] = strtotime('tomorrow');

        if($_SESSION["level"]=="Admin"){ 
            Header("Location:../admin/index.php");
        }
        elseif($_SESSION["level"]=="User"){ 
            Header("Location:../index.php");
        }
        else {
            // Redirect to the page that will show the "You are not an admin" popup
            Header("Location: formlogin.php?error=not_admin");
            exit();
        }
    } else {
        // Invalid credentials, redirect back to login with error message
        header("Location: formlogin.php?error=invalid_credentials");
        exit();
    }
} else {
    // Invalid credentials, redirect back to login with error message
    header("Location: formlogin.php?error=invalid_credentials");
    exit();
}
?>
