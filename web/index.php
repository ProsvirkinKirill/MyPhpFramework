<?php

use vendor\core\Router;

$url = rtrim($_SERVER["QUERY_STRING"], '/');

define("WWW", __DIR__);
define("CORE", dirname(__DIR__) . 'vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT', 'default');
define("DEBUG", 1);

require "../vendor/libs/functions.php";

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . ".php";
    if (file_exists($file)) {
        require_once "$file";
    }
});

new \vendor\core\App();

// Пользовательские контроллеры
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// Дефолтные контроллеры
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


Router::dispatch($url);









