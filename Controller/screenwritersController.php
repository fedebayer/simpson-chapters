<?php
include_once('./Model/screenwritersModel.php');
include_once('./View/screenwritersView.php');
require_once "./Helpers/AuthHelper.php";

class ScreenwritersController
{

    private $model;
    private $view;
    private $authHelper;
    private $logged;

    function __construct()
    {
        $this->model = new ScreenwritersModel;
        $this->view = new ScreenwritersView;
        $this->authHelper = new AuthHelper();
        $this->logged = false;
    }

    function home()
    {
        $this->logged = $this->authHelper->isLogged();
        $screenwriters = $this->model->getScreenwriters();
        $this->view->home($screenwriters, $this->logged);
    }

    function addScreenwriter()
    {
        if (!isset($_POST['nameScreenwriter']) || empty($_POST['nameScreenwriter'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nameScreenwriter'];
        }
        $this->model->addScreenwriter($nombre);
        $this->home();
    }

    function getChaptersOfScreenwritter($id)
    {
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! guionista no especificado");
            return;
        }
        else{
            $data = $this->model->getChaptersOfScreenwritter($id);
            $this->view->loadChaptersOfScreenwritter($data);
            return $data;
        }
    }

    function updateScreenwritter($id)
    {
        if (!isset($_POST['nameScreenwriter']) || empty($_POST['nameScreenwriter'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nameScreenwriter'];
        }
        $this->model->editScreenwritterDb($id, $nombre);
        $this->home();
    }

    function editScreenwritter($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a editar no especificado");
            return;
        }
        $screenwriters = $this->model->getScreenwriters();
        $this->view->home($screenwriters, null, $id);
    }

    function deleteScreenwriter($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a eliminar no especificado");
            return;
        }
        try {
            $this->model->deleteScreenwriter($id);
            $this->home();
        } catch (Exception) {
            return $this->view->renderError("Error! primero se necesita borrar
            los capitulos pertenecientes a este guionista");
        }
    }

    function addRelation($screenwriters, $id)
    {
        foreach ($screenwriters as $screenwriter) {
            $this->model->addRelation($screenwriter, $id);
        }
    }

    function deleteRelation($id)
    {
        $this->model->deleteRelation($id);
    }

    function getScreenwriters()
    {
        $data = $this->model->getScreenwriters();
        return $data;
    }

    function editRelations($id, $screenwriters)
    {
        $this->model->deleteRelation($id);
        foreach ($screenwriters as $screenwriter) {
            $this->model->addRelation($screenwriter, $id);
        }
    }

    function showLoginLocation()
    {
        header("Location: " . BASE_URL . "login");
    }
}
