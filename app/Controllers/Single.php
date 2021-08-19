<?php

namespace PopularPosts\Controllers;

Class Single {
	
	public function __construct() {
        add_action('wp_head', array($this, 'trackViews'), 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }
    
    /**
     * trackViews Track view to set count
     *
     * @param  int $post_id The post id. Empty is current post
     * @return void
     */
    function trackViews(int $post_id = 0): void {
        if(!is_singular('post')) 
            return;
         
        if(empty($post_id))
            $post_id = get_the_ID();  
         
        set_post_view($post_id);
    }

}