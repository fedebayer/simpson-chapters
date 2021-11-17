<?php

class UserModel
{

    private $db;
    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }

    function getUser($email)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getUserFromId($id){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id_usuario = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getUsers(){
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    function addUser($email, $password){
        $query = $this->db->prepare('INSERT INTO usuario (`email`, `password`) VALUES (?,?)');
        $query->execute([$email, $password]);
    }

    function updatePrivileges($id, $rol){
        $query = $this->db->prepare("UPDATE usuario SET rol = ? WHERE id_usuario = ?");
        $query->execute(array($rol, $id));
    }

    function deleteUser($id){
        $query = $this->db->prepare('DELETE FROM usuario WHERE id_usuario = ?');
        $query->execute(array($id));
    }
}
