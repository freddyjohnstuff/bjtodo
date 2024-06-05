<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'lib/constants.php';
include 'lib/loader.php';
include 'getconfig.php';

use \components\application\Application;

$config = include 'config.php';
$application  = new Application($config);
$application->runApp();
$application->echoApp();