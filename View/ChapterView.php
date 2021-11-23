<?php
require_once 'Libs/smarty/libs/Smarty.class.php';
class ChapterView
{
    private $smarty;
    public function __construct()
    {
        $this->smarty = new Smarty();
    }
    function renderChapters($chapters, $directors, $screenwriters, $rol, $pages, $currentPage, $logged = null, $idToChange = null)
    {
        $this->smarty->assign('chapters', $chapters);
        $this->smarty->assign('screenwriters', $screenwriters);
        $this->smarty->assign('directors', $directors);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('rol', $rol);
        $this->smarty->assign('idToChange', $idToChange);
        $this->smarty->assign('pages', $pages);
        $this->smarty->assign('page', $currentPage);
        $this->smarty->display('templates/chapterList.tpl');
    }
    function renderError($error)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/error.tpl');
    }
    function renderHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
    function renderChapterInfo($chapter, $director, $logged = null, $idUser = null, $rol = null)
    {
        $this->smarty->assign('chapters', $chapter);
        $this->smarty->assign('director', $director);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('idUser', $idUser);
        $this->smarty->assign('rol', $rol);
        $this->smarty->display('templates/chapterInfo.tpl');
    }
    function renderChaptersByDirector($director, $chapters)
    {
        $this->smarty->assign('chapters', $chapters);
        $this->smarty->assign('director', $director);
        $this->smarty->assign('fromDirectors', 0);
        $this->smarty->assign('fromChapters', 1);
        $this->smarty->display('templates/chaptersByDirector.tpl');
    }
}
