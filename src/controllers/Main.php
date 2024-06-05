<?php

namespace controllers;

use components\application\Route;
use components\config\Configuration;
use components\controller\Controller;
use components\request\Request;
use components\user\User;
use models\Status;
use models\TaskDB;

class Main extends Controller
{
    private $taskManager;

    /**
     * @param $taskManager
     */
    public function __construct()
    {
        $this->taskManager = new TaskDB();
    }


    public function actionIndex()
    {
        $perpage = 3;
        $OrderParam = ['created_at' => 'DESC'];

        $order = Request::getInstance()->get('order');
        $direct = Request::getInstance()->get('direct');

        if ($order && $direct) {
            $OrderParam = [$order => $direct];
        }

        $page = Request::getInstance()->get('page', 1);

        $offset = (intval($page) - 1) * $perpage;
        $countData = $this->taskManager->getCount();
        $count = intval($countData[0]['cnt']);

        $totalPages = intdiv($count, $perpage) + ((($count % $perpage) > 0) ? 1 : 0);

        $data = $this->taskManager->getList(
            ['id', 'name', 'email', 'task', 'status'],
            [],
            $OrderParam,
            [$offset, $perpage]
        );

        return $this->render(
            $this->viewPath,
            [
                'data' => $data,
                'page' => $page,
                'totalPages' => $totalPages,
                'statuses' => Status::getStatuses()
            ]
        );
    }


    public function actionCreate()
    {
        $message = '';
        $post = Request::getInstance()->post();
        if ($post) {
            if (TaskDB::validate($post)) {
                $this->taskManager->create($post);
                $message = 'Task created!';
                $post = [];
            }
        }
        return $this->render($this->viewPath, ['form' => $post, 'message' => $message]);
    }

    public function actionUpdate()
    {
        global $_SESSION;
        if (!User::getInstance()->isLogedIn()) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/login/index");
        }

        $id = Request::getInstance()->get('id');
        if (!$id) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/error/404");
        }

        $data = $this->taskManager->getOne(intval($id));
        if (empty($data)) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/error/404");
        }


        $message = '';
        $post = Request::getInstance()->post();
        if ($post) {
            if (TaskDB::validate($post)) {
                $this->taskManager->update($post, $id);
                $_SESSION['flash']['success'][] = 'Task updated!';
                $post = [];
                header("Location: /" . Configuration::getInstance()->get('urlpath') . "/main/index");
            }
        } else {
            $post = $data[0];
        }
        return $this->render(
            $this->viewPath,
            [
                'id' => $id,
                'form' => $post,
                'message' => $message
            ]
        );
    }


    public function actionDelete()
    {
        global $_SESSION;
        if (!User::getInstance()->isLogedIn()) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/login/index");
        }

        $id = Request::getInstance()->post('id');
        if (!$id) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/error/404");
        }

        $data = $this->taskManager->getOne(intval($id));
        if (empty($data)) {
            header("Location: /" . Configuration::getInstance()->get('urlpath') . "/error/404");
        }

        $this->taskManager->delete($id);
        $_SESSION['flash']['success'][] = 'Task deleted!';
        header("Location: /" . Configuration::getInstance()->get('urlpath') . "/main/index");

    }


}