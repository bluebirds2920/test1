<?php
session_start();
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];
	$sql="SELECT crane.c_id,cranetype.ct_id,cranetype.ct_name,crane.c_name,crane.c_details,crane.c_img FROM crane LEFT JOIN cranetype ON crane.ct_id=cranetype.ct_id where crane.c_id ='$id' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
?>
