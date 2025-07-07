<?php 

use Alura\Mvc\Repository\VideoRepository;

$path = __DIR__ ."/banco.sqlite";
$pdo = new PDO("sqlite:" . $path);

$id = $_GET['id'];

$repository = new VideoRepository($pdo);
$repository->remove($id);

header('Location: /?success=1');
