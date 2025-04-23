<?php
/**
 * Elementor Initiation Class for WordPress Theme
 *
 * This class handles the integration of Elementor into the theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Codeblowing_Elementor_Init {

    /**
     * Constructor
     *
     * Initialize the class and add necessary actions and filters.
     */
    public function __construct() {
        add_action( 'after_setup_theme', array( $this, 'init' ) );
    }

    /**
     * Initialize Elementor support
     *
     * This method checks if Elementor is installed and active, then adds support for it.
     */
    public function init() {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            return;
        }

        // Add Elementor support
        $this->add_elementor_support();

        // Add custom Elementor widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_custom_widgets' ) );

        // Add custom Elementor categories
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_categories' ) );
    }

    /**
     * Add Elementor support
     *
     * This method adds theme support for Elementor.
     */
    private function add_elementor_support() {
        // Add theme support for Elementor
        add_theme_support( 'elementor' );

        // Add support for wide and full-width alignments
        add_theme_support( 'align-wide' );

        // Add support for Elementor's default content width
        if ( ! isset( $content_width ) ) {
            $content_width = 1140; // Default content width for Elementor
        }
    }

    /**
     * Register custom Elementor widgets
     *
     * This method registers custom widgets for Elementor.
     */
    public function register_custom_widgets() {
        // Include your custom widget files here
        require_once get_template_directory() . '/elementor/blog.php';
        require_once get_template_directory() . '/elementor/pricing.php';

        // Register your custom widgets here
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Codeblowing_Elementor_Blog_Widget() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Codeblowing_Elementor_Pricing_Table() );
    }

    /**
     * Add custom Elementor categories
     *
     * This method adds custom categories for Elementor widgets.
     *
     * @param \Elementor\Elements_Manager $elements_manager
     */
    public function add_elementor_categories( $elements_manager ) {
        $elements_manager->add_category(
            'cb-el-category',
            array(
                'title' => __( 'Code Blowing', 'code-blowing' ),
                'icon'  => 'fa fa-plug',
            )
        );
    }
}

// Instantiate the class
new Codeblowing_Elementor_Init();