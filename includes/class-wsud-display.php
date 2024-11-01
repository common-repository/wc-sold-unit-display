<?php
/**
 * Project : wc-sold-unit-display
 */

namespace WSUD;


class WSUD_Display {

    private static $wsud_show_single = null;
    private static $wsud_show_list = null;
    private static $wsud_hide_when_zero = null;
    private static $wsud_prefix_text = null;
    private static $wsud_unit_text = null;
    private static $wsud_font_size = null;
    private static $wsud_bg_color = null;
    private static $wsud_bg_opacity = null;
    private static $wsud_text_color = null;
    private static $wsud_text_opacity = null;
    private static $wsud_padding_vertical = null;
    private static $wsud_padding_horizontal = null;
    private static $wsud_margin_top = null;
    private static $wsud_margin_bottom = null;
    private static $wsud_alignment = null;

    public static function init() {
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'render_css'] );
        add_action( 'woocommerce_single_product_summary', [__CLASS__, 'render_single'], 12 );
        add_action( 'woocommerce_after_shop_loop_item', [__CLASS__, 'render_list'], 11 );
    }

    public static function load_data() {
        if(is_null(self::$wsud_show_single)){
            self::$wsud_show_single = \WC_Admin_Settings::get_option( 'wsud_show_single', 'no' );
            self::$wsud_show_list = \WC_Admin_Settings::get_option( 'wsud_show_list', 'no' );

            if(self::$wsud_show_single === 'yes' || self::$wsud_show_list === 'yes'){
                //Load remains options
                self::$wsud_hide_when_zero = \WC_Admin_Settings::get_option( 'wsud_hide_when_zero', 'no' );
                self::$wsud_prefix_text = \WC_Admin_Settings::get_option( 'wsud_prefix_text', __('already sold', 'wsud') );
                self::$wsud_unit_text = \WC_Admin_Settings::get_option( 'wsud_unit_text', __('units', 'wsud') );
                self::$wsud_font_size = \WC_Admin_Settings::get_option( 'wsud_font_size', '16' );
                self::$wsud_bg_color = \WC_Admin_Settings::get_option( 'wsud_bg_color', '#ff4301' );
                self::$wsud_bg_opacity = \WC_Admin_Settings::get_option( 'wsud_bg_opacity', '1' );
                self::$wsud_text_color = \WC_Admin_Settings::get_option( 'wsud_text_color', '#ffffff' );
                self::$wsud_text_opacity = \WC_Admin_Settings::get_option( 'wsud_text_opacity', '1' );
                self::$wsud_padding_vertical = \WC_Admin_Settings::get_option( 'wsud_padding_vertical', '5' );
                self::$wsud_padding_horizontal = \WC_Admin_Settings::get_option( 'wsud_padding_horizontal', '5' );
                self::$wsud_margin_top = \WC_Admin_Settings::get_option( 'wsud_margin_top', '5' );
                self::$wsud_margin_bottom = \WC_Admin_Settings::get_option( 'wsud_margin_bottom', '5' );
                self::$wsud_alignment = \WC_Admin_Settings::get_option( 'wsud_alignment', 'left' );
            }
        }
    }

    public static function render_single() {
        self::render_unit_sold('single');
    }

    public static function render_list() {
        self::render_unit_sold('list');
    }

    public static function render_unit_sold($type) {
        global $product;

        $units_sold = $product->get_total_sales();

        if(self::$wsud_hide_when_zero === 'yes') {
            if($units_sold > 0) {
                self::render_html($units_sold, $type);
            }
        }
        else {
            self::render_html($units_sold, $type);
        }
    }

    public static function render_html($number, $type) {

        $wsud_prefix_text = self::$wsud_prefix_text;
        $wsud_unit_text = self::$wsud_unit_text;

        $esc_type = esc_attr($type);
        $esc_number = esc_html($number);
        $esc_prefix = esc_html($wsud_prefix_text);
        $esc_unit = esc_html($wsud_unit_text);

        echo "<div class='wsud-container wsud-type-{$esc_type}'><div class='wsud-inside'><span class='wsud-prefix'>{$esc_prefix}</span><span class='wsud-number'>{$esc_number}</span><span class='wsud-unit'>{$esc_unit}</span></div></div>";
    }

    public static function render_css() {

        self::load_data();

        $wsud_bg_color = self::$wsud_bg_color; //will escape html after process
        $wsud_bg_opacity = esc_html(self::$wsud_bg_opacity);
        $wsud_text_color = self::$wsud_text_color; //will escape html after process
        $wsud_text_opacity = esc_html(self::$wsud_text_opacity);
        $wsud_font_size = esc_html(self::$wsud_font_size);
        $wsud_padding_vertical = esc_html(self::$wsud_padding_vertical);
        $wsud_padding_horizontal = esc_html(self::$wsud_padding_horizontal);
        $wsud_margin_top = esc_html(self::$wsud_margin_top);
        $wsud_margin_bottom = esc_html(self::$wsud_margin_bottom);
        $wsud_alignment = esc_html(self::$wsud_alignment);

        //process rgn color
        list($bgr, $bgg, $bgb) = sscanf($wsud_bg_color, "#%02x%02x%02x");
        list($textr, $textg, $textb) = sscanf($wsud_text_color, "#%02x%02x%02x");

        $bgr = esc_html($bgr);
        $bgg = esc_html($bgg);
        $bgb = esc_html($bgb);

        $textr = esc_html($textr);
        $textg = esc_html($textg);
        $textb = esc_html($textb);

        $css = <<<CSS
          .wsud-container {
            margin-top: {$wsud_margin_top}px;
            margin-bottom: {$wsud_margin_bottom}px;
            text-align: {$wsud_alignment};
            font-size: {$wsud_font_size}px;
          }

          .wsud-container > .wsud-inside {
            display: inline-block;
            padding: {$wsud_padding_vertical}px {$wsud_padding_horizontal}px;
            background-color: rgba({$bgr},{$bgg},{$bgb}, {$wsud_bg_opacity});
            color: rgba({$textr},{$textg},{$textb}, {$wsud_text_opacity});
          }
CSS;

        wp_enqueue_style( 'wsud-style', WSUD_DIR_URL . '/assets/wsud-style.css', [], WSUD_VERSION );
        wp_add_inline_style( 'wsud-style', $css );
    }
}
