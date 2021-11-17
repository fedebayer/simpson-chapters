<?php
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

require_once "Controller/ChapterController.php";
require_once "Controller/DirectorController.php";
require_once "Controller/screenwritersController.php";
require_once "Controller/LoginController.php";

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}
$params = explode('/', $action);

$chapterController = new chapterController();
$directorController = new directorController();
$screenwritersController = new ScreenwritersController;
$loginController = new LoginController();

switch ($params[0]) {
    case 'login':
        $loginController->login();
        break;
    case 'logout':
        $loginController->logout();
        break;
    case 'signUp':
        $loginController->signUpLoad();
        break;
    case 'signUpAction':
        $loginController->signUp();
        break;
    case 'verify':
        $loginController->verifyLogin();
        break;
    case 'home':
        $chapterController->showHome();
        break;
    case 'createChapter':
        $chapterController->createChapter();
        break;
    case 'deleteChapter':
        $chapterController->deleteChapter($params[1]);
        break;
    case 'goToUpdateChapter':
        $chapterController->editChapter($params[1]);
        break;
    case 'updateChapter':
        $chapterController->updateChapter($params[1]);
        break;
    case 'viewChapterInfo':
        $chapterController->viewChapterInfo($params[1], $params[2]);
        break;
    case 'searchChaptersOfDirector':
        $chapterController->showChaptersByDirector();
        break;
    case 'listByCategory':
        $chapterController->showListByCategory($params[1]);
        break;
        //Parte de directores
    case 'directores':
        $directorController->showDirectores();
        break;
    case 'createDirector':
        $directorController->createDirector();
        break;
    case 'deleteDirector':
        $directorController->deleteDirector($params[1]);
        break;
    case 'goToUpdateDirector':
        $directorController->editDirector($params[1]);
        break;
    case 'updateDirector':
        $directorController->updateDirector($params[1]);
        break;
    case 'viewDirectorInfo':
        $directorController->viewDirectorInfo($params[1]);
        break;
    case 'searchDirectorChapters':
        $directorController->showDirectorChapters();
        break;
    case 'listDirectorsByCategory':
        $directorController->showListDirectorsByCategory($params[1]);
        break;
        //Parte de guionistas
    case 'guionistas':
        $screenwritersController->home();
        break;
    case 'addScreenwriter':
        $screenwritersController->addScreenwriter($_POST['nameScreenwriter']);
        break;
    case 'getChaptersOfScreenwritter':
        $screenwritersController->getChaptersOfScreenwritter($params[1]);
        break;
    case 'goToUpdateScreenwriter':
        $screenwritersController->editScreenwritter($params[1]);
        break;
    case 'editScreenwritter':
        $screenwritersController->updateScreenwritter($params[1]);
        break;
    case 'deleteScreenwriter':
        $screenwritersController->deleteScreenwriter($params[1]);
        break;
    default:
        echo ('404 Page not found');
        break;
}
