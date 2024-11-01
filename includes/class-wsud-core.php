<?php
/**
 * Project : wc-sold-unit-display
 */

namespace WSUD;


class WSUD_Core {

    public static function init(){
        include_once WSUD_DIR.'includes/class-wsud-settings.php';
        include_once WSUD_DIR.'includes/class-wsud-display.php';
        WSUD_Settings::init();
        WSUD_Display::init();

        /**
         * Load Text Domain
         */
        add_action('init', [__CLASS__, 'load_text_domain']);
    }

    /**
     * Load Plugin Text Domain
     */
    public static function load_text_domain(){
        load_plugin_textdomain( 'wsud', false, WSUD_LANG_DIR );
    }

}
