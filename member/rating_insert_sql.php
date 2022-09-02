<?php
session_start();
include('../config/connectdb.php');



    $rcpt_id=mysqli_real_escape_string($conn,$_POST["rcpt_id_form"]);
    $rating_num=mysqli_real_escape_string($conn,$_POST["rating"]);




    $rating_details=mysqli_real_escape_string($conn,$_POST["rating_details"]);
    $rcpt_rating = 'ให้คะแนนสำเร็จ';

    $sql = "update rcpt set rcpt_rating ='$rcpt_rating' where rcpt_id = '$rcpt_id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");


$sqlsave="INSERT INTO rating(rcpt_id,rating_num,rating_details) 
VALUES ('$rcpt_id','$rating_num','$rating_details')";

mysqli_query($conn,$sqlsave) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน2");


echo "บันทึกข้อมูลสำเร็จ";  

