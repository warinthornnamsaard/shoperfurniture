<?php

session_start();
require_once 'connect.php';

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกusername';
        header("location: signin.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
    } else {
        try {

            $check_data = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $check_data->bindParam(":username", $username);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount()>0) {
                if($username == $row['username']){
                    if(password_verify($password, $row['password'])){
                        if(!empty($_POST['remember'])){
                            setcookie('username_login', $username, time()+360*7);
                            setcookie('password_login', $password, time()+360*7);
                        
                        }else{
                            setcookie('username_login', "", time());
                            setcookie('password_login', "", time());
                        }
                        if($row['urole']=='admin'){
                            $_SESSION['admin_login'] = $row['id'];
                            $_SESSION['cart'] = array();
                            header("location:admin/admin.php");
                        }
                        else {
                            $_SESSION['user_login'] = $row['id'];
                            $_SESSION['cart'] = array();
                            header("location:index.php");
                        }
                    }else{
                        $_SESSION['error'] = 'username หรือ รหัสผ่าน ผิด';
                        header("location: signin.php");
                    }
                } else{
                    $_SESSION['error'] = 'username หรือ รหัสผ่าน ผิด';
                    header("location: signin.php");
                }
            } else{
                $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                header("location: signin.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
