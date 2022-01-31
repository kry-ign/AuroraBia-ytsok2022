<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;
use App\Model\NoteModel;
use App\Request;
use App\Exception\ConfigurationException;

abstract class AbstractController
{
    protected const DEFAULT_ACTION = 'list';

    protected static array $configuration = [];

    protected NoteModel $database;
    protected Request $request;
    protected View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    /**
     * @throws ConfigurationException
     * @throws Exception\StorageException
     */
    public function __construct(Request $request)
    {
        if (empty(self::$configuration['db'])) {
            throw new ConfigurationException('Configuration error');
        }
        $this->database = new NoteModel(self::$configuration['db']);

        $this->request = $request;
        $this->view = new View();
    }

    public function run(): void
    {
        $action = $this->action() . 'Action';

        if (!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION . 'Action';
        }
        $this->$action();
    }

    private function action(): string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}