<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Exception/StorageException.php");
require_once("src/Exception/ConfigurationException.php");
require_once("src/Exception/NotFoundException.php");

use App\Exception\NotFoundException;
use App\Exception\StorageException;
use Throwable;
use PDO;

class Database extends AbstractModel
{


    public function getArticle(int $id): array
    {
        try {
            $query = "
            SELECT * FROM notes WHERE id = $id
        ";
            $result = $this->conn->query($query);
            $note = $result->fetch(PDO::FETCH_ASSOC);


        } catch (Throwable $e) {
            throw new StorageException('error article');
        }
        if (empty($note)) {
            throw new NotFoundException('Article id: $id not exist');
        }

        return $note;
    }

    public function getArtilces(): array
    {
        try {
            $query = "
            SELECT id, title, status FROM notes
        ";
            $result = $this->conn->query($query,);
            $notes = $result->fetchAll(PDO::FETCH_ASSOC);

            return $notes;
        } catch (Throwable $e) {
            new StorageException('Not found article', 400, $e);
        }

    }

    public function deleteArticle(int $id): void
    {
        try {
            $query = " 
            DELETE FROM notes
            WHERE id = $id
            LIMIT 1
        ";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            throw new StorageException('delete error', 400);
        }
    }

    public function editArticle(int $id, array $data): void
    {
        try {
            $title = $this->conn->quote($data['title']);
            $description = $this->conn->quote($data['description']);

            $query = " 
                UPDATE notes
                SET title = $title, description = $description
                WHERE id = $id
            ";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            throw new StorageException('error edit', 400);
        }
    }

    public function createArticle(array $data): void
    {
        try {
            $title = $this->conn->quote($data['title']);
            $description = $this->conn->quote($data['description']);
            $created = $this->conn->quote(date('Y-m-d H:i:s'));

            $query = "
                    INSERT INTO notes(title, description, status) 
                    VALUES($title, $description, $created) 
                    ";
            $this->conn->exec($query);

        } catch (Throwable $e) {
            throw new StorageException('Nie udało się utworzyć artykułu', 400, $e);
        }

    }

}