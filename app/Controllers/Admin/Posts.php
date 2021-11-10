<?php

namespace PopularPosts\Controllers\Admin;

use PopularPosts\App;

Class Posts {
	
	public function __construct() {
    add_filter('manage_posts_columns',       array($this, 'columnHead'));
    add_filter('manage_posts_custom_column', array($this, 'columnContent'), 10, 2);
    add_filter('request',                    array($this, 'columnOrderby'));
    add_action('current_screen',             array($this, 'currentScreen'));
  }

  /**
   * currentScreen
   *
   * @return void
   */
  function currentScreen(): void {
    $screen = get_current_screen();
    
    if(!empty($screen->post_type))
      add_filter("manage_edit-{$screen->post_type}_sortable_columns", array($this, 'columnSort'));
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
  
  /**
   * columnSort
   *
   * @param  mixed $columns
   * @return array
   */
  function columnSort(array $columns): array {
    $columns[App::$domain . '_views'] = App::$domain . '_views';

    return $columns;
  }
  
  /**
   * columnOrderby
   *
   * @param  array $vars
   * @return array
   */
  function columnOrderby(array $vars): array {
    if(!is_admin())
      return $vars;    

    if(!isset($vars['orderby']) || (isset($vars['orderby']) && App::$domain . '_views' == $vars['orderby'])):
      $vars['meta_type'] = 'NUMERIC';
      $vars['orderby']   = 'meta_value';
      $vars['meta_query'] = array(
        'relation' => 'OR',
        array( 
          'key'     => 'views_count',
          'compare' => 'NOT EXISTS'           
        ),
        array( 
          'key'     => 'views_count',
          'compare' => 'EXISTS'           
        )
      );
    endif;

    return $vars;
  }

}
