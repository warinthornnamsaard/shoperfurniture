<?php

session_start();
require_once 'connect.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $urole = 'user';

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกusername';
        header("location: register.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: register.php");
    } else if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: register.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: register.php");
    } else if (empty($phone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์';
        header("location: register.php");
    } else {
        try {

            $check_user = $pdo->prepare("SELECT username FROM users WHERE username = :username");
            $check_user->bindParam(":username", $username);
            $check_user->execute();
            $row = $check_user->fetch(PDO::FETCH_ASSOC);

            if ($row['username'] == $username) {
                $_SESSION['warning'] = "มีuserนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users(username,password,firstname, lastname, phone,address, urole) 
                                            VALUES(:username,
                                            :password, :firstname, :lastname, :phone,
                                            :address, :urole)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":address", $address);
                $stmt->bindParam(":urole", $urole);
                $stmt->execute();
                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: register.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
