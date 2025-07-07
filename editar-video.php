<?php 

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbPath = dirname(__FILE__) ."/banco.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET,"id", FILTER_VALIDATE_INT);


$url = filter_input(INPUT_POST,"url", FILTER_SANITIZE_URL);
if($url === false) {
    header("Location: /?sucesso=0");
    exit();
}
$title = filter_input(INPUT_POST, "titulo");
if($title === false) {
    header("Location: /?sucesso=0");
    exit();
}

$repository = new VideoRepository($pdo);
$video = new Video($url, $title);
$video->setId($id);

if($repository->update($video) === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}