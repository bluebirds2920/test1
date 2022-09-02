<?php 
    session_start();
    require_once 'config/connectdb.php';
    if (isset($_POST['userquestion'])) {
        $uqt_firstname = mysqli_real_escape_string($conn,$_POST["uqt_firstname"]);
        $uqt_lastname = mysqli_real_escape_string($conn,$_POST["uqt_lastname"]);
        $uqt_phone = mysqli_real_escape_string($conn,$_POST["uqt_phone"]);
        $uqt_details =  mysqli_real_escape_string($conn,$_POST["uqt_details"]);


        $strSQL = "INSERT INTO users_question (uqt_firstname,uqt_lastname,uqt_phone,uqt_details) VALUES ('$uqt_firstname','$uqt_lastname','$uqt_phone','$uqt_details')";
        mysqli_query($conn,$strSQL) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน");
        $_SESSION['success'] = "ทางเราจะรีบตอบกลับท่านให้เร็วที่สุด ขอบพระคุณที่ไว้ใจ้เรา ";
        header("location:questional.php");    
        } else {
        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
        header("location: questional.php");
        }
?>