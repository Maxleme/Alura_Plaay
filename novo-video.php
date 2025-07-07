<?php 

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

$path = __DIR__ ."/banco.sqlite";
$pdo = new PDO("sqlite:" . $path);


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

if($repository->add(new Video($url, $title)) == false) {
    header('Location: /?success=0');
} else {
    header('Location: /?success=1');
}