<?php
session_start();
use Controller\ViewController;
use Controller\Controller;
use Validation\Validation;

include_once('Controller/ViewController.php');
include_once('Controller/Controller.php');
include_once('Validation/validation.php');

if (isset($_GET['controller']) && isset($_GET['function'])) {
    $controller = $_GET['controller'];
    $function = $_GET['function'];
    switch ($controller) {
        case 'ViewController':
            $viewController = new ViewController();
            switch ($function) {
                case 'returnSignUp':
                    $viewController->returnSignUp();
                    break;
                case 'returnAdminHome':
                    $viewController->returnAdminHome();
                    break;
                case 'returnClientHome':
                    $viewController->returnClientHome();
                    break;
                case 'returnUserManagement':
                    $viewController->returnUserManagement();
                    break;
                case 'returnUpdateUser':
                    if (isset($_GET['id'])) {
                        $viewController->returnUpdateUser($_GET['id']);
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'returnAdminUpdateProfile':
                    $viewController->returnAdminUpdateProfile();
                    break;
                case 'returnAdminChangePassword':
                    $viewController->returnAdminChangePassword();
                    break;
                case 'returnUserUpdateProfile':
                    $viewController->returnUserUpdateProfile();
                    break;
            }
            break;
        case 'Controller':
            $controller = new Controller();
            switch ($function) {
                case 'doSignUp':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $rq['full_name'] = trim($rq['full_name']);
                        $rq['user_name'] = trim($rq['user_name']);
                        $errors = Validation::singUpFormValidation($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;
                            Header('Location: index.php?controller=ViewController&function=returnSignUp');
                        } else {
                            $controller->doSignUp($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }

                    break;
                case 'doLogin':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $rq['user_name'] = trim($rq['user_name']);
                        $errors = Validation::loginFormValidation($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;
                            Header('Location: index.php');
                        } else {
                            $controller->doLogin($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doLogout':
                        $controller->doLogout();
                    break;
                case 'doAdminUpdateProfile':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $rq['full_name'] = trim($rq['full_name']);
                        $rq['address'] = trim($rq['address']);
                        $errors = Validation::updateUserForm($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;

                            ViewController::returnAdminUpdateProfile();
                        } else {
                            $controller->doUpdateProfile($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doUserUpdateProfile':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $rq['full_name'] = trim($rq['full_name']);
                        $rq['address'] = trim($rq['address']);
                        $errors = Validation::updateUserForm($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;

                            ViewController::returnUserUpdateProfile();
                        } else {
                            $controller->doUpdateProfile($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doUpdateUser':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $rq['full_name'] = trim($rq['full_name']);
                        $rq['address'] = trim($rq['address']);
                        $errors = Validation::updateUserForm($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;

                            ViewController::returnUpdateUser($rq['id']);
                        } else {
                            $controller->doUpdateUser($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doDeleteUser':
                    if (isset($_POST['id'])) {
                        $controller->doDeleteUser($_POST['id']);
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doAdminChangePassword':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rq = $_REQUEST;
                        $errors = Validation::changePasswordFormValidation($rq);
                        if (count($errors) > 0) {
                            $_SESSION['errors'] = $errors;

                            Header('Location: index.php?controller=ViewController&function=returnAdminChangePassword');
                        } else {
                            $controller->doChangePassword($rq);
                        }
                    } else {
                        header('Location: index.php');
                    }
                    break;
            }
            break;
    }
} else {
    $viewController = new ViewController();
    if (isset($_SESSION['user_role'])) {
        if ((int) $_SESSION['user_role'] === 2) {
            $viewController->returnAdminHome();
        } else {
            $viewController->returnClientHome();
        }
    } else {
        $viewController->returnLogin();
    }
}
