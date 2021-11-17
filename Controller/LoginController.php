<?php
require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";

class LoginController
{

    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView();
        $this->authHelper = new AuthHelper();
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
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

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

    function signUpLoad(){
        if($this->authHelper->isLogged()){
            $this->view->showHome();
        }
        else{
            $this->view->showSignUp();
        }
        
    }

    function signUp(){
        if($this->authHelper->isLogged()){
            $this->view->showHome();
        }
        else{
            $email = $_POST['email'];
            if($this->model->getUser($email)){
                $this->view->showSignUp("Ya existe un usuario registrado con este email");
            }
            else{
                $password = $_POST['password'];
                $passwordConfirm = $_POST['passwordConfirm'];
                if($password != $passwordConfirm){
                    $this->view->showSignUp("Las contraseñas deben ser iguales");
                }
                else{
                    $this->model->addUser($email, $password);
                    session_start();
                    $_SESSION["email"] = $email;
                    $this->view->showHome();
                }
            }
        }
    }

    function getRol(){
        return $this->model->getUser($this->authHelper->getUser()); 
    }

    function showUsers(){
        $this->verifyLogin();
        if($this->getRol()){
            $users = $this->model->getUsers();
            $this->view->showUsers($users, $this->authHelper->getUser());
        }
        else{
            $this->view->showHome();
        }
    }
}
