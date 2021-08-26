<?php

namespace PopularPosts\Helpers;

use PopularPosts\App;

Class Options {

    /**
     * Storage plugin options
     * @var $options array 
     */
    private static $options = array();
            
    /**
     * get Get option by key
     *
     * @param  mixed $key The option key
     * @return mixed Option value
     */
    public static function get(string $key) {
        if(empty(self::$options))
            self::$options = \get_option(App::$domain);

        if(self::$options == false)
            self::$options = array();
        if(empty($key) || !array_key_exists($key, self::$options))
            return '';

        return self::$options[$key];
    }

}