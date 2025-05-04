<?php

defined( 'ABSPATH' ) || exit;

class Theme_Customizer {

    public function __construct() {
        add_action('customize_register', [$this, 'register_customizer_options']);
    }

    public function register_customizer_options($wp_customize) {
        $this->add_panel($wp_customize, 'theme_options_panel', 'Theme Options', 'Customize theme settings', 10);

        $this->add_section($wp_customize, 'header_section', 'Header Settings', 'Manage header options', 'theme_options_panel');

        $this->add_setting_and_control($wp_customize, [
            'setting_id'   => 'header_text',
            'default'      => 'Welcome to My Site',
            'control'      => [
                'label'   => 'Header Text',
                'type'    => 'text',
                'section' => 'header_section',
            ]
        ]);
    }

    public function add_panel($customizer, $id, $title, $description = '', $priority = 160) {
        $customizer->add_panel($id, [
            'title'       => $title,
            'description' => $description,
            'priority'    => $priority,
        ]);
    }

    public function add_section($customizer, $id, $title, $description = '', $panel = null) {
        $args = [
            'title'       => $title,
            'description' => $description,
        ];

        if ($panel) {
            $args['panel'] = $panel;
        }

        $customizer->add_section($id, $args);
    }

    public function add_setting_and_control($customizer, $args) {
        $setting_id = $args['setting_id'];
        $default    = $args['default'] ?? '';
        $control    = $args['control'];

        $customizer->add_setting($setting_id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $customizer->add_control($setting_id, array_merge([
            'section' => '',
            'label'   => '',
            'type'    => 'text',
        ], $control));
    }
}
