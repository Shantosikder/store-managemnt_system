<?php 

$id = $_GET['id'];
include('php/db_config.php');

$sql = "DELETE FROM customar WHERE id = '$id'";

$db->query($sql);

if($db->affected_rows>0){
	
	header("Location: manage_customer.php");

}


 ?>