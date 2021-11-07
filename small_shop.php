<?php
/**
 * @package SMALL_SHOP
 */
/*
Plugin Name: SMALL SHOP
Plugin URI: https://SMALL_SHOP.com/
Description: small shop for Wordpress.
Version: 1.0.0
Author: Marlepo
Author URI: https://automattic.com/wordpress-plugins/
License: MIT
Text Domain: small_shop
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'SMALL_SHOP_VERSION', '1.0.0' );
define( 'SMALL_SHOP__MINIMUM_WP_VERSION', '4.0' );
define( 'SMALL_SHOP_DELETE_LIMIT', 100000 );
define( 'SMALL_SHOP_TEXT_DOMAIN', 'small_shop' );


define( 'SMALL_SHOP__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SMALL_SHOP__PLUGIN_LANGUAGES_DIR',  SMALL_SHOP__PLUGIN_DIR . 'languages/' );
define( 'SMALL_SHOP__PLUGIN_MIGRATIONS_DIR', SMALL_SHOP__PLUGIN_DIR . 'db/migrations/' );
define( 'SMALL_SHOP__PLUGIN_API', SMALL_SHOP__PLUGIN_DIR . 'api/' );

define( 'SMALL_SHOP__PLUGIN_TEMPLATES', SMALL_SHOP__PLUGIN_DIR . 'views/' );
define( 'SMALL_SHOP__PLUGIN_TEMPLATES_ADMIN', SMALL_SHOP__PLUGIN_DIR . 'views/admin/' );

define( 'SMALL_SHOP__PLUGIN_ASSETS', SMALL_SHOP__PLUGIN_DIR . 'assets/' );
define( 'SMALL_SHOP__PLUGIN_ICONS', SMALL_SHOP__PLUGIN_ASSETS . 'icons/' );

define( 'SMALL_SHOP__PLUGIN_JS', SMALL_SHOP__PLUGIN_ASSETS . 'js/' );
define( 'SMALL_SHOP__PLUGIN_CSS', SMALL_SHOP__PLUGIN_ASSETS . 'css/' );


register_activation_hook( __FILE__, array( 'SMALL_SHOP', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'SMALL_SHOP', 'plugin_deactivation' ) );

require_once( SMALL_SHOP__PLUGIN_DIR . 'SmallShopTranslation.php' );
require_once( SMALL_SHOP__PLUGIN_DIR . 'SmallShopIcon.php' );
require_once( SMALL_SHOP__PLUGIN_DIR . 'SmallShop.php' );
require_once( SMALL_SHOP__PLUGIN_API . 'SmallShopApi.php' );

add_action( 'init', array( SmallShopTranslation::class, 'loadTranslation' ) );
add_action( 'init', array( SmallShop::class, 'init' ) );
add_action( 'rest_api_init', array( SmallShopAPI::class, 'init' ) );

if ( is_admin() ) {
	require_once( SMALL_SHOP__PLUGIN_DIR . 'SmallShopAdmin.php' );

	add_action( 'init', array( SmallShopAdmin::class, 'init' ) );
}