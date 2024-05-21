<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\core\Application;


include __DIR__ . '/../helper/Tools.php';

try {

    return new Application();

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}