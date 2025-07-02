<?php 

    $path = __DIR__ ."/banco.sqlite";
    $pdo = new PDO("sqlite:" . $path);

    $id_editar = filter_input(INPUT_GET, 'id',  FILTER_VALIDATE_INT);
    
  
    $video = [
        'url' => '',
        'title' => ''
    ];

    if (!empty($id_editar) || is_numeric($id_editar)) {
        $sql = 'SELECT * FROM videos WHERE id = ?';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $id_editar, PDO::PARAM_INT);
        $statement->execute();

        $video = $statement->fetch(PDO::FETCH_ASSOC);
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos-form.css">
    <link rel="stylesheet" href="../css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav class="cabecalho">
            <a class="logo" href="/"></a>

            <div class="cabecalho__icones">
                <a href="formulario.php" class="cabecalho__videos"></a>
                <a href="../pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <main class="container">

        <form class="container__formulario" action="<?= empty($id_editar) ? 'novo-video.php' : 'editar-video.php?id=' . $id_editar; ?>" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" class="campo__escrita" required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' value="<?= $video['url'] ?>"/>
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' value="<?= $video['title'] ?>" />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>

</body>

</html>