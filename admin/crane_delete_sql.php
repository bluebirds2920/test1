<?php
	include('../config/connectdb.php');
	$c_id_del=mysqli_real_escape_string($conn,$_POST["c_id_del"]);
	$sqldel2="delete from crane where c_id='$c_id_del'";
	mysqli_query($conn,$sqldel2) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>
