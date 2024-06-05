<?php

namespace models;

use components\config\Configuration;
use components\database\BaseDB;
use \PDO;
use \PDOException;

class TaskDB extends BaseDB
{

    public static $_tableName = 'tasks';
    public static $fields = [
        'id',
        'name',
        'email',
        'task',
        'created_at',
        'status',
        'deleted',
    ];

    public static $validate = [
        'name' => ['required', 'naming'],
        'email' =>['required', 'email'],
        'task' => ['required', 'text'],
    ];


    public function __construct()
    {

        parent::__construct(
            Configuration::getInstance()->get('dsn'),
            Configuration::getInstance()->get('username'),
            Configuration::getInstance()->get('password'),
            Configuration::getInstance()->get('charset')
        );

    }

    public static function validate($data) {
        $valid = true;
        if (empty($data)) {
            $valid = $valid && false;
        }

        foreach (self::$validate as $field => $rules) {
            foreach ($rules as $rule) {
                switch ($rule) {
                    case 'required' :
                        $valid = isset($data[$field]);
                        break;
                    case 'naming' :
                    case 'text' :
                        $valid = !empty($data[$field]) && (strlen($data[$field]) > 3);
                        break;
                    case 'email' :
                        $valid = !empty($data[$field]) && filter_var($data[$field], FILTER_VALIDATE_EMAIL);
                        break;
                }
            }
        }
        return $valid;
    }

    public function getCount()
    {
        $stmt = $this->dbObj->prepare('SELECT COUNT(`id`) as cnt FROM ' . self::$_tableName .' WHERE `deleted` = 0');
        return parent::executeStatement($stmt,null,true);
    }


    public function getList(
        $select = [],
        $conditions = [],
        $order = null,
        $limit = null
    )
    {

        $conditions = array_merge($conditions, ['deleted' => 0]);
        $sql = [];
        $sql[] = 'SELECT ';
        if(empty($select)) {
            $sql[] = '*';
        } else {
            $fldSql = [];
            foreach ($select as $field) {
                if(array_search($field, static::$fields) !== false) {
                    $fldSql[] = sprintf('`%s`', $field);
                }
            }
            $sql[] = implode(',', $fldSql);
        }

        $sql[] = ' FROM ' . static::$_tableName;

        if(!empty($conditions)) {
            $fldSql = [];
            foreach ($conditions as $key => $value) {
                if(array_search($key, static::$fields)) {
                    $fldSql[] = sprintf("`%s`='%s'" , $key, $value);
                }
            }
            $sql[] = (!empty($fldSql)) ? ' WHERE ' . implode(' AND ', $fldSql) : '';
        }

        if(!empty($order)) {
            $fldSql = [];
            foreach ($order as $key => $value) {
                if(array_search($key, static::$fields)) {
                    $fldSql[] = sprintf("`%s` %s " , $key, $value);
                }
            }
            $sql[] = (!empty($fldSql)) ? ' ORDER BY ' . implode(',', $fldSql) : '';
        }
        if(!empty($limit)) {
            $sql[] = sprintf(' LIMIT %d, %d', $limit[0], $limit[1]);
        }

        $stmt = $this->dbObj->prepare(implode(' ', $sql));
        $data = parent::executeStatement($stmt,[],true);
        if($data) {
            return $this->wrap($data);
        } else {
            return [];
        }

    }

    public function getOne($id)
    {
        $sql = "SELECT `id`, `name`, `email`, `task`,  `status` FROM `tasks` WHERE `id` = ?";
        $stmt = $this->dbObj->prepare($sql);
        return parent::executeStatement($stmt,[$id],true);
    }

    public function create($data)
    {
        $insertSQL = "INSERT INTO `tasks` (`name`, `email`, `task` ) VALUES (:name, :email, :task)";
        $stmt = $this->dbObj->prepare($insertSQL);
        try {
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindValue(':task', $data['task'], PDO::PARAM_STR);
            $this->executeStatement($stmt);

        } catch (PDOException $e) {
            throw new \HttpException($e->getMessage());
        }
    }

    public  function update($data, $id)
    {
        $updateSql = "UPDATE `tasks` SET `name` = :name, `email` = :email, `task` = :task, `status` = :status WHERE `tasks`.`id` = :id;";
        $stmt = $this->dbObj->prepare($updateSql);
        try {
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindValue(':task', $data['task'], PDO::PARAM_STR);
            $stmt->bindValue(':status', $data['status'], PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $this->executeStatement($stmt);
            return array('error' => false);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        $updateSql = "UPDATE `tasks` SET `tasks`.`deleted` = 1 WHERE `tasks`.`id` = :id;";
        $stmt = $this->dbObj->prepare($updateSql);
        try {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $this->executeStatement($stmt);
            return array('error' => false);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    private function wrap($data){

        $newData = [];
        foreach ($data as$item) {
            $_class = new Task();
            $_class->id = $item['id'];
            $_class->name = $item['name'];
            $_class->email = $item['email'];
            $_class->task = $item['task'];
            $_class->status = Status::getStatus($item['status']);
            $newData[] = $_class;
        }
        return $newData;
    }
}