<?php

/**
 * set_post_view Add view count to post
 *
 * @param  int $post_id The post id. Empty is current post
 * @return void
 */
function set_post_view(int $post_id = 0): void {
    if(empty($post_id))
        $post_id = get_the_ID();  
    if(empty($post_id))
        return;

    $countKey = 'views_count';
    $count = get_post_meta($post_id, $countKey, true);
     
    if(empty($count))
        $count = 1;
    else
        $count++;
        
    update_post_meta($post_id, $countKey, $count);
}

/**
 * get_post_views Get post views count
 *
 * @param  int $post_id The post id. Empty is current post
 * @return int Total views count
 */
function get_post_views(int $post_id = 0): int {
    if(empty($post_id))
        $post_id = get_the_ID();  
    if(empty($post_id))
        return 0;

    $count_key = 'views_count';
    $count = get_post_meta($post_id, $count_key, true);

    if(empty($count))
        return 0;

    return $count;
}

/**
 * get_popular_posts Execute query to get most popular posts
 *
 * @param  array $args Additional args
 * @return WP_Query The query result
 */
function get_popular_posts(array $args = []): \WP_Query {
    $args = wp_parse_args(
        $args, 
        array(
            'meta_key' => 'views_count', 
            'orderby'  => 'meta_value_num', 
            'order'    => 'DESC',
        )
    );

    return new \WP_Query($args);
}