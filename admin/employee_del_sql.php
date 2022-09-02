<?php
	include('../config/connectdb.php');
	$em_id_del=mysqli_real_escape_string($conn,$_POST["em_id_del"]);
	$sqldel2="delete from employee where em_id='$em_id_del'";
	mysqli_query($conn,$sqldel2) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>
