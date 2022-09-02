<?php
include('../config/connectdb.php');

if (isset($_POST['emsubmit'])) {

$firstname=mysqli_real_escape_string($conn,$_POST["firstname"]);
$lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
$phonenumber=mysqli_real_escape_string($conn,$_POST["phonenumber"]);

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

        $sqlsave="INSERT INTO employee(em_firstname,em_lastname,em_phone,em_img) 
        VALUES ('$firstname','$lastname','$phonenumber','$fileNew')";

mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");
echo "บันทึกข้อมูลสำเร็จ"; 

header("location:edit_staff.php");    
        }
    }
}  

?>