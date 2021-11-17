<?php
require_once "./Model/ChapterModel.php";
require_once "./View/ChapterView.php";
require_once "./Controller/screenwritersController.php";
require_once "./Controller/DirectorController.php";
require_once "./Helpers/AuthHelper.php";

class ChapterController
{
    private $model;
    private $view;
    private $screenwritersController;
    private $directorsController;
    private $authHelper;
    private $logged;

    public function __construct()
    {
        $this->model = new ChapterModel();
        $this->view = new ChapterView();
        $this->screenwritersController = new ScreenwritersController();
        $this->directorsController = new DirectorController();
        $this->authHelper = new AuthHelper();
        $this->logged = false;
    }
    public function showHome()
    {
        $this->logged = $this->authHelper->isLogged();
        $chapters = $this->model->getChapters();
        $screenwriters = $this->sliceScreenwriters($chapters);
        $directors = $this->directorsController->getDirectors();
        $this->view->renderChapters($chapters, $directors, $screenwriters, $this->logged);
    }
    function createChapter()
    {
        $nombre = $_POST['nombre'];
        $temporada = $_POST['temporada'];
        $estreno = $_POST['estreno'];
        $gag = $_POST['gag'];
        $id_director = $_POST['id_director'];
        $screenwriters = $_POST['screenwriters'];
        if (!isset($nombre) || empty($nombre) || !isset($temporada) || empty($temporada) || !isset($estreno) || empty($estreno) || !isset($gag) || empty($gag) || !isset($id_director) || empty($id_director) || !isset($screenwriters) || empty($screenwriters)) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
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
    function editChapter($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! contenido a editar no especificado");
            return;
        }
        $chapters = $this->model->getChapters();
        $directors = $this->directorsController->getDirectors();
        $screenwriters = $this->screenwritersController->getScreenwriters();
        $this->view->renderChapters($chapters, $directors, $screenwriters, null, $id);
    }
    function updateChapter($id)
    {
        $nombre = $_POST['nombre'];
        $temporada = $_POST['temporada'];
        $estreno = $_POST['estreno'];
        $gag = $_POST['gag'];
        $id_director = $_POST['id_director'];
        $screenwriters = $_POST['screenwriters'];
        if (!isset($nombre) || empty($nombre) || !isset($temporada) || empty($temporada) || !isset($estreno) || empty($estreno) || !isset($gag) || empty($gag) || !isset($id_director) || empty($id_director) || !isset($screenwriters) || empty($screenwriters)) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
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
        $screenwriters = $this->sliceScreenwriters($chapters);
        $directors = $this->directorsController->getDirectors();
        $this->view->renderChapters($chapters, $directors, $screenwriters);
    }

    public function sliceScreenwriters($chapters)
    {
        $screenwriters = [];
        $finalNames = [];
        $finalIds = [];
        foreach ($chapters as $chapter) {
            $names = explode(",", $chapter->guionistas);
            $ids = explode(",", $chapter->id_guionistas);

            for ($i = 0; $i < count($ids); $i++) {
                if (in_array($ids[$i], $finalNames)) {
                } else {
                    array_push($finalNames, $names[$i]);
                    array_push($finalIds, $ids[$i]);
                    $newScreenwriter = array('idScreenwriter' => $ids[$i], 'screenwriterName' => $names[$i]);
                    array_push($screenwriters, $newScreenwriter);
                }
            }
        }

        return $screenwriters;
    }
    function showLoginLocation()
    {
        header("Location: " . BASE_URL . "login");
    }
}
