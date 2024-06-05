<?php

namespace components\application;

use components\config\Configuration;
use components\database\BaseDB;

class SeedDatabase extends BaseDB
{
    public function __construct()
    {
        parent::__construct(
            Configuration::getInstance()->get('dsn'),
            Configuration::getInstance()->get('user'),
            Configuration::getInstance()->get('password'),
            Configuration::getInstance()->get('charset')
        );
    }


    public function run(){

    }



}
