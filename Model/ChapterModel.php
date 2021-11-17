<?php
class ChapterModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }
    function getChapters()
    {
        $query = $this->db->prepare('SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, GROUP_CONCAT(g.id_guionista) AS id_guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) RIGHT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director GROUP BY c.id_capitulo');
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function addChapter($nombre, $temporada, $estreno, $gag, $id_director)
    {
        $query = $this->db->prepare('INSERT INTO capitulo(nombre, temporada, estreno, gag, id_director) VALUES (?,?,?,?,?)');
        $query->execute(array($nombre, $temporada, $estreno, $gag, $id_director));
        return $this->db->lastInsertId();
    }
    function deleteChapterFromDB($id)
    {
        $query = $this->db->prepare('DELETE FROM capitulo WHERE id_capitulo=?');
        $query->execute(array($id));
    }
    function updateChapterFromDB($id, $nombre, $temporada, $estreno, $gag, $id_director)
    {
        $query = $this->db->prepare("UPDATE capitulo SET nombre= ?, temporada= ?, estreno= ?, gag= ?, id_director= ? WHERE id_capitulo=?");
        $query->execute(array($nombre, $temporada, $estreno, $gag, $id_director, $id));
    }
    function getChapter($id)
    {
        $query = $this->db->prepare("SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) LEFT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director GROUP BY c.id_capitulo HAVING c.id_capitulo = (?)");
        $query->execute(array($id));
        $chapter = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapter;
    }
    function getChaptersByDirector($director)
    {
        $query = $this->db->prepare('SELECT a.*, b.* FROM capitulo a RIGHT JOIN director b ON a.id_director = b.id_director WHERE b.nombre_director = ?');
        $query->execute([$director]);
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function getListByCategory($category)
    {
        $query = $this->db->prepare('SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, GROUP_CONCAT(g.id_guionista) AS id_guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) LEFT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director GROUP BY c.id_capitulo ORDER BY ' . $category . '');
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
}
