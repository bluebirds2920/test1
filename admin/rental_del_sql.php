<?php
	include('../config/connectdb.php');
	$r_id_del=mysqli_real_escape_string($conn,$_POST["r_id_del"]);
	$sql="delete from rental where r_id='$r_id_del'";
	mysqli_query($conn,$sql) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>
