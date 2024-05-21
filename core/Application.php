<?php

namespace app\core;


use app\libs\HttpStatusCodes;
use Exception;


class Application
{
    public static Application $app;
    public Request $request;
    public Response $response;
    public Router $router;

    public  array $config;
    /**
     * @var mixed|string
     */
    private string $defaultRoute;

    public function __construct()
    {
        $this->setConfig();

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
        self::$app = $this;

    }



    public function run(): void
    {
        try {
            echo $this->router->resolve();

        } catch (Exception $e) {
            $this->showError($e->getMessage());
        }
    }

    private function setConfig() :void
    {
        $this->config = include __DIR__ . '/../config/config.php';
    }


    private function showError($message): void
    {
        $data = [
            "message"=>$message
        ];

        $this->response->ApiResponse($data,HttpStatusCodes::HTTP_BAD_REQUEST);

    }


}