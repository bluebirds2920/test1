<?php
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];
	$sql="SELECT * FROM cranetype where ct_id ='$id' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
?>
