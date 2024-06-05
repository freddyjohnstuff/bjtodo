<?php

namespace controllers;

use components\controller\Controller;

class Error extends Controller
{

    public function actionIndex()
    {
        return $this->render($this->viewPath);
    }

    public function action404()
    {
        return $this->render($this->viewPath);
    }

    public function action403()
    {
        return $this->render($this->viewPath);
    }




}