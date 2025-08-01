<?php require_once __DIR__ . '/inicio-html.php' ?>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videos as $video): ?>
        <li class="videos__item">
            <?php if($video->getFilePath() !== null): ?>
                <a href="<?= $video->url  ?>"><img src="/img/uploads/<?= $video->getFilePath(); ?>" style="width:100%" alt=""></a>
            <?php else: ?>
            <iframe width="100%" height="72%" src="<?= $video->url  ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <?php endif; ?>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $video->title ?></h3>
                <div class="acoes-video">
                    <a href="<?= '/editar-video?id=' . $video->id ?>">Editar</a>
                    <?php if($video->getFilePath() !== null): ?>
                        <a href="<?= '/deletar-thumb?id=' . $video->id ?>">Deletar Thumb</a>
                    <?php endif; ?>
                    <a href="<?= '/remover-video?id=' . $video->id ?>">Excluir</a>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

<?php require_once __DIR__ . '/fim-html.php';