<?php
namespace Controller;
use Database\Database;
use http\Header;

include_once('Database/database.php');

class Controller{
    public function doSignUp($full_name, $birth, $user_name, $password, $confirm_password){
        if ($password != $confirm_password) {
            echo '<script>alert("Nhập lại mật khẩu không khớp!");window.location.href="./index.php?controller=ViewController&function=returnSignUp";</script>';
        } else {
            $db = new Database();
            $bo = $db->checkUserName($user_name);
            if ($bo) {
                $bo = $db->storeUser($full_name, $birth, $user_name, $password);
                $db->close();
                if ($bo) {
                    echo '<script>alert("Đăng ký thành công!");window.location.href="./index.php";</script>';
                } else {
                    echo '<script>alert("Xảy ra lỗi!");window.location.href="./index.php?controller=ViewController&function=returnSignUp";</script>';
                }
            } else {
                echo '<script>alert("Tên đăng nhập đã tồn tại!");window.location.href="./index.php?controller=ViewController&function=returnSignUp";</script>';
            }
        }
    }

    public function doLogin($user_name, $password){
        $db = new Database();
        $result = $db->checkLogin($user_name, $password);
        $db->close();
        if ($result != false) {
            setcookie('user_id', $result['id'], time() + 86400, "/");
            setcookie('user_name', $result['user_name'], time() + 86400, "/");
            setcookie('user_role', $result['role'], time() + 86400, "/");
            if ($result['role'] == 2) {
                Header('Location: index.php?controller=ViewController&function=returnAdminHome');
            } else {
                Header('Location: index.php?controller=ViewController&function=returnClientHome');
            }
        } else {
            echo '<script>alert("Tài khoản hoặc mật khẩu sai");window.location.href="./index.php";</script>';
        }

    }
}

