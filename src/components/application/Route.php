<?php

namespace components\application;

use components\config\Configuration;

class Route
{
    private static $controllerDefault = 'Main';
    private static $actionDefault = 'index';

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