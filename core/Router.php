<?php
declare(strict_types=1);

namespace app\core;

use app\exception\NotFoundException;


class Router
{
    private Request $request;
    private array $routeMap = [];
    private string $method;

    /**
     * @var string
     */
    private string $currentUrl;

    public function __construct(Request $request )
    {
        $this->request = $request;
        $this->setMethod();

        $this->setRoutes();
        $this->setCurrentUrl();
    }
    private function setMethod(): void
    {
        $this->method = $this->request->getMethod();
    }
    private function setRoutes() :void
    {
        $webRoutes = include __DIR__ . '/../routes/api.php';
        $webRoutes($this);
    }



    public function get(string $url, $callback): void
    {
        $this->routeMap['get'][$url] = $callback;
    }
    public function post(string $url, $callback): void
    {
        $this->routeMap['post'][$url] = $callback;
    }




    private function setCurrentUrl() :void
    {
        $this->currentUrl = $this->request->getUrl();
    }



    /**
     * @throws NotFoundException
     */
    public function resolve()
    {
        $callback = $this->fetchCallback();
        return $callback($this->request);
    }

    /**
     * @throws NotFoundException
     */
    private function fetchCallback()
    {


        //Get the callback function for without parameters
        $callback = $this->routeMap[$this->method][$this->currentUrl] ?? false;

        if ($callback === false) {
            throw new NotFoundException();
        }
        if (is_array($callback)) {
            $controller = new $callback[0];
            $callback[1] = $callback[1] ?? 'index';
            $callback[0] = $controller;
        }
        return $callback ;
    }


}
