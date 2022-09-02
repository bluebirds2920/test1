<?php 
    session_start();
    require_once 'config/connectdb.php';
        if (isset($_POST["loginbutton"])) {
            $strSQL = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($conn,$_POST['email'])."' and password = '".mysqli_real_escape_string($conn,md5($_POST['password']))."'";
            $objQuery = mysqli_query($conn,$strSQL);
            $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);        
            if (!$objResult) {
              $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ตรงกัน";

              header("location:index.php");
            }else{
              if ($objResult["urole"] == "admin") {
                $_SESSION['admin_login'] = $objResult['users_id'];
                $_SESSION['urole'] = $objResult['urole'];
                header("location:admin/index.php");
                exit();
              }else{
                $_SESSION['member_login'] = $objResult['users_id'];
                $_SESSION['urole'] = $objResult['urole'];
                header("location:member/index.php");
                exit();
              }
            }
          }
