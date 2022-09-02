<?php 
    session_start();
    require_once 'config/connectdb.php';

    if (isset($_POST['registers'])) {

        $email =  mysqli_real_escape_string($conn,$_POST["email"]);
        $fullname = mysqli_real_escape_string($conn,$_POST["fullname"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        $confirmpassword = mysqli_real_escape_string($conn,$_POST["confirmpassword"]);
        $phonenumber = mysqli_real_escape_string($conn,$_POST["phonenumber"]);
        $urole = 'member';

        if (empty($fullname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: index.php#registers");
        } else if (empty($phonenumber)) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
            header("location: index.php#registers");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมลล์';
            header("location: index.php#registers");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: index.php#registers");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: index.php#registers");
        } else if (empty($confirmpassword)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: index.php#registers");
        } else if ($password != $confirmpassword) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: index.php#registers");
        } else {


            $strSQL = "SELECT * FROM users WHERE email = '".trim($email)."'";
            $objQuery = mysqli_query($conn,$strSQL);
            $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);   
            if ($objResult) {
              $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว ";
                    header("location: index.php#registers");
                } else if (!isset($_SESSION['error'])) {
                    $passwordmd5 = md5($password);
                    $strSQL2 = "INSERT INTO users (email,password,fullname,phonenumber,urole) VALUES ('$email','$passwordmd5','$fullname','$phonenumber','$urole')";
                    mysqli_query($conn,$strSQL2) or die ("กรุณาใส่ข้อมูลให้ครบถ้วน");
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว ! ตอนนี้ท่านสามารถเช่ารถของเราได้แล้วนะ";
                    header("location:index.php#registers");    
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: index.php#registers");
                }            
        }
    }
?>