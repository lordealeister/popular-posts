<?php

namespace PopularPosts;

use PopularPosts\Controllers\Admin\Posts;
use PopularPosts\Controllers\Admin\Settings;
use PopularPosts\Controllers\Single;

Class App {
    
    // Plugin name
    static $name = 'Popular posts';
    // Plugin domain
    static $domain = 'popular-posts';
    // Plugin path
    static $path = WP_PLUGIN_DIR . '/popular-posts';

    public function __construct() {
        require_once(self::$path . '/app/helpers.php');
        \add_action('init', array($this, 'loadTextdomain'));

        // Controllers
        new Posts;
        new Settings;
        new Single;
    }

    /**
     * loadTextdomain Load languages
     *
     * @return void
     */
    function loadTextdomain(): void {
        \load_plugin_textdomain(self::$domain, false, self::$domain . '/languages'); 
    }

}
