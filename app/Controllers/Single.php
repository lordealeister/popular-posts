<?php

namespace PopularPosts\Controllers;

use PopularPosts\App;
use PopularPosts\Helpers\Options;

Class Single {
	
	public function __construct() {
        if(empty(Options::get('ajax_track'))):
            add_action('wp', array($this, 'trackViews'), 10, 0);
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        else:
            add_action('wp_ajax_' . App::$domain . '/track_view', array($this, 'trackViews'), 10, 0);
            add_action('wp_ajax_nopriv_' . App::$domain . '/track_view', array($this, 'trackViews'), 10, 0);
            add_action('wp_enqueue_scripts', array($this, 'enqueueAssets'));
        endif;
    }
    
    /**
     * trackViews Track view to set count
     *
     * @param  int $post_id The post id. Empty is current post
     * @return void
     */
    function trackViews(int $post_id = 0): void {
        if(wp_doing_ajax()):
            $post_id = $_POST['id'];
        else:
            if(!is_singular('post')) 
                return;
            
            if(empty($post_id))
                $post_id = get_the_ID();
        endif;
         
        if(!empty($post_id))
            set_post_view($post_id);        
    }

    /**
     * enqueueAssets Enqueue frontend assets
     *
     * @return void
     */
    function enqueueAssets(): void {
        \wp_enqueue_script(App::$domain, plugins_url('../../assets/scripts/popular-posts-track.js', __FILE__), [], null, false);

        \wp_localize_script(
            App::$domain, 
            'popular_posts',
            [ 
                'domain'   => App::$domain,
                'ajax_url' => \admin_url('admin-ajax.php'),
                'id'       => get_the_ID(),
            ]
        );
    }

}