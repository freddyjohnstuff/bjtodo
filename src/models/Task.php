<?php

namespace models;

use components\config\Configuration;
use components\database\BaseDB;
use components\database\Model;
use components\i7e\ModelInterface;


class Task
{
    public $id;
    public $name;
    public $email;
    public $task;
    public $created_at;
    public $status;
    public $deleted;

}