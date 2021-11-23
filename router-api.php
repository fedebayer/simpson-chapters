<?php
require_once 'libs/Router.php';
require_once 'api/apiCommentController.php';

// CONSTANTES PARA RUTEO
define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . '/');

// creo el router
$router = new Router();

// tabla de ruteo
$router->addRoute(
    'capitulos/:ID_CAPITULO/comentarios/puntaje/:VALOR',
    'GET',
    'ApiCommentController',
    'getCommentsByChapterIdAndPuntuacion'
);
$router->addRoute('capitulos/comentarios', 'GET', 'ApiCommentController', 'getAll');
$router->addRoute('capitulos/:ID_CAPITULO/comentarios/puntuacion/:TYPE', 'GET', 'ApiCommentController', 'orderByScore');
$router->addRoute('capitulos/:ID_CAPITULO/comentarios/fecha/:TYPE', 'GET', 'ApiCommentController', 'orderByDate');
$router->addRoute('capitulos/:ID_CAPITULO/comentarios', 'GET', 'ApiCommentController', 'getCommentsByChapterId');
$router->addRoute('capitulos/comentarios/:ID', 'GET', 'ApiCommentController', 'getOne');
$router->addRoute('capitulos/comentarios/:ID', 'DELETE', 'ApiCommentController', 'remove');
$router->addRoute('capitulos/comentarios', "POST", 'ApiCommentController', 'addComment');
$router->addRoute('capitulos/comentarios/:ID', "PUT", 'ApiCommentController', 'updateComment');



// rutea
$resource = $_GET['resource'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);
