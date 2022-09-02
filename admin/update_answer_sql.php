<?php
include('../config/connectdb.php');


    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $uqt_answer = mysqli_real_escape_string($conn, $_POST["uqt_answer"]);
   
    $sql = "update users_question set uqt_answer ='$uqt_answer' where uqt_id='$id'";
    $result = mysqli_query($conn, $sql) or die("กรุณาใส่ข้อมูลให้ครบถ้วน");
    echo "เพิ่มคำตอบสำเร็จ";
    mysqli_close($conn);



?>