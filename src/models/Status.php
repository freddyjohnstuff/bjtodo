<?php

namespace models;

class Status
{
    public static $data = [
        0 => 'New',
        1 => 'Progress',
        2 => 'Done',
    ];
    public $id;
    public $name;

    public static function getStatuses() {

        $result = [];
        foreach (self::$data as $id => $name) {
            $_class = new self();
            $_class->id = $id;
            $_class->name = $name;
            $result[] = $_class;
        }
        return $result;
    }

    public static function getStatus($id) {

        $status = self::$data[$id] ?? null;
        if($status) {
            $_class = new self();
            $_class->id = $id;
            $_class->name = $status;
            return $_class;
        }

        return null;
    }

}