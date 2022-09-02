<?php
include('../config/connectdb.php');


$r_id=mysqli_real_escape_string($conn,$_POST["r_id_Rcpt"]);
$rcpt_num=mysqli_real_escape_string($conn,$_POST["c_num_Rcpt"]);
$rcpt_allnum=mysqli_real_escape_string($conn,$_POST["allnum_Rcpt"]);


$rcpt_role = 'ค้างชำระ';
	$sqlsave="INSERT INTO rcpt(r_id,rcpt_num,rcpt_allnum,rcpt_role) 
					VALUES ('$r_id','$rcpt_num','$rcpt_allnum','$rcpt_role')";



    $r_role = 'ตรวจสอบเสร็จสิ้น';
    $sql = "update rental set r_role ='$r_role' where r_id ='$r_id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    $result2 = mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");

	echo "ออกใบเสร็จเรียบร้อย"; 
	mysqli_close($conn);
    




	





?>