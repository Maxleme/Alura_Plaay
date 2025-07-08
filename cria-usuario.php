<?php

declare(strict_types= 1);

$dbPath = __DIR__ ."/banco.sqlite";

$pdo = new PDO("sqlite:$dbPath");

$email = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
$stm = $pdo->prepare($sql);
$stm->bindValue(1, $email);
$stm->bindValue(2, $hash);
$stm->execute();
