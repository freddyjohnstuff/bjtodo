<?php

namespace components\view;

class Pagination
{
    private static $config = [];

    public static function set($config) {
        self::$config = $config;
    }

    public static function getPagination() {

        if(self::$config['totalPages'] > 1) {
            $pages = [];
            foreach (range(1, self::$config['totalPages']) as $i) {
                if(self::$config['page'] == $i) {
                    $pages[] = sprintf('<b>%d</b>', $i);
                } else {
                    $pages[] = sprintf(
                        '<a href="%s/?page=%d">%d</a>',
                        self::$config['url'] ?? '',
                        $i,
                        $i);
                }
            }
            return sprintf('<div class="pagination">%s</div>',  implode('&nbsp;', $pages));
        }
        return '';
    }

}