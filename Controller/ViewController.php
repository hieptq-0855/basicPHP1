<?php
namespace Controller;

class ViewController {
    public function returnLogin(){
        Header('Location: View/login.php');
    }
    public function returnSignUp(){
        Header('Location: View/signup.php');
    }

    public function returnClientHome(){
        Header('Location: View/Client/home.php');
    }

    public function returnAdminHome(){
        Header('Location: View/Admin/home.php');
    }

    public function returnUserManagement(){
        Header('Location: View/Admin/user-management.php');
    }
}
