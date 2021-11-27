<?php

// use SmallShop\API;
namespace Admin;

use Icon\Icon;
use Icon\IconSize;
use Translation\I18n;

class SmallShopAdmin 
{
    public static function init()
    {
        // scripts
        wp_enqueue_script('small-shop-alpinejs', 'https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js', false, true, true);
        wp_enqueue_script('small-shop-sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', false, true, true);
        
        // styles
        wp_enqueue_style('small-shop-style', plugin_dir_url(__FILE__) . 'assets/css/sm-shop-styles.css', false, false);

        // other
        add_action('admin_menu', array(__CLASS__, 'admin_menu'));
    }

    public static function admin_menu()
    {
        add_menu_page('Small Shop', 'Small Shop', 'manage_options', 'sm-shop', [__CLASS__,'endpoints']);
        add_submenu_page('sm-shop', I18n::translate('Categories'), I18n::translate('Categories'), 'manage_options', 'sm-shop-categories', [__CLASS__, 'categories']);
    }

    public function endpoints()
    {
        $template = SMALL_SHOP__PLUGIN_TEMPLATES_ADMIN . 'endpoints.php';

        if( file_exists($template))
        {
            load_template($template);
        }
    }
 
    public function categories()
    {
        $template = SMALL_SHOP__PLUGIN_TEMPLATES_ADMIN . 'categoryList.php';

        if( file_exists($template))
        {
            load_template($template);
        }
    }
}