<?php 
    session_start();
    if(isset($_SESSION['user_login'])){
      $_SESSION['error'] = 'คุณไม่ใช่ Admin!';
      header('location:../signin.php');
    }else if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../signin.php');
    }

?>