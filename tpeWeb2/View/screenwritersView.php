<?php
require_once 'Libs/smarty/libs/Smarty.class.php';

class ScreenwritersView
{
    private $smarty;
    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function home($screenwriters, $idToChange = null)
    {
        $this->smarty->assign('screenwriters', $screenwriters);
        $this->smarty->assign('idToChange', $idToChange);
        $this->smarty->display('templates/screenwriters.tpl');
    }

    function loadChaptersOfScreenwritter($data)
    {
        echo $data;
    }
    function renderError($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/error.tpl');
    }
}
