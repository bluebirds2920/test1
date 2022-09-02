<?php
include('../config/connectdb.php');

if (isset($_POST['updatecrane'])) {

$c_name=mysqli_real_escape_string($conn,$_POST["c_name"]);
$ct_id=mysqli_real_escape_string($conn,$_POST["ct_id"]);
$c_details=mysqli_real_escape_string($conn,$_POST["c_details"]);

$img = $_FILES['img'];
$upload = $_FILES['img']['name'];
$allow = array('jpg', 'jpeg', 'png','svg');
$extension = explode('.', $img['name']);
$fileActExt = strtolower(end($extension));
$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
$filePath = '../uploads/'.$fileNew;

if (in_array($fileActExt, $allow)) {
    if ($img['size'] > 0 && $img['error'] == 0) {
        move_uploaded_file($img['tmp_name'],$filePath);     

        $sqlsave="INSERT INTO crane(c_name,ct_id,c_details,c_img) 
        VALUES ('$c_name','$ct_id','$c_details','$fileNew')";

mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");



echo "บันทึกข้อมูลสำเร็จ"; header("location:edit_crane.php");    
        }
    }
}  

?>