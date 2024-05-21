<?php

use app\core\Application;
use app\core\Response;

function dd($object, $kill = true)
{
    echo '<meta http-equiv="Content-Type" content="text/html" charset="utf-8" /><pre style="text-align: left;">';
    print_r($object);
    echo '</pre><br />';
    if ($kill) {
        die('END');
    }
    return ($object);
}

if (! function_exists('app')) {

    function app(): Application
    {
        return Application::$app;
    }
}
if (! function_exists('response')) {

    function response(): Response
    {
        return app()->response;
    }
}
