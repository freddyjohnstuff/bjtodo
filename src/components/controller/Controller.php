<?php

namespace components\controller;

class Controller
{

    /** @var string */
    protected  $layout = 'main';

    /** @var string */
    protected  $viewPath;


    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }


    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function setContentType($type = null) {

        switch ($type) {
            case 'json' :
                header('Content-Type: application/json; charset=utf-8');
                break;
            default:
                break;
        }
    }

    /**
     * @param $path
     * @param $params
     * @return bool
     */
    public function render($path, $params = []) {
        
        if(!empty($params)) {
            extract($params);
        }

        if (!isset($title)) {
            $title = $params['title'] ?? '';
        }
        ob_start();
        include $path;
        $response = ob_get_contents();
        ob_end_clean();
        return $this->applyLayout($response, $title);
    }

    public function applyLayout($content, $title = null) {
        ob_start();
        include BASE_DIR . 'src/views/layouts/' .  $this->layout . '.php';
        $response = ob_get_contents();
        ob_end_clean();
        return$response;
    }

}