<?php
class ChapterModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }
    function getChapters($beggining, $size)
    {
        $queryString = "SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, GROUP_CONCAT(g.id_guionista) AS id_guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) RIGHT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director GROUP BY c.id_capitulo LIMIT $beggining,$size";
        $query = $this->db->prepare($queryString);
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function getAllChapters()
    {
        $queryString = "SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, GROUP_CONCAT(g.id_guionista) AS id_guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) RIGHT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director GROUP BY c.id_capitulo";
        $query = $this->db->prepare($queryString);
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function addChapter($nombre, $temporada, $estreno, $gag, $id_director, $imagen = null)
    {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);
        $query = $this->db->prepare('INSERT INTO capitulo(nombre, temporada, estreno, gag, id_director, imagen) VALUES (?,?,?,?,?,?)');
        $query->execute(array($nombre, $temporada, $estreno, $gag, $id_director, $pathImg));
        return $this->db->lastInsertId();
    }
    private function uploadImage($image)
    {
        $target = "img/chapters/" . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
    function deleteChapterFromDB($id)
    {
        $query = $this->db->prepare('DELETE FROM capitulo WHERE id_capitulo=?');
        $query->execute(array($id));
    }
    function updateChapterFromDB($id, $nombre, $temporada, $estreno, $gag, $id_director, $imagen = null)
    {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);
        $query = $this->db->prepare("UPDATE capitulo SET nombre= ?, temporada= ?, estreno= ?, gag= ?, id_director= ?, imagen= ? WHERE id_capitulo=?");
        $query->execute(array($nombre, $temporada, $estreno, $gag, $id_director, $pathImg, $id));
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

    function getListBySearch($nombre = null, $temporada = null, $estreno = null, $director = null, $guionista = null)
    {
        $sql = "SELECT c.*, GROUP_CONCAT(g.nombre) AS guionistas, GROUP_CONCAT(g.id_guionista) AS id_guionistas, d.nombre_director AS director FROM ( ( guionista_de_x_capitulo AS r RIGHT JOIN capitulo AS c ON c.id_capitulo = r.id_capitulo ), director d) LEFT JOIN guionista AS g ON g.id_guionista = r.id_guionista AND d.id_director = c.id_director";
        if ($nombre != null)
            $sql .= " WHERE LOWER(c.nombre) LIKE LOWER ('%$nombre%')";
        if ($temporada != null)
            $sql .= " AND LOWER(c.temporada) LIKE LOWER('%$temporada%')";
        if ($estreno != null)
            $sql .= " AND LOWER(c.estreno) LIKE LOWER('%$estreno%')";
        if ($director != null)
            $sql .= " AND LOWER(d.nombre_director) LIKE LOWER('%$director%')";
        if ($guionista != null)
            $sql .= " AND LOWER(g.nombre) LIKE LOWER('%$guionista%')";
        $sql .= " GROUP BY c.id_capitulo";
        $query = $this->db->prepare($sql);
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
}
