<?php

namespace PopularPosts\Controllers\Admin;

use PopularPosts\App;

Class Posts {
	
	public function __construct() {
        add_filter('manage_posts_columns', array($this, 'columnHead'));
        add_filter('manage_posts_custom_column', array($this, 'columnContent'), 10, 2);
    }
        
    /**
     * columnHead
     *
     * @param  array $columns
     * @return array
     */
    function columnHead(array $columns): array {
        $columns[App::$domain . '_views'] = __('Views', App::$domain);
    
        return $columns;
    }
    
    /**
     * columnContent
     *
     * @param  string $columnName
     * @param  int $postID
     * @return void
     */
    function columnContent(string $columnName, int $postID): void {
        if($columnName !== App::$domain . '_views') 
            return;
    
        echo get_post_views($postID);
    }

}