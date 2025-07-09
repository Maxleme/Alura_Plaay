<?php

declare(strict_types= 1);

$dbPath = __DIR__ ."/banco.sqlite";

$pdo = new PDO("sqlite:$dbPath");


$sql = 'UPDATE videos SET title = :title WHERE id = 4;';
$stm = $pdo->prepare($sql);
$stm->bindValue(':title', 'asfujhv' );
$stm->execute();
