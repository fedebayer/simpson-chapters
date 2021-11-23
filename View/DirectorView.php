<?php
require_once 'Libs/smarty/libs/Smarty.class.php';
class DirectorView
{
    private $smarty;
    public function __construct()
    {
        $this->smarty = new Smarty();
    }
    function renderDirectors($directors, $logged = null, $idToChange = null)
    {
        $this->smarty->assign('directors', $directors);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('idToChange', $idToChange);
        $this->smarty->display('templates/directorList.tpl');
    }
    function renderError($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/error.tpl');
    }
    function renderHomeLocation()
    {
        header("Location: " . BASE_URL . "directores");
    }
    function renderDirectorInfo($directors)
    {
        $this->smarty->assign('directors', $directors);
        $this->smarty->display('templates/directorInfo.tpl');
    }
    function renderDirectorChapters($director, $chapters)
    {
        $this->smarty->assign('chapters', $chapters);
        $this->smarty->assign('director', $director);
        $this->smarty->assign('fromChapters', 0);
        $this->smarty->assign('fromDirectors', 1);
        $this->smarty->display('templates/chaptersByDirector.tpl');
    }
}
