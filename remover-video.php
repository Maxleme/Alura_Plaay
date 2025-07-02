<?php 

$path = __DIR__ ."/banco.sqlite";
$pdo = new PDO("sqlite:" . $path);

$id = $_GET['id'];

$statement = $pdo->prepare('DELETE FROM videos WHERE id = ?');
$statement->bindValue(1, $id);
$statement->execute();


header('Location: /?success=1');
