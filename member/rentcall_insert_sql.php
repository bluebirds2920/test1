<?php
session_start();
include('../config/connectdb.php');

$c_id = $_SESSION["c_id"] ;
$id = $_SESSION['member_login'];
$r_role = 'รอการตรวจสอบ';
if (isset($_POST['rentcall'])) {

$r_startdate=mysqli_real_escape_string($conn,$_POST["r_startdate"]);
$r_numdate=mysqli_real_escape_string($conn,$_POST["r_numdate"]);
$r_place=mysqli_real_escape_string($conn,$_POST["r_place"]);

$pm_id=mysqli_real_escape_string($conn,$_POST["pm_id"]);

$sqlsave="INSERT INTO rental(c_id,r_startdate,r_numdate,r_place,users_id,r_role,pm_id) 
VALUES ('$c_id','$r_startdate','$r_numdate','$r_place','$id','$r_role','$pm_id')";

mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");


echo "บันทึกข้อมูลสำเร็จ"; header("location:index.php");    
}
