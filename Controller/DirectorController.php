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
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['biografia']) || empty($_POST['biografia'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nombre'];
            $biografia = $_POST['biografia'];
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
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['biografia']) || empty($_POST['biografia'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nombre'];
            $biografia = $_POST['biografia'];
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
        if (!isset($_POST['directorABuscar']) || empty($_POST['directorABuscar'])) {
            $this->view->renderError("Error! director no especificado");
            return;
        }
        else{
            $director = $_POST['directorABuscar'];
        }
        $chapters = $this->model->getChaptersByDirector($director);
        $this->view->renderDirectorChapters($director, $chapters);
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
