<?php 

$id = $_GET['id'];
include('php/db_config.php');

$sql = "DELETE FROM supplier WHERE id = '$id'";

$db->query($sql);

if($db->affected_rows>0){
	
	header("Location: supplier_manage.php");

}


 ?>