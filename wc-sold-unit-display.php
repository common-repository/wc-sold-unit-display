<?php

/*
Plugin Name: Sold Unit Display for Woocommerce
Plugin URI: https://wordpress.org
Description: Show the number of product unit sold on frontend.
Version: 1.0.1
Author: palagorn.p
Author URI: https://palamike.com
License: GPL2
*/

define('WSUD_VERSION', '1.0.1');
define('WSUD_DIR', plugin_dir_path(__FILE__));
define('WSUD_LANG_DIR', dirname( plugin_basename( __FILE__ ) ) . '/languages');
define('WSUD_DIR_URL', plugin_dir_url( __FILE__ ));

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    require WSUD_DIR.'includes/class-wsud-core.php';
    WSUD\WSUD_Core::init();
}
