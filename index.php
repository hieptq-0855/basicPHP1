<?php
session_start();
use Controller\ViewController;
use Controller\Controller;

include_once('Controller/ViewController.php');
include_once('Controller/Controller.php');

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
            }
            break;
        case 'Controller':
            $controller = new Controller();
            switch ($function) {
                case 'doSignUp':
                    if (isset($_POST['signup'])) {
                        $controller->doSignUp( $_POST['full_name'], $_POST['birth'], $_POST['user_name'], $_POST['password'], $_POST['confirm_password']);
                    } else {
                        header('Location: index.php');
                    }

                    break;
                case 'doLogin':
                    if (isset($_POST['login'])) {
                        $controller->doLogin($_POST['user_name'], $_POST['password']);
                    } else {
                        header('Location: index.php');
                    }
                    break;
                case 'doLogout':
                        $controller->doLogout();
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
