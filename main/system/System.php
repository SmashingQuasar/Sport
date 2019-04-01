<?php

final class System
{
    static private $AutoloadDirectories = [];
    static private $ViewsDirectory = '../main/views/';

    private function __construct() {}

    static function autoload($class)
    {
        $filename = str_replace('\\', '/', $class);
        $filename = "{$filename}.php";

        foreach (self::$AutoloadDirectories as $path) {
            if (file_exists("{$path}{$filename}")) {
                require "{$path}{$filename}";
                break;
            }
        }
    }

    static function registerAutoloader()
    {
        $autoload_directories = file_get_contents('../main/resources/config/autoload_directories.json');
        $autoload_directories = json_decode($autoload_directories, true);

        self::$AutoloadDirectories = $autoload_directories['directories'];

        spl_autoload_register('self::autoload');
    }

    static function start()
    {
        self::registerAutoloader();

        $process = self::parseURI();
        $request = self::buildRequest($process['parameters']);

        $controller = new $process['controller']();
        
        $controller->setRequest($request);

        $controller->{$process['action']}();

        $controller->setView(self::$ViewsDirectory. "{$process['controller']}/{$process['view']}");

        $controller->render();
    }

    static function parseURI()
    {
        $URI = $_SERVER['REQUEST_URI'];

        $URI = explode('?', $URI);
        
        $URI = array_filter($URI);
        $URI = array_values($URI);

        $URI = $URI[0];

        $URI = explode('/', $URI);
        $URI = array_filter($URI);
        $URI = array_values($URI);

        if (empty($URI)) {
            $controller = 'Home';
            $view = 'default';
            $action = $view;
            $view .= '.php';
            $parameters = [];
        } else {
            
            $controller = ucfirst(array_shift($URI));
            $view = array_shift($URI);

            if (empty($view)) {
                $view = 'default';
            }

            $action = lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $view))));
            $view .= '.php';
            $parameters = $URI ?? [];
        }
        
        return [
            'controller' => $controller,
            'action' => $action,
            'view' => $view,
            'parameters' => $parameters
        ];
    }

    static function buildRequest($parameters)
    {
        $get = $_GET ?? [];
        $post = $_POST ?? [];
        $body = file_get_contents('php://input');

        $request = [
            'query' => $get,
            'request' => $post,
            'body' => $body,
            'parameters' => $parameters ?? []
        ];

        return $request;
    }
}
