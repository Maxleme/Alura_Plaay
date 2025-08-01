<?php

declare(strict_types= 1);

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {

    }

    public function add(Video $video): bool
    {
        $sql = "INSERT INTO videos ( url, title, image_path) VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $statement->bindValue(3, $video->getFilePath());

        $result = $statement->execute();
        
        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));

        return $result;
    }

    public function remove(int $id): bool
    {
        $sql = "DELETE FROM videos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        return $statement->execute();
    }

    public function update(Video $video): bool
    {
        $updateImageSql = '';
        if($video->getFilePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE videos SET 
                    url = :url, 
                    title = :title 
                    $updateImageSql 
                    WHERE id = :id;";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        if($video->getFilePath() !== null){
            $statement->bindValue(':image_path', $video->getFilePath());
        }
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function all(): array
    {
        $sql = "SELECT * FROM videos";
        $videos = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(
            $this->hydrateVideo(...),
            $videos
        );
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        
        return $this->hydrateVideo($statement->fetch(PDO::FETCH_ASSOC));
    }

    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);        
        if($videoData['image_path'] !== null){
            $video->setFilePath($videoData['image_path']);
        }       

        return $video;
    }

    public function deleteThumb(Video $video): bool
    {
        unlink(__DIR__ . "/../../public/img/uploads/" . $video->getFilePath());
        $sql = "UPDATE videos SET image_path = :image_path WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':image_path', null);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);
        return $statement->execute();
    }
}