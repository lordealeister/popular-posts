<?php

namespace PopularPosts\Controllers\Admin;

use PopularPosts\App;

Class Settings {
	
	public function __construct() {
        add_action('cmb2_admin_init', array($this, 'init'));
    }
    
    /**
     * init Initialize settings page
     *
     * @return void
     */
    function init(): void {
        $page = \new_cmb2_box([
            'id'           => sanitize_title(App::$name) . '_metabox',
            'title'        => App::$name,
            'object_types' => array('options-page'),
            'option_key'   => App::$domain,
            'capability'   => 'edit_posts', // Capability required to view this options page.
		    'position'     => 99.59, // Menu position.
            'parent_slug'  => 'options-general.php',
        ]);

        $this->addFields($page);
    }
    
    /**
     * addFields Add fields to settings
     *
     * @param  \CMB2 $page The setiings page
     * @return void
     */
    function addFields(\CMB2 $page): void {
        $page->add_field([
            'id'             => 'ajax_track',
            'name'           => __('Enable ajax', App::$domain),
            'desc'           => __('Counts views via ajax. Enable if the site uses any type of cache', App::$domain),
            'type'           => 'switch',
            'default'        => false,
            'active_value'   => true,
            'inactive_value' => false,
        ]);
    }

}