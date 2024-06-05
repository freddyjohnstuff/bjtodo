<?php

namespace components\user;

class User
{

    public static $validate = [
        'login' => ['required', 'login'],
        'password' =>['required', 'password'],
    ];

    private static ?User $instance = null;

    /**
     * @return User
     */
    public static function getInstance(): User
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*
     * multiple construct, clone, wakeup,
     */
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}


    public function validate($data)
    {
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
                    case 'login' :
                    case 'password' :
                        $valid = !empty($data[$field]) && (strlen($data[$field]) >=3);
                        break;
                }
            }
        }
        return $valid;
    }

    public function login($data)
    {
        $this->logout();
        global $_SESSION;
        if (!isset($_SESSION['logedin'])) {
            // todo Make User manager foe work with database
            if($data['login'] == 'admin' && md5($data['password']) =='202cb962ac59075b964b07152d234b70') {
                $_SESSION['logedin'] = 'loged-in=' . time();
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        global $_SESSION;
        unset( $_SESSION['logedin']);
    }

    public function isLogedIn()
    {
        global $_SESSION;
        return isset($_SESSION['logedin']);
    }

}