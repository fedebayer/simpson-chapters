<?php
require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";

class LoginController
{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView();
    }

    function logout()
    {
        session_destroy();
        $this->view->showLogin("Te deslogueaste!");
    }

    function login()
    {
        $this->view->showLogin();
    }

    function verifyLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!empty($email) && !empty($password)) {
            // Obtengo el usuario de la base de datos
            $user = $this->model->getUser($email);
            // Si el usuario existe y las contraseñas coinciden
            if ($user && password_verify($password, $user->password)) {
                session_start();
                $_SESSION["email"] = $email;
                $this->view->showHome();
            } else {
                $this->view->showLogin("Acceso denegado");
            }
        }
    }
}
