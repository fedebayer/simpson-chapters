<?php
class CommentModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }

    function getAll()
    {
        $query = $this->db->prepare('SELECT a.*,b.*, c.email FROM comentario a LEFT JOIN capitulo b ON a.id_capitulo = b.id_capitulo LEFT JOIN usuario c ON a.id_usuario = c.id_usuario');
        $query->execute();
        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }
    function save($comentarios, $puntuacion, $id_capitulo, $id_usuario)
    {
        $query = $this->db->prepare('INSERT INTO comentario(comentarios, puntuacion, id_capitulo, id_usuario) VALUES (?,?,?,?)');
        $query->execute(array($comentarios, $puntuacion, $id_capitulo, $id_usuario));
        return $this->db->lastInsertId();
    }
    function delete($id)
    {
        $query = $this->db->prepare('DELETE FROM comentario WHERE id_comentario=?');
        $query->execute(array($id));
    }
    function update($id, $comentarios, $puntuacion, $id_capitulo, $id_usuario)
    {
        $query = $this->db->prepare("UPDATE comentario SET comentarios= ?, puntuacion= ?, id_capitulo= ?, id_usuario= ? WHERE id_comentario=?");
        $query->execute(array($comentarios, $puntuacion, $id_capitulo, $id_usuario, $id));
    }
    function get($id)
    {
        $query = $this->db->prepare("SELECT * FROM comentario WHERE id_comentario= ?");
        $query->execute(array($id));
        $comentario = $query->fetch(PDO::FETCH_OBJ);
        return $comentario;
    }
    function getCommentsByChapterId($id_capitulo)
    {
        $query = $this->db->prepare('SELECT a.*,b.*, c.email FROM comentario a LEFT JOIN capitulo b ON a.id_capitulo = b.id_capitulo LEFT JOIN usuario c ON a.id_usuario = c.id_usuario WHERE a.id_capitulo = ?');
        $query->execute(array($id_capitulo));
        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    function getCommentsByChapterIdAndPuntuacion($id_capitulo, $puntuacion)
    {
        $query = $this->db->prepare('SELECT a.*,b.*, c.email FROM comentario a LEFT JOIN capitulo b ON a.id_capitulo = b.id_capitulo LEFT JOIN usuario c ON a.id_usuario = c.id_usuario WHERE a.id_capitulo = ? AND a.puntuacion = ?');
        $query->execute(array($id_capitulo, $puntuacion));
        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }
}
