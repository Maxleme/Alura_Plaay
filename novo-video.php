<?php 

$path = __DIR__ ."/banco.sqlite";
$pdo = new PDO("sqlite:" . $path);


$url = filter_input(INPUT_POST,"url", FILTER_SANITIZE_URL);
if($url === false) {
    header("Location:index.php?sucesso=0");
    exit();
}
$title = filter_input(INPUT_POST, "titulo");
if($title === false) {
    header("Location:index.php?sucesso=0");
    exit();
}

$statement = $pdo->prepare("INSERT INTO videos ( url, title) VALUES (?, ?)");
$statement->bindValue(1, $url);
$statement->bindValue(2, $title);

if($statement->execute() == false) {
    header('Location: /index.php?success=0');
} else {
    header('Location: /index.php?success=1');
}