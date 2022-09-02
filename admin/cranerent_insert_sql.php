<?php
include('../config/connectdb.php');


$r_id=mysqli_real_escape_string($conn,$_POST["r_id"]);
$cr_date=mysqli_real_escape_string($conn,$_POST["cr_date"]);



	$sqlsave="INSERT INTO cranerent(r_id,cr_date) 
					VALUES ('$r_id','$cr_date')";
	mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");
	echo "บันทึกข้อมูลสำเร็จ"; header("location:rent_check_insert.php");    
	mysqli_close($conn);

?>