<?php
namespace Controller;

use Database\Database;
use http\Header;
use Model\User;

include_once('Database/database.php');
include_once ('Model/User.php');

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
        if ($result) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['user_name'];
            $_SESSION['user_role'] = $result['role'];
            if ($result['role'] === 2) {
                Header('Location: index.php?controller=ViewController&function=returnAdminHome');
            } else {
                Header('Location: index.php?controller=ViewController&function=returnClientHome');
            }
        } else {
            echo '<script>alert("Tài khoản hoặc mật khẩu sai");window.location.href="./index.php";</script>';
        }

    }

    public function doLogout(){
        session_unset();
        Header('Location: index.php');
    }

    public function doUpdateUser($id, $full_name, $address, $birth){
        $db = new Database();
        $result = $db->doUpdateUser($id, $full_name, $address, $birth);
        $db->close();
        if ($result) {
            echo '<script>alert("Cập nhật thành công");window.location.href="./index.php";</script>';
        } else {
            echo '<script>alert("Cập nhật lỗi!");window.location.href="./index.php";</script>';
        }
    }

    public function doDeleteUser($id){
        $db = new Database();
        $result = $db->deleteUser($id);
        $db->close();
        if ($result) {
            echo '<script>alert("Xóa thành công");window.location.href="./index.php?controller=ViewController&function=returnUserManagement";</script>';
        } else {
            echo '<script>alert("Có lỗi xảy ra !");window.location.href="./index.php?controller=ViewController&function=returnUserManagement";</script>';
        }
    }

    public function doChangePassword($current_password, $new_password, $confirm_password){
        if ($new_password === $confirm_password) {
            $db = new Database();
            if (isset($_SESSION['user_name'])) {
                $user = $db->checkLogin($_SESSION['user_name'], $current_password);
                if ($user) {
                    $result = $db->changePassword($user['id'], $new_password);
                    if ($result) {
                        echo '<script>alert("Đổi mật khẩu thành công!");window.location.href="./index.php";</script>';
                    }

                    echo '<script>alert("Lỗi!");window.location.href="./index.php";</script>';
                }
                $db->close();

                echo '<script>alert("Bạn nhập sai mật khẩu!");window.location.href="./index.php?controller=ViewController&function=returnAdminChangePassword";</script>';
            }
            $db->close();

            echo '<script>alert("Lỗi!");window.location.href="./index.php";</script>';
        }

        echo '<script>alert("Nhập lại mật khẩu không khớp!");window.location.href="./index.php?controller=ViewController&function=returnAdminChangePassword";</script>';
    }
}
