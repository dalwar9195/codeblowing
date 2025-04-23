<?php 
function codeblowing_services_post_type() {
    // Set up labels
    $labels = array(
        'name'               => 'Services',
        'singular_name'      => 'Service',
        'add_new'            => 'Add New Service',
        'add_new_item'       => 'Add New Service',
        'edit_item'          => 'Edit Service',
        'new_item'           => 'New Service',
        'all_items'          => 'All Services',
        'view_item'          => 'View Service',
        'search_items'       => 'Search Services',
        'not_found'          => 'No Services Found',
        'not_found_in_trash' => 'No Services Found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Services'
    );

    // Register the post type
    register_post_type('services', array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'       => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'services'),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-admin-tools', // You can change the icon
        'show_in_rest'       => true, // Enable Gutenberg editor
    ));
}
add_action('after_setup_theme', 'codeblowing_services_post_type');