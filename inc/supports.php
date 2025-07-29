<?php 
/**
 * Add theme support functions
 *
 * @version 1.0.0
*/

defined( 'ABSPATH' ) || exit;

add_filter('woocommerce_blocks_registry_container', '__return_false');

function codeblowing_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 1600,
        'single_image_width'    => 1600,

        'product_grid'          => array(
            'default_rows'          => 3,
            'min_rows'              => 2,
            'max_rows'              => 8,
            'default_columns'       => 4,
            'min_columns'           => 2,
            'max_columns'           => 5,
        ),
    ) );

    add_theme_support('title-tag');
    add_theme_support( 'custom-logo' );
    
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'codeblowing'),
            'footer'  => __('Footer Menu', 'codeblowing'),
        )
    );

    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
}

add_action( 'after_setup_theme', 'codeblowing_add_woocommerce_support', 100 );

function codeblowing_register_sidebars() {
    register_sidebar(array(
        'name'          => __('Right Sidebar', 'codeblowing'),
        'id'            => 'right-sidebar',
        'description'   => __('This is the right sidebar for widgets.', 'codeblowing'),
        'before_widget' => '<div id="%1$s" class="sidebar widget widget bg-white p-3 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title fs-6 text-uppercase fw-bold text-dark mb-3">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer', 'codeblowing'),
        'id'            => 'footer-sidebar',
        'description'   => __('This is the right sidebar for widgets.', 'codeblowing'),
        'before_widget' => '<div id="%1$s" class="footer-widget widget col-xl-3 col-md-4 col-sm-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title fs-6 text-uppercase fw-semibold text-white mb-3">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'codeblowing_register_sidebars');

add_action('admin_enqueue_scripts', 'codeblowing_enqueue_select2_in_woocommerce');

function codeblowing_enqueue_select2_in_woocommerce() {
    wp_enqueue_script('select2');
    wp_enqueue_style('select2');
}