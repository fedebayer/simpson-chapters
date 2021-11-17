<?php

class ScreenwritersModel
{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }

    function getScreenwriters()
    {
        $dbs = $this->db;
        $query = $dbs->prepare('SELECT * FROM guionista');
        $query->execute();
        $screenwriter = $query->fetchAll(PDO::FETCH_OBJ);
        return $screenwriter;
    }

    function getChaptersOfScreenwritter($id)
    {
        $sql = "SELECT g.nombre AS guionista, c.nombre AS capitulo, c.temporada AS temporada FROM 
            ( guionista_de_x_capitulo AS r INNER JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ) 
            INNER JOIN guionista AS g ON g.id_guionista = r.id_guionista WHERE g.id_guionista = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($id));
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return json_encode($chapters);
    }

    function addScreenwriter($screenwriter)
    {
        $query = $this->db->prepare("INSERT INTO guionista (nombre) VALUES (?)");
        $query->execute(array($screenwriter));
    }

    function editScreenwritterDb($id, $name)
    {
        $query = $this->db->prepare("UPDATE guionista SET nombre = ? WHERE id_guionista = ?");
        $query->execute(array($name, $id));
    }


    function deleteScreenwriter($value){
        $query = $this->db->prepare("DELETE FROM guionista WHERE id_guionista = ?");
        $query->execute(array($value));
    }
    
    function getLastId(){
        return $this->db->lastInsertId();
    }

    function addRelation($screenwriter, $chapter){
        $screenwriter = intval($screenwriter);
        $chapter = intval($chapter);
        $query = $this->db->prepare("INSERT INTO guionista_de_x_capitulo (id_guionista, id_capitulo) VALUES (?, ?)");
        $query->execute(array($screenwriter, $chapter));
    }

    function deleteRelation($chapter){
        $chapter = intval($chapter);
        $query = $this->db->prepare("DELETE FROM guionista_de_x_capitulo WHERE guionista_de_x_capitulo.id_capitulo = ?");
        $query->execute(array($chapter));
    }
}
