<?php

namespace controllers;

use components\config\Configuration;
use components\controller\Controller;
use components\request\Request;
use components\user\User;

class Login extends Controller
{

    public function actionIndex()
    {
        $message = '';
        $post = Request::getInstance()->post();

        if (!empty($post)) {


            if (User::getInstance()->validate($post)) {
                if (User::getInstance()->login($post)) {
                    header("Location: /" . Configuration::getInstance()->get('urlpath') . "/main/index");
                } else {
                    $message = 'Incorrect Login or Password';
                }
            } else {
                $message = 'Please enter correct Login and Password';
            }
        }

        return $this->render(
            $this->viewPath,
            [
                'form' => $post,
                'message' => $message
            ]
        );
    }

    public function actionLogout()
    {
        User::getInstance()->logout();
        header("Location: /" . Configuration::getInstance()->get('urlpath') . "/main/index");
    }

    public function actionCheck()
    {
        $this->layout = 'empty';

        $this->setContentType('json');
        return $this->render(
            $this->viewPath,
            ['response' => json_encode(['check' => User::getInstance()->isLogedIn()])]
        );
    }


}