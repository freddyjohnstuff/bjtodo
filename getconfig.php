<?php

$file = '.config';
if(file_exists($file)) {
    $_data = file_get_contents($file);
    if(!empty($_data)) {
        $_data2 = explode("\n", $_data);
        foreach ($_data2 as $item) {
            if(!empty(trim($item))) {
                if(strpos($item, '=') > 3) {
                    $_define = explode('=', $item );
                    define(trim($_define[0]), trim($_define[1]));
                }
            }
        }
    }
} else {
    throw new Exception('Config file not defined');
}
