<?php

namespace PopularPosts;

use PopularPosts\Controllers\Single;

Class App {
    
    // Plugin name
    static $name = 'Popular posts';
    // Plugin path
    static $path = WP_PLUGIN_DIR . '/popular-posts';

    public function __construct() {
        require_once(self::$path . '/app/helpers.php');

        // Controllers
       new Single;
    }

}
