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

    public function __construct() {
        require_once('helpers.php');
        add_action('init', array($this, 'loadTextdomain'));

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
        load_plugin_textdomain(self::$domain, false, self::$domain . '/languages'); 

        if(!is_textdomain_loaded(self::$domain))
            load_textdomain(self::$domain, dirname(__FILE__) .  '/../languages/popular-posts-pt_BR.mo');
    }

}