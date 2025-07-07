<?php 

declare(strict_types=1);

namespace Alura\Mvc\Controller;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class VideoListController
{
    public function __construct(private VideoRepository $videoRepository)
    {

    }
    public function processaRequisicao()
    {
        $videos = $this->videoRepository->all();

    }
}