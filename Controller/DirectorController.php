<?php
require_once "./Model/DirectorModel.php";
require_once "./View/DirectorView.php";
require_once "./Helpers/AuthHelper.php";

class DirectorController
{
    private $model;
    private $view;
    private $authHelper;
    private $logged;

    public function __construct()
    {
        $this->model = new DirectorModel();
        $this->view = new DirectorView();
        $this->authHelper = new AuthHelper();
        $this->logged = false;
    }
    public function showDirectores()
    {
        $this->logged = $this->authHelper->isLogged();
        $directors = $this->model->getDirectors();
        $this->view->renderDirectors($directors, $this->logged);
    }
    function createDirector()
    {
        $nombre = $_POST['nombre'];
        $biografia = $_POST['biografia'];
        if (!isset($nombre) || empty($nombre) || !isset($biografia) || empty($biografia)) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->addDirector($nombre, ($biografia));
        $this->view->renderHomeLocation();
    }
    function deleteDirector($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a eliminar no especificado");
            return;
        }
        try {
            $this->model->deleteDirectorFromDB($id);
            $this->view->renderHomeLocation();
        } catch (Exception) {
            return $this->view->renderError("Error! primero se necesita borrar
            los capitulos pertenecientes a este director");
        }
    }
    function editDirector($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a editar no especificado");
            return;
        }
        $directors = $this->model->getDirectors();
        $this->view->renderDirectors($directors, null, $id);
    }
    function updateDirector($id)
    {
        $nombre = $_POST['nombre'];
        $biografia = $_POST['biografia'];
        if (!isset($nombre) || empty($nombre) || !isset($biografia) || empty($biografia)) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->updateDirectorFromDB($id, $nombre, $biografia);
        $this->view->renderHomeLocation();
    }
    function viewDirectorInfo($id)
    {
        $director = $this->model->getDirector($id);
        $this->view->renderDirectorInfo($director);
    }
    public function showDirectorChapters()
    {
        $director = $_POST['directorABuscar'];
        if (!isset($director) || empty($director)) {
            $this->view->renderError("Error! director no especificado");
            return;
        }
        $chapters = $this->model->getChaptersByDirector($director);
        $this->view->renderDirectorChapters($director, $chapters);
    }
    public function showListDirectorsByCategory($category)
    {
        $directors = $this->model->getListByCategory($category);
        $this->view->renderDirectors($directors);
    }

    public function getDirectors()
    {
        $directors = $this->model->getDirectors();
        return $directors;
    }
    function showLoginLocation()
    {
        header("Location: " . BASE_URL . "login");
    }
}
