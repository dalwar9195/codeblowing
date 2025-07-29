<?php 
/**
 * Theme hooks
 *
 * @package Code Blowing
 * @version 1.0.0
*/
defined( 'ABSPATH' ) || exit;

function codeblowing_login_logo_url() {
    return home_url(); // Link to your homepage
}
add_filter( 'login_headerurl', 'codeblowing_login_logo_url' );

function codeblowing_login_logo_title() {
    return 'Code Blowing';
}
add_filter( 'login_headertext', 'codeblowing_login_logo_title' );
