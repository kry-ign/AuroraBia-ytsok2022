<?php

declare(strict_types=1);

namespace App;

spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

require_once("src/Utils/debug.php");
$configuration = require_once("config/config.php");

use App\Controller\ArticleController;
use App\Controller\AbstractController;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

$request = new Request($_GET, $_POST, $_SERVER);

try {
    AbstractController::initConfiguration($configuration);
    (new ArticleController($request))->run();
} catch (ConfigurationException $e) {
    dump($e);
    echo 'Wystąpił problem w aplikacji';
    echo 'Proszę o kontakt z adminem';
} catch (AppException $e) {
    echo 'wystapil blad w aplikacji AppException';
    echo $e->getMessage();
    dump($e);
} catch (Throwable $e) {
    dump($e);
    echo 'wystapil blad w aplikacji Thorable';
}
