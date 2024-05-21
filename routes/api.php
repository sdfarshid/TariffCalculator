<?php


use app\controllers\Compare;
use app\core\Router;

return static function (Router $router) {

    $router->get('/compare', [Compare::class]);
    $router->get('/', [Compare::class,"help"]);

};
