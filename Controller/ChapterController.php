<?php
require_once "./Model/ChapterModel.php";
require_once "./View/ChapterView.php";
require_once "./Controller/screenwritersController.php";
require_once "./Controller/DirectorController.php";
require_once "./Controller/LoginController.php";
require_once "./Helpers/AuthHelper.php";

class ChapterController
{
    private $model;
    private $view;
    private $screenwritersController;
    private $directorsController;
    private $authHelper;
    private $logged;
    private $loginController;
    private $rol;

    public function __construct()
    {
        $this->model = new ChapterModel();
        $this->view = new ChapterView();
        $this->screenwritersController = new ScreenwritersController();
        $this->directorsController = new DirectorController();
        $this->authHelper = new AuthHelper();
        $this->logged = false;
        $this->loginController = new LoginController();
        $this->rol = $this->loginController->getRol()->rol;

    }
    public function showHome($currentPage)
    {
        $this->logged = $this->authHelper->isLogged();
        $screenwriters = $this->screenwritersController->getScreenwriters();
        $directors = $this->directorsController->getDirectors();
        $this->renderChapters($currentPage, $directors, $screenwriters, $this->rol, $this->logged, null);
    }
    function createChapter()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['temporada']) || empty($_POST['temporada']) || !isset($_POST['estreno']) || empty($_POST['estreno']) || !isset($_POST['gag']) || empty($_POST['gag']) || !isset($_POST['id_director']) || empty($_POST['id_director']) || !isset($_POST['screenwriters']) || empty($_POST['screenwriters'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nombre'];
            $temporada = $_POST['temporada'];
            $estreno = $_POST['estreno'];
            $gag = $_POST['gag'];
            $id_director = $_POST['id_director'];
            $screenwriters = $_POST['screenwriters'];
        }
        $id = $this->model->addChapter($nombre, $temporada, $estreno, $gag, $id_director);
        $this->view->renderHomeLocation();
        $this->screenwritersController->addRelation($screenwriters, $id);
    }
    function deleteChapter($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a eliminar no especificado");
            return;
        }
        $this->screenwritersController->deleteRelation($id);
        $this->model->deleteChapterFromDB($id);
        $this->view->renderHomeLocation();
    }
    function editChapter($id, $currentPage)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a editar no especificado");
            return;
        }
        $directors = $this->directorsController->getDirectors();
        $screenwriters = $this->screenwritersController->getScreenwriters();
        $this->renderChapters($currentPage,$directors, $screenwriters, $this->rol, null, $id);
    }
    function updateChapter($id)
    { 
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['temporada']) || empty($_POST['temporada']) || !isset($_POST['estreno']) || empty($_POST['estreno']) || !isset($_POST['gag']) || empty($_POST['gag']) || !isset($_POST['id_director']) || empty($_POST['id_director']) || !isset($_POST['screenwriters']) || empty($_POST['screenwriters'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        else{
            $nombre = $_POST['nombre'];
            $temporada = $_POST['temporada'];
            $estreno = $_POST['estreno'];
            $gag = $_POST['gag'];
            $id_director = $_POST['id_director'];
            $screenwriters = $_POST['screenwriters'];
        }
        
        $this->model->updateChapterFromDB($id, $nombre, $temporada, $estreno, $gag, $id_director);
        $this->screenwritersController->editRelations($id, $screenwriters);
        $this->view->renderHomeLocation();
    }
    function viewChapterInfo($id, $director)
    {
        $this->logged = $this->authHelper->isLogged();
        $chapter = $this->model->getChapter($id);
        $this->view->renderChapterInfo($chapter, $director, $this->logged);
    }
    public function showChaptersByDirector()
    {
        $director = $_POST['directorABuscar'];
        if (!isset($director) || empty($director)) {
            $this->view->renderError("Error! director no especificado");
            return;
        }
        $chapters = $this->model->getChaptersByDirector($director);
        $this->view->renderChaptersByDirector($director, $chapters);
    }
    public function showListByCategory($category)
    {
        $chapters = $this->model->getListByCategory($category);
        $screenwriters = $this->screenwritersController->getScreenwriters();
        $directors = $this->directorsController->getDirectors();
        //$this->view->renderChapters($chapters, $directors, $screenwriters, $this->rol);
    }

    function showLoginLocation()
    {
        header("Location: " . BASE_URL . "login");
    }

    function renderChapters($currentPage, $directors, $screenwriters, $rol, $logged, $id){
        if($currentPage == null){
            $currentPage = 1;
        }
        $size = 3;
        $pages = ceil((count($this->model->getAllChapters())) / $size);
        if($currentPage > $pages){
            header("Location: " . BASE_URL . "home");
        }
        $beginning = ($currentPage - 1) * $size;
        $chapters = $this->model->getChapters($beginning, $size);
        $this->view->renderChapters($chapters, $directors, $screenwriters, $rol, $pages, $currentPage, $logged, $id);
    }
}
