<?php
/***************************************************************************
Plugin Name:  Popular posts
Plugin URI:   https://www.studiovisual.com.br/
Description:  Enable view count on posts
Version:      1.3.0
Author:       Lorde Aleister
Author URI:   https://github.com/lordealeister/
Text Domain:  popular-posts
**************************************************************************/

if(!function_exists('is_plugin_active'))
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');

if(file_exists(dirname(__FILE__) . '/vendor/cmb2/cmb2/init.php'))
    require_once dirname(__FILE__) . '/vendor/cmb2/cmb2/init.php';
elseif(!is_plugin_active('cmb2/init.php') && file_exists(dirname(__DIR__, 1) . '/cmb2/init.php'))
    require_once dirname(__DIR__, 1) . '/cmb2/init.php';
elseif(!is_plugin_active('cmb2/init.php') && file_exists(dirname(__DIR__, 2) . '/cmb2/cmb2/init.php'))
  require_once dirname(__DIR__, 2) . '/cmb2/cmb2/init.php';
    

if(file_exists(dirname(__FILE__) . '/vendor/abuyoyo/cmb2-switch-button/cmb2-switch-button.php'))
    require_once dirname(__FILE__) . '/vendor/abuyoyo/cmb2-switch-button/cmb2-switch-button.php';
elseif(!is_plugin_active('cmb2-switch-button/cmb2-switch-button.php') && file_exists(dirname(__DIR__, 1) . '/cmb2-switch-button/cmb2-switch-button.php'))
    require_once dirname(__DIR__, 1) . '/cmb2-switch-button/cmb2-switch-button.php';
elseif(!is_plugin_active('cmb2-switch-button/cmb2-switch-button.php') && file_exists(dirname(__DIR__, 2) . '/abuyoyo/cmb2-switch-button/cmb2-switch-button.php'))
    require_once dirname(__DIR__, 2) . '/abuyoyo/cmb2-switch-button/cmb2-switch-button.php';

if(defined('CMB2_LOADED') && class_exists('CMB2_Switch_Button'))
    new PopularPosts\App;
