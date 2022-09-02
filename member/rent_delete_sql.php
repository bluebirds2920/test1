<?php
	include('../config/connectdb.php');
	$r_id=mysqli_real_escape_string($conn,$_POST["r_id_rentform2"]);
	$sqldel="delete from rental where r_id='$r_id'";
	mysqli_query($conn,$sqldel) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>
