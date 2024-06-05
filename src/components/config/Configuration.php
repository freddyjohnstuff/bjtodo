<?php

namespace components\config;


class Configuration
{
    /** @var array  */
    public $config = [];

    private static ?Configuration $instance = null;

    /**
     * @return Configuration
     */
    public static function getInstance(): Configuration
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*
     * multiple construct, clone, wakeup,
     */
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}


    /**
     * @param $arrayData
     * @return void
     */
    public function setBulk($arrayData) {
        if(!empty($arrayData)) {
            foreach ($arrayData as $key => $value) {
                $this->set($key, $value);
            }
        }
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value) {
        if(!$this->get($key)){
            $this->config[$key] = $value;
        }
    }

    /**
     * @param $key
     * @return false|mixed
     */
    public function get($key) {
        return $this->config[$key] ?? false;
    }

}