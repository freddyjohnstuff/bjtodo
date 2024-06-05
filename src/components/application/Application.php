<?php

namespace components\application;

use components\config\Configuration;

class Application
{

    /**
     * @var array
     */
    private $config;
    private $response;
    public function __construct($config)
    {
        $this->config = $config;
        Configuration::getInstance()->setBulk($this->config);
        Configuration::getInstance()->set('app', $this);
    }

    public function runApp() {

        /*echo '<pre>';print_r($_SERVER);die;*/
        Route::start();
        $controller = Route::getController();
        /*$controllerPath =  BASE_DIR .'src/controllers/' . ucfirst($controller) . '.php';*/
        $controllerClass =  'controllers\\' . ucfirst($controller);

        /*var_dump(class_exists($controllerClass));*/
        if(class_exists($controllerClass)) {
            $action = Route::getAction();
            $actionMethod = 'action' . ucfirst($action);
            if(method_exists($controllerClass, $actionMethod)) {
                $controllerClassObj = new $controllerClass();

                /*$controllerClassObj->setLayout($controller);*/
                $viewTemplate = BASE_DIR . 'src/views/' . lcfirst($controller) . '/' . $action . '.php';
                if(file_exists($viewTemplate)) {
                    $controllerClassObj->setViewPath($viewTemplate);
                }

                $this->response = $controllerClassObj->$actionMethod();

            } else {
                Route::ErrorPage404();
            }

        } else {
            Route::ErrorPage404();
        }
    }

    public function echoApp(){
        print  $this->response;
    }

}