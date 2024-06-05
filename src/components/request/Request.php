<?php
namespace components\request;

class Request
{

    private static ?Request $instance = null;

    /**
     * @return Request
     */
    public static function getInstance(): Request
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

    private function clear($Arr) {
        if(!empty($Arr)) {
            $newArr = [];
            foreach ($Arr as $key => $item) {
               if(is_array($item)) {
                   $newArr[$key] = $this->clear($item);
               } else {
                   $newArr[$key] = strip_tags($item);
               }
            }
            return $newArr;
        }

        return $Arr;
    }

    private function _request($Arr, $key = null, $default = null) {

        if(empty($Arr))
        {
            return $default;
        }

        if(is_null($key)) {
            return $Arr;
        }

        return $Arr[$key] ?? $default;
    }

    public function get($key = null, $default = null) {
        $Arr = $this->clear($_GET);
        return ($this->_request($Arr, $key, $default));
    }
    public function post($key = null, $default = null) {
        $Arr = $this->clear($_POST);
        return $this->_request($Arr, $key, $default);
    }


}