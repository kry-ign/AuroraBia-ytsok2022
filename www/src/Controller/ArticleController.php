<?php

declare(strict_types=1);

namespace App\Controller;

require_once("AbstractController.php");

use App\Exception\NotFoundException;

class  extends AbstractController
{
    public function createAction()
    {
        if ($this->request->hasPost()) {
            $this->database->createArticle([
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            header('Location: /?before=created');
        }
        $this->view->render(
            'create',
            [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
    }

    public function listAction()
    {
        $this->view->render(
            'list',
            [
                'notes' => $this->database->getArtilces(),
                'before' => $this->request->getParam('before'),
                'error' => $this->request->getParam('error')
            ]
            );
    }

    public function showAction()
    {
        $noteId = (int)$this->request->getParam('id');
        if (!$noteId) {
            header('Location /?error=missingArticleId');
            exit;
        }
        try {
            $note = $this->database->getArticle($noteId);
        } catch (NotFoundException $e) {
            header('Location /?error=articleNotFound');
            exit;
        } catch (Exception\StorageException $e) {
        }
        $this->view->render(
            'show',
            ['note' => $note]
        );
    }

}
