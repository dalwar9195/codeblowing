<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once get_stylesheet_directory() . '/inc/update-checker/plugin-update-checker.php';

$theme_update_checker = PucFactory::buildUpdateChecker(
    'https://api.codeblowing.com/codeblowing/update-server.php', // Your update server URL
    get_template_directory() . '/style.css', // Path to your theme's main file
    'code-blowing'
);