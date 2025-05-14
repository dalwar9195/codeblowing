<?php
/**
 * The Codeblowing Theme customizer option classs for Codeblowing Theme.
 *
 * This is the class that all Codeblowing customizer options.
 * 
 * @package Codeblowing
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Codeblowing_Customizer_Option {

    private $wp_customize;
    
    public function __construct( $wp_customize ) {
        $this->wp_customize = $wp_customize;
    }

    public function add_panel( $id, $title = '', $priority = 160, $description = '', $capability = 'edit_theme_options', $theme_supports = [], $active_callback = '' ){
        $this->wp_customize->add_panel( $id, array(
            'title'		        => $title,
            'priority'	        => $priority,
            'description'       => $description,
            'capability'        => $capability,
            'theme_supports'    => $theme_supports,
            'active_callback'   => $active_callback,
	    ));
    }

    public function add_section( $id, $title = '', $priority = 160,  $panel = '', $description = '', $capability = 'edit_theme_options', $theme_supports = [], $active_callback = '' ){
        $this->wp_customize->add_section( $id, array(
            'title'		        => $title,
            'priority'	        => $priority,
            'description'       => $description,
            'panel'             => $panel,
            'capability'        => $capability,
            'theme_supports'    => $theme_supports,
            'active_callback'   => $active_callback,
	    ));
    }
    
    public function add_setting($id, $default = '', $sanitize_callback = 'sanitize_text_field') {
        $this->wp_customize->add_setting($id, [
            'default'           => $default,
            'sanitize_callback' => $sanitize_callback,
        ]);
    }
    
    public function add_control($id, $label, $section, $type = 'text', $choices = []) {
        $args = [
            'label'   => $label,
            'section' => $section,
            'type'    => $type,
            'settings' => $id,
        ];
        
        if ($type === 'select' && !empty($choices)) {
            $args['choices'] = $choices;
        }
        
        $this->wp_customize->add_control($id, $args);
    }
    
    public function add_text_field($id, $label, $section, $default = '') {
        $this->add_setting($id, $default);
        $this->add_control($id, $label, $section, 'text');
    }

    public function add_url_field($id, $label, $section, $default = '') {
        $this->add_setting($id, $default);
        $this->add_control($id, $label, $section, 'url');
    }
    
    public function add_select_field($id, $label, $section, $choices, $default = '') {
        $this->add_setting($id, $default);
        $this->add_control($id, $label, $section, 'select', $choices);
    }
    
    public function add_checkbox_field($id, $label, $section, $default = false) {
        $this->add_setting($id, $default, 'absint');
        $this->add_control($id, $label, $section, 'checkbox');
    }
    
    public function add_radio_field($id, $label, $section, $choices, $default = '') {
        $this->add_setting($id, $default);
        $this->add_control($id, $label, $section, 'radio', $choices);
    }
    
    public function add_textarea_field($id, $label, $section, $default = '') {
        $this->add_setting($id, $default, 'sanitize_textarea_field');
        $this->add_control($id, $label, $section, 'textarea');
    }
}