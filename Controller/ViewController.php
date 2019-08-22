<?php
namespace Controller;

class ViewController
{
    public function returnLogin()
    {
        Header('Location: View/login.php');
    }
    public function returnSignUp()
    {
        Header('Location: View/signup.php');
    }

    public function returnClientHome()
    {
        Header('Location: View/Client/home.php');
    }

    public function returnAdminHome()
    {
        Header('Location: View/Admin/home.php');
    }

    public function returnUserManagement()
    {
        Header('Location: View/Admin/user-management.php');
    }

    public function returnUpdateUser($id)
    {
        Header('Location: View/Admin/update-user.php?id=' . $id);
    }

    public function returnAdminUpdateProfile()
    {
        Header('Location: View/Admin/update-profile.php');
    }

    public function returnAdminChangePassword()
    {
        Header('Location: View/Admin/change-password.php');
    }

    public function returnUserUpdateProfile()
    {
        Header('Location: View/Client/update-profile.php');
    }
}
