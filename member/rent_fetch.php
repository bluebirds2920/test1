<?php
session_start();
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];

	$sql="SELECT rental.*,crane.c_name,payment_type.pm_name,users.fullname FROM rental LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id  WHERE r_id = $id";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
?>
