<?php
session_start();
	include('../config/connectdb.php');
	$id=$_REQUEST['id'];

	$sql="SELECT rcpt.*,rental.*,users.*,crane.*,payment_type.*  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id where rcpt.r_id ='$id' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
?>
