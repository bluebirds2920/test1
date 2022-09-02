<?php
	include('../config/connectdb.php');
	$ct_id_del=mysqli_real_escape_string($conn,$_POST["ct_id_del"]);
	$sqldel="delete from cranetype where ct_id='$ct_id_del'";
	mysqli_query($conn,$sqldel) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>