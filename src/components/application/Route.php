<?php

namespace components\application;

use components\config\Configuration;

class Route
{
    private static $controllerDefault = 'Main';
    private static $actionDefault = 'index';
    private static $queryParams = [];

    /**
     * @return string
     */
    public static function getController()
    {
        return self::$controllerDefault;
    }

    /**
     * @return string
     */
    public static function getAction()
    {
        return self::$actionDefault;
    }

    /**
     * @param $default
     * @return int
     */
    public static function getPage($default)
    {
        return self::$queryParams['page'] ?? $default;
    }


    /**
     * @return void
     */
    public static function start()
    {

        $urlpath = Configuration::getInstance()->get('urlpath');
        $request_uri = $_SERVER['REQUEST_URI'];
        $request_uri = str_replace([$urlpath . '/', $urlpath], '', $request_uri);
        $routes = explode('/', $request_uri);
        // получаем имя контроллера
        if (!empty($routes[1]) )
        {
            self::$controllerDefault = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            self::$actionDefault = $routes[2];
        }

        $queryParams = strip_tags($_SERVER['QUERY_STRING']);
        if(!empty($queryParams)) {
            $params = explode('&', $queryParams);
            foreach ($params as $piar) {
                $paramspiarArr = explode('=', $piar);
                self::$queryParams[stripslashes($paramspiarArr[0])] = $paramspiarArr[1];
            }
        }

    }

    public static function ErrorPage404()
    {
        $host = '//'.$_SERVER['HTTP_HOST'].'/' . Configuration::getInstance()->get('urlpath') . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'error/404');
    }

    public static function ErrorPage403()
    {
        $host = '//'.$_SERVER['HTTP_HOST'] . '/' . Configuration::getInstance()->get('urlpath') . '/';
        header('HTTP/1.1 403 Forbidden');
        header("Status: 403 Forbidden");
        header('Location:'.$host.'error/403');
    }
}