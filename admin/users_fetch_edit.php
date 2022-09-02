<?php
session_start();
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];
	$sql="SELECT * FROM users where users_id ='$id' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
?>
