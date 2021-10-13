<?php
include_once('./Model/screenwritersModel.php');
include_once('./View/screenwritersView.php');
require_once "./Helpers/AuthHelper.php";

class ScreenwritersController
{

    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new ScreenwritersModel;
        $this->view = new ScreenwritersView;
        $this->authHelper = new AuthHelper();
    }

    function home()
    {
        $this->authHelper->checkLoggedIn();
        $screenwriters = $this->model->getScreenwriters();
        $this->view->home($screenwriters);
    }

    function loadScreenwriters()
    {
        $this->authHelper->checkLoggedIn();
        $table =
            '<table id="tableScreenwriter">
                <tr>
                    <th></th>
                    <th>Guionista</th>
                </tr>';

        $screenwriters = $this->model->getScreenwriters();

        foreach ($screenwriters as $screenwriter) {
            $table .=  '<tr> <td><input type = "checkbox" data-entry = "' . $screenwriter->id_guionista . '" class = "status"></td>
                                    <td>' . $screenwriter->nombre . '</td>
                                    <td> <input type="button" data-entry = "' . $screenwriter->id_guionista . '" data-name = "' . $screenwriter->nombre . '" value = "Editar" class = "btnEdit"> </td>
                                </tr>';
        }
        $table .= '</table>';

        echo $table;
    }

    function addScreenwriter($name)
    {
        if (!isset($name) || empty($name)) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->addScreenwriter($name);
        $this->home();
    }

    function getChaptersOfScreenwritter($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!isset($id) || empty($id)) {
            $this->view->renderError("Error! guionista no especificado");
            return;
        }
        $this->authHelper->checkLoggedIn();
        $data = $this->model->getChaptersOfScreenwritter($id);
        $this->view->loadChaptersOfScreenwritter($data);
    }

    function updateScreenwritter($id)
    {
        if (!isset($_POST['nombreNuevo']) || empty($_POST['nombreNuevo'])) {
            $this->view->renderError("Error! contenido de celdas no especificado");
            return;
        }
        $this->model->editScreenwritterDb($id, $_POST['nombreNuevo']);
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
        $this->view->home($screenwriters, $id);
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
    function showLoginLocation()
    {
        header("Location: " . BASE_URL . "login");
    }
}
