<?php

extract($_POST);

include('db_config.php');

$sql= "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
 $data=$db->query($sql);

 if($db->affected_rows>0){
   session_start();
    $_SESSION['login']=true;
    header("Location:../dashboard.php");
 }else{
    header("Location:../login.php");
 }
 


?>

