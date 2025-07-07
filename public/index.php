<?php 

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

/** @var \Alura\Mvc\Controller\Controller $controller */
use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    NewVideoController,
    VideoFormController,
    VideoListController
};
use Alura\Mvc\Repository\VideoRepository;

$path = __DIR__ ."/../banco.sqlite";
$pdo = new PDO("sqlite:" . $path);
$videoRepository = new VideoRepository($pdo);

if(!array_key_exists("PATH_INFO", $_SERVER) || $_SERVER["PATH_INFO"] === '/') {
    $controller = new VideoListController($videoRepository);
    $controller->processaRequisicao();
}elseif($_SERVER['PATH_INFO'] === '/novo-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewVideoController($videoRepository);
    }
}elseif($_SERVER['PATH_INFO'] === '/editar-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditVideoController($videoRepository);
    }
}elseif($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new DeleteVideoController($videoRepository);
}else {
    $controller = new Error404Controller();
}