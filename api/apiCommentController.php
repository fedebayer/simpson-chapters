<?php
require_once("./Model/commentModel.php");
require_once("./api/apiView.php");

class ApiCommentController
{

    private $model;
    private $view;
    private $data;

    public function __construct()
    {
        $this->model = new CommentModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    public function  getCommentsByChapterId($params = null)
    {
        $capituloId = $params[':ID_CAPITULO'];
        $comentarios = $this->model->getCommentsByChapterId($capituloId);
        $this->view->response($comentarios, 200);
    }

    public function  getAll($params = null)
    {
        $comentarios = $this->model->getAll();
        $this->view->response($comentarios, 200);
    }

    public function  orderByScore($params = null){
        $id = $params[':ID_CAPITULO'];
        $type = $params[':TYPE'];
        if($type == ""){
            $comentarios = $this->model->getBy($id, "puntuacion", "DESC");
        }
        if($type == "DESC"){
            $comentarios = $this->model->getBy($id, "puntuacion", "DESC");
        }
        if($type == "ASC"){
            $comentarios = $this->model->getBy($id, "puntuacion", "ASC");
        }
        
        $this->view->response($comentarios, 200);
    }

    public function  orderByDate($params = null){
        $id = $params[':ID_CAPITULO'];
        $type = $params[':TYPE'];
        if($type == ""){
            $comentarios = $this->model->getBy($id, "fecha", "DESC");
        }
        if($type == "DESC"){
            $comentarios = $this->model->getBy($id, "fecha", "DESC");
        }
        if($type == "ASC"){
            $comentarios = $this->model->getBy($id, "fecha", "ASC");
        }
        
        $this->view->response($comentarios, 200);
    }

    public function getOne($params = null)
    {
        $id = $params[':ID'];
        $comentario = $this->model->get($id);
        if ($comentario)
            $this->view->response($comentario, 200);
        else
            $this->view->response("El comentario con el id={$id} no existe", 404);
    }

    public function remove($params = null)
    {
        $id = $params[':ID'];
        $comentario = $this->model->get($id);
        if ($comentario) {
            $this->model->delete($id);
            $this->view->response("El comentario fue borrado con exito.", 200);
        } else
            $this->view->response("El comentario con el id={$id} no existe", 404);
    }

    public function addComment($params = null)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $data = $this->getData();
        $comentarios = $data->comentarios;
        $puntuacion = $data->puntuacion;
        $id_capitulo = $data->id_capitulo;
        $id_usuario = $data->id_usuario;
        $mydate = getdate(date("U"));
        $fecha = "$mydate[year]-$mydate[mon]-$mydate[mday]";
        if (!isset($comentarios) || empty($comentarios) || !isset($puntuacion) || empty($puntuacion) || !isset($id_capitulo) || empty($id_capitulo) || !isset($id_usuario) || empty($id_usuario)) {
            $this->view->response("Error! contenido de celdas no especificado", 400);
            return;
        }
        $id = $this->model->save($comentarios, $puntuacion, $id_capitulo, $id_usuario, $fecha);
        $comentario = $this->model->get($id);
        if ($comentario)
            $this->view->response($comentario, 200);
        else
            $this->view->response("El comentario no fue creado", 500);
    }
/*
    public function updateComment($params = null)
    {
        $id = $params[':ID'];
        $data = $this->getData();
        $comentarios = $data->comentarios;
        $puntuacion = $data->puntuacion;
        $id_capitulo = $data->id_capitulo;
        $id_usuario = $data->id_usuario;
        if (!isset($comentarios) || empty($comentarios) || !isset($puntuacion) || empty($puntuacion) || !isset($id_capitulo) || empty($id_capitulo) || !isset($id_usuario) || empty($id_usuario)) {
            $this->view->response("Error! contenido de celdas no especificado", 400);
            return;
        }
        $comentario = $this->model->get($id);
        if ($comentario) {
            $this->model->update($id, $comentarios, $puntuacion, $id_capitulo, $id_usuario);
            $this->view->response("El comentario fue modificado con exito.", 200);
        } else
            $this->view->response("El comentario con el id={$id} no existe", 404);
    }*/
}
