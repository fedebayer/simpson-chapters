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
        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['temporada']) || empty($_POST['temporada']) || !isset($_POST['estreno']) || empty($_POST['estreno']) || !isset($_POST['gag']) || empty($_POST['gag']) || !isset($_POST['id_director']) || empty($_POST['id_director']) || !isset($_POST['screenwriters']) || empty($_POST['screenwriters'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $id = $this->model->addChapter($_POST['nombre'], $_POST['temporada'], $_POST['estreno'], $_POST['gag'], $_POST['id_director']);
        $this->view->renderHomeLocation();
        $this->screenwritersController->addRelation($_POST['screenwriters'], $id);
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
        if (!isset($_POST['nombreNuevo']) || empty($_POST['nombreNuevo']) || !isset($_POST['temporadaNueva']) || empty($_POST['temporadaNueva']) || !isset($_POST['estrenoNuevo']) || empty($_POST['estrenoNuevo']) || !isset($_POST['gagNuevo']) || empty($_POST['gagNuevo']) || !isset($_POST['id_directorNuevo']) || empty($_POST['id_directorNuevo']) || !isset($_POST['screenwriters']) || empty($_POST['screenwriters'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->updateChapterFromDB($id, $_POST['nombreNuevo'], $_POST['temporadaNueva'], $_POST['estrenoNuevo'], $_POST['gagNuevo'], $_POST['id_directorNuevo']);
        $this->screenwritersController->editRelations($id, $_POST['screenwriters']);
        $this->view->renderHomeLocation();
    }
    function viewChapterInfo($id, $director)
    {
        $chapter = $this->model->getChapter($id);
        $this->view->renderChapterInfo($chapter, $director);
    }
    public function showChaptersByDirector()
    {
        if (!isset($_POST['directorABuscar']) || empty($_POST['directorABuscar'])) {
            $this->view->renderError("Error! director no especificado");
            return;
        }
        $director = $_POST['directorABuscar'];
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
