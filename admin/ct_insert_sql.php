<?php
include('../config/connectdb.php');


$ct_name=mysqli_real_escape_string($conn,$_POST["ct_name"]);



	$sqlsave="INSERT INTO cranetype(ct_name) 
					VALUES ('$ct_name')";
	mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");
	echo "บันทึกข้อมูลสำเร็จ"; 
	mysqli_close($conn);

?>