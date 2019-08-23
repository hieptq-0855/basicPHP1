<?php
namespace Validation;

session_start();

class Validation
{
    public function singUpFormValidation($rq)
    {
        $errors = array();
        $pattern = '/^[A-Za-zÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂ ưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐ
        ỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{1,50}$/';
        if (!preg_match($pattern, $rq['full_name'])) {
            array_push($errors, "Họ và tên không hợp lệ!");
        }
        $now_date = date('Y-m-d');
        if ($rq['birth']) {
            if ($rq['birth'] > $now_date) {
                array_push($errors, "Ngày sinh không hợp lệ!");
            }
        } else {
            array_push($errors, "Bạn chưa chọn ngày sinh");
        }
        if (!preg_match('/^(?=.*[a-zA-Z])[A-Za-z\d]{1,50}$/', $rq['user_name'])) {
            array_push($errors, "Tên đăng nhập không hợp lệ!");
        }
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,50}$/', $rq['password'])) {
            if ($rq['password'] !== $rq['confirm_password']) {
                array_push($errors, 'Nhập lại mật khẩu không khớp');
            }
        } else {
            array_push($errors, 'Mật khẩu phải ít nhất 8 ký tự gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 chữ số');
        }

        return $errors;
    }

    public function changePasswordFormValidation($rq)
    {
        $errors = array();
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,50}$/', $rq['new_password'])) {
            if ($rq['new_password'] !== $rq['confirm_password']) {
                array_push($errors, 'Nhập lại mật khẩu không khớp');
            }
        } else {
            array_push($errors, 'Mật khẩu phải ít nhất 8 ký tự gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 chữ số');
        }

        return $errors;
    }

    public function loginFormValidation($rq)
    {
        $errors = array();
        if (!preg_match('/^(?=.*[a-zA-Z])[A-Za-z\d]{1,50}$/', $rq['user_name'])) {
            array_push($errors, "Tên đăng nhập sai!");
        }

        return $errors;
    }
}
