<?php

namespace PopularPosts\Controllers\Admin;

use PopularPosts\App;

Class Posts {
	
	public function __construct() {
        add_filter('manage_posts_columns',              array($this, 'columnHead'));
        add_filter('manage_posts_custom_column',        array($this, 'columnContent'), 10, 2);
        add_filter('manage_edit-post_sortable_columns', array($this, 'columnSort'));
        add_filter('request',                           array($this, 'columnOrderby'));
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

    function columnSort($columns) {
        $columns[App::$domain . '_views'] = App::$domain . '_views';

        return $columns;
    }

    function columnOrderby($vars) {
        if(!isset($vars['orderby']) || (isset($vars['orderby']) && App::$domain . '_views' == $vars['orderby'])):
            $vars = array_merge($vars, array(
                'meta_key' => 'views_count',
                'orderby'  => 'meta_value',
            ));
        endif;

        return $vars;
    }

}