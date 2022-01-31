<?php

declare(strict_types=1);

namespace App\Controller;

require_once("AbstractController.php");

use App\Exception\NotFoundException;

class ArticleController extends AbstractController
{
    public function createAction(): void
    {
        if ($this->request->hasPost()) {
            $this->NoteModel->createArticle([
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            header('Location: /?before=created');
        }
        $this->view->render(
            'create',);
    }

    public function listAction(): void
    {
        $this->view->render(
            'list',
            [
                'notes' => $this->NoteModel->getArtilces(),
                'before' => $this->request->getParam('before'),
                'error' => $this->request->getParam('error')
            ]
        );
    }

    public function showAction(): void
    {
        $this->view->render(
            'show',
            ['note' => $this->getArticles()]
        );
    }

    public function editAction(): void
    {
        $note = $this->getArticles();
        $this->view->render(
            'edit',
            ['note' => $this->getArticles()]
        );

    }

    protected function redirect(string $to, array $params): void
    {
        $location = $to;

        if (count($params)) {
            $queryParams = [];
            foreach ($params as $key => $value) {
                $queryParams[] = urlencode($key) . '=' . urlencode($value);
            }
            $queryParams = implode('&', $queryParams);
            $location .= '?' . $queryParams;
        }

        header("Location: $location");
        exit;
    }

    private function action(): string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }

    public function deleteAction(): void
    {
        if ($this->request->isPost()) {
            $id = (int)$this->request->postParam('id');
            $this->NoteModel->deleteArticle($id);
            $this->redirect('/', ['before' => 'deleted']);
        }
        $note = $this->getArticles();
        $this->view->render(
            'delete',
            ['note' => $this->getArticles()]
        );
    }

    final private function getArticles(): array
    {
        $noteID = (int)$this->request->getParam('id');
        if (!$noteID) {
            $this->redirect('/', ['error' => 'MissingArticleId']);
            exit;
        }
        try {
            $note = $this->NoteModel->getArticle($noteID);
        } catch (NotFoundException $e) {
            header('Location /?error=articleNotFound');
            exit;
        }
        return $note;
    }
}
