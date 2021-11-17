<?php
session_start();
class AuthHelper
{

    function __construct()
    {
    }

    function checkLoggedIn()
    {

        if (!isset($_SESSION["email"])) {
            header("Location: " . BASE_URL . "login");
            die();
        }
    }

    function isLogged()
    {
        if (isset($_SESSION["email"])) {
            return true;
        } else {
            return false;
        }
    }
}
