<?php

namespace components\database;

use \PDO;
abstract class BaseDB
{

    protected $dbObj = null;

    /**
     * @param null $dbObj
     */
    public function __construct($dsn, $user, $password, $charset)
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $charset,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->dbObj = new PDO($dsn, $user, $password, $options);
    }


    protected function executeStatement($stmt, $params = null, $isSelect = false)
    {
        try {
            if ($params) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }
        } catch (\PDOException $e) {
            throw $e;
        }

        if ($isSelect) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return true;
    }
}