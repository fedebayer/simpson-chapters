<?php
require_once "./Model/DirectorModel.php";
require_once "./View/DirectorView.php";
require_once "./Helpers/AuthHelper.php";

class DirectorController
{
    private $model;
    private $view;
    private $authHelper;

    public function __construct()
    {
        $this->model = new DirectorModel();
        $this->view = new DirectorView();
        $this->authHelper = new AuthHelper();
    }
    public function showDirectores()
    {
        $this->authHelper->checkLoggedIn();
        $directors = $this->model->getDirectors();
        $this->view->renderDirectors($directors);
    }
    function createDirector()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['biografia']) || empty($_POST['biografia'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->addDirector($_POST['nombre'], ($_POST['biografia']));
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
            los capitulos pertenecientes a este director");;
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
        $this->view->renderDirectors($directors, $id);
    }
    function updateDirector($id)
    {
        if (!isset($_POST['nombreNuevo']) || empty($_POST['nombreNuevo']) || !isset($_POST['biografiaNueva']) || empty($_POST['biografiaNueva'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->updateDirectorFromDB($id, $_POST['nombreNuevo'], $_POST['biografiaNueva']);
        $this->view->renderHomeLocation();
    }
    function viewDirectorInfo($id)
    {
        $this->authHelper->checkLoggedIn();
        $director = $this->model->getDirector($id);
        $this->view->renderDirectorInfo($director);
    }
    public function showDirectorChapters()
    {
        if (!isset($_POST['directorABuscar']) || empty($_POST['directorABuscar'])) {
            $this->view->renderError("Error! director no especificado");
            return;
        }
        $director = $_POST['directorABuscar'];
        $chapters = $this->model->getChaptersByDirector($director);
        $this->view->renderDirectorChapters($director, $chapters);
    }
    public function showListDirectorsByCategory($category)
    {
        $this->authHelper->checkLoggedIn();
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
