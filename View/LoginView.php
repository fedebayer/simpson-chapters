<?php
//$clave = "1234";
//$clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);
//echo "La clave $clave encriptada es la siguiente: $clave_encriptada";


require_once './Libs/smarty/libs/Smarty.class.php';

class LoginView
{

    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showLogin($error = "")
    {
        $this->smarty->assign('titulo', 'Log In');
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/login.tpl');
    }

    function showHome()
    {
        header("Location: " . BASE_URL . "home");
    }

    function showSignUp($error = ""){
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/signUp.tpl');
    }

    function showUsers($users){
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/userList.tpl');
    }
}
