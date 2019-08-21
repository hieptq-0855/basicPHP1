<?php
namespace Validation;

session_start();

class Validation {
    public function SingUpFormValidation($rq){
        $errors = array();
        $now_date = date('Y-m-d');
        if ($rq['birth'] > $now_date) {
            array_push($errors, "Ngày sinh không hợp lệ!");
        }
        if (!preg_match('/^(?=.*[a-zA-Z])[A-Za-z\d]+$/', $rq['user_name'])) {
            array_push($errors, "Tên đăng nhập không hợp lệ!");
        }
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $rq['password'])) {
            if ($rq['password'] !== $rq['confirm_password']) {
                array_push($errors, 'Nhập lại mật khẩu không khớp');
            }
        } else {
            array_push($errors, 'Mật khẩu phải ít nhất 8 ký tự gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 chữ số');
        }

        return $errors;
    }
}
