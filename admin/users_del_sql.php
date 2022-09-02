<?php
	include('../config/connectdb.php');
	$users_id_del=mysqli_real_escape_string($conn,$_POST["users_id_del"]);
	$sql="delete from users where users_id='$users_id_del'";
	mysqli_query($conn,$sql) or die ("sql ผิด");
	echo "ลบข้อมูลเรียบร้อยแล้วจ๊ะ";
	mysqli_close($conn);
?>
