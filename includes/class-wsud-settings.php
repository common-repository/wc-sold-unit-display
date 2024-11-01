<?php
/**
 * Project : wc-sold-unit-display
 */

namespace WSUD;


class WSUD_Settings {

    public static function init() {
        add_filter( 'woocommerce_get_sections_products', [ __CLASS__, 'wsud_add_section' ] );
        add_filter( 'woocommerce_get_settings_products', [ __CLASS__, 'wsud_all_settings' ], 10, 2 );
    }

    public static function wsud_add_section( $sections ) {
        $sections['wsud'] = __( 'Unit Sold Display', 'wsud' );

        return $sections;
    }

    public static function wsud_all_settings( $settings, $current_section ) {
        /**
         * Check the current section is what we want
         **/
        if ( $current_section === 'wsud' ) {
            $wsud_settings = [];

            // Settings Title
            $wsud_settings[] = [
                'name' => __( 'Unit Sold Display Settings', 'wsud' ),
                'type' => 'title',
                'desc' => __( 'The following options for configure unit sold display settings', 'wsud' ),
                'id' => 'wsud_settings' ];

            $wsud_settings[] = [
                'name'     => __( 'Show on Single Product', 'wsud' ),
                'desc' => __( 'Show product unit sold on single product page', 'wsud' ),
                'id'       => 'wsud_show_single',
                'type'     => 'checkbox',
                'css'      => 'min-width:300px;',
                'autoload' => true,
            ];

            $wsud_settings[] = [
                'name'     => __( 'Show on Product List/Archive', 'wsud' ),
                'desc' => __( 'Show product unit sold on product list/archive page', 'wsud' ),
                'id'       => 'wsud_show_list',
                'type'     => 'checkbox',
                'css'      => 'min-width:300px;',
                'autoload' => true,
            ];

            $wsud_settings[] = [
                'name'     => __( 'Hide when zero sales', 'wsud' ),
                'desc' => __( 'Hide the unit sold display when zeros sales', 'wsud' ),
                'id'       => 'wsud_hide_when_zero',
                'type'     => 'checkbox',
                'css'      => 'min-width:300px;',
                'autoload' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( "Prefix Text", 'wsud' ),
                'desc'     => __( "The text for prefix before number. for example 'sold x units', 'sold' means the text here. ", 'wsud' ),
                'id'       => 'wsud_prefix_text',
                'type'     => 'text',
                'default'  => __('already sold', 'wsud'),
                'placeholder' => __('already sold', 'wsud'),
                'css'      => 'min-width: 300px',
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( "Unit Text", 'wsud' ),
                'desc'     => __( "The text for product unit. for example 'sold x units', 'units' means the text here. ", 'wsud' ),
                'id'       => 'wsud_unit_text',
                'type'     => 'text',
                'default'  => __('units', 'wsud'),
                'placeholder' => __('units', 'wsud'),
                'css'      => 'min-width: 300px',
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Background color', 'wsud' ),
                /* translators: %s: default color */
                'desc'     => sprintf( __( 'The background color for unit sold display. Default %s.', 'wsud' ), '<code>#ff4301</code>' ),
                'id'       => 'wsud_bg_color',
                'type'     => 'color',
                'css'      => 'width:6em;',
                'default'  => '#ff4301',
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Background Opacity', 'wsud' ),
                'desc'     => __('The opacity of unit sold display background', 'wsud'),
                'id'       => 'wsud_bg_opacity',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '1',
                'custom_attributes' => [
                    'step' => '0.01',
                    'max' => '1',
                    'min' => '0.01'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Text color', 'wsud' ),
                /* translators: %s: default color */
                'desc'     => sprintf( __( 'The text color for unit sold display. Default %s.', 'woocommerce' ), '<code>#ffffff</code>' ),
                'id'       => 'wsud_text_color',
                'type'     => 'color',
                'css'      => 'width:6em;',
                'default'  => '#ffffff',
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Text Opacity', 'wsud' ),
                'desc'     => __('The opacity of unit sold display text', 'wsud'),
                'id'       => 'wsud_text_opacity',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '1',
                'custom_attributes' => [
                    'step' => '0.01',
                    'max' => '1',
                    'min' => '0.01'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Font Size (px)', 'wsud' ),
                'desc'     => __('Font size for unit sold box. unit in px.', 'wsud'),
                'id'       => 'wsud_font_size',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '16',
                'custom_attributes' => [
                    'step' => '1',
                    'max' => '100',
                    'min' => '0'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Vertical Padding (px)', 'wsud' ),
                'desc'     => __('add vertical padding to unit sold box. unit in px.', 'wsud'),
                'id'       => 'wsud_padding_vertical',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '3',
                'custom_attributes' => [
                    'step' => '1',
                    'max' => '100',
                    'min' => '0'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Horizontal Padding (px)', 'wsud' ),
                'desc'     => __('add horizontal padding to unit sold box. unit in px.', 'wsud'),
                'id'       => 'wsud_padding_horizontal',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '8',
                'custom_attributes' => [
                    'step' => '1',
                    'max' => '100',
                    'min' => '0'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Margin Top (px)', 'wsud' ),
                'desc'     => __('add margin top to unit sold box. unit in px.', 'wsud'),
                'id'       => 'wsud_margin_top',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '5',
                'custom_attributes' => [
                    'step' => '1',
                    'max' => '100',
                    'min' => '0'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Margin Bottom (px)', 'wsud' ),
                'desc'     => __('add margin bottom to unit sold box. unit in px.', 'wsud'),
                'id'       => 'wsud_margin_bottom',
                'type'     => 'number',
                'css'      => 'min-width: 300px',
                'default'  => '5',
                'custom_attributes' => [
                    'step' => '1',
                    'max' => '100',
                    'min' => '0'
                ],
                'autoload' => false,
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'title'    => __( 'Alignment', 'wsud' ),
                'desc'     => __('align unit sold box to left right center.', 'wsud'),
                'id'       => 'wsud_alignment',
                'css'      => 'min-width:150px;',
                'class'    => 'wc-enhanced-select',
                'default'  => 'left',
                'type'     => 'select',
                'options'  => array(
                    'left'           => __( 'Left', 'wsud' ),
                    'right'           => __( 'Right', 'wsud' ),
                    'center'           => __( 'Center', 'wsud' ),
                ),
                'desc_tip' => true,
            ];

            $wsud_settings[] = [
                'type' => 'sectionend',
                'id'   => 'wsud_settings',
            ];

            return $wsud_settings;
        } else {
            return $settings;
        }
    }
}
