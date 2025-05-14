<?php
/**
 * The Codeblowing Customizer Options for Codeblowing Theme.
 *
 * This is the template that displays all of Codeblowing Customizer Options Content
 * 
 * @package Codeblowing
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function codeblowing_customizer_options( $wp_customize ){

    $options = new Codeblowing_Customizer_Option( $wp_customize );

	$options->add_panel('codeblowing-options', __( 'Theme Options', 'codeblowing' ), 10 );

	$options->add_section('codeblowing-topbar', __( 'Topbar', 'codeblowing' ), 10, 'codeblowing-options' );

    // // Initiate Topbar
    $options->add_checkbox_field( 'topbar_init', __('Hide Topbar', 'codeblowing'), 'codeblowing-topbar' );
    
    // // Topbar Email Option
    $options->add_text_field( 'topbar_email', __('Email', 'codeblowing'), 'codeblowing-topbar', 'yourname@domain.com' );
    
    // // Topbar Email Link Option
    $options->add_checkbox_field( 'topbar_email_link', __('Email Wrap with Link', 'codeblowing'), 'codeblowing-topbar' );

    // // Topbar Phone Option
    $options->add_text_field( 'topbar_phone', __('Phone', 'codeblowing'), 'codeblowing-topbar', '+00 11 22 33 44' );

    // Topbar Phone Link Option
    $options->add_checkbox_field( 'topbar_phone_link', __('Phone Wrap with Link', 'codeblowing'), 'codeblowing-topbar' );

    // // Topbar Address Option
    $options->add_text_field( 'topbar_address', __('Address', 'codeblowing'), 'codeblowing-topbar', 'Kotbari, Cumilla-3504' );	

    // // Topbar Address Link Text
    $options->add_url_field( 'topbar_address_link', __('Address Link', 'codeblowing'), 'codeblowing-topbar', '#' );

    // // Topbar Address Link Option
    $options->add_checkbox_field( 'topbar_address_link_init', __('Address Wrap with Link', 'codeblowing'), 'codeblowing-topbar' );

    $options->add_section('codeblowing-promo-banner', __( 'Promotional', 'codeblowing' ), 10, 'codeblowing-options' );
    // // Initiate Promo Banner
    $options->add_checkbox_field( 'header_promo_init', __('Show Header Promo', 'codeblowing'), 'codeblowing-promo-banner' );

    // Copyright Text Area
    $options->add_textarea_field( 'header_promo_text', __('Header Promo Text', 'codeblowing'), 'codeblowing-promo-banner', '🔥 Limited-time offer! Get 30% off on all products. Use code: <strong>SALE30</strong> 🎉' );

    $options->add_section('codeblowing-header-btn', __( 'Header Button', 'codeblowing' ), 10, 'codeblowing-options' );
    // Header Button Link Text
    $options->add_text_field( 'header_btn_text', __('Button Text', 'codeblowing'), 'codeblowing-header-btn', 'Get Started' );
    $options->add_url_field( 'header_btn_url', __('Button URL', 'codeblowing'), 'codeblowing-header-btn', '#' );
    
    // // Topbar Social Link Option
    // $options->add_url_field( 'topbar_facebook', __('Facebook URL', 'codeblowing'), 'codeblowing-topbar', '#' );
    // $options->add_url_field( 'topbar_twitter', __('Twitter URL', 'codeblowing'), 'codeblowing-topbar', '#' );
    // $options->add_url_field( 'topbar_linkedin', __('Linkedin URL', 'codeblowing'), 'codeblowing-topbar', '#' );
    // $options->add_url_field( 'topbar_pinterest', __('Pinterest URL', 'codeblowing'), 'codeblowing-topbar', '#' );
    // $options->add_url_field( 'topbar_dribbble', __('Dribbble URL', 'codeblowing'), 'codeblowing-topbar', '#' );
    // $options->add_url_field( 'topbar_youtube', __('Youtube URL', 'codeblowing'), 'codeblowing-topbar', '#' );

    // Image Logo Option
	// $wp_customize->add_setting('codeblowing_logo', array(
	// 	'default'		=> ASSET_URI . '/img/logo.png',
	// 	'transport'		=> 'refresh',
	// ));

	// $wp_customize->add_control(
	// 	new WP_Customize_Image_Control( $wp_customize, 'codeblowing_logo', array(
	// 		'section'	=> 'title_tagline',
	// 		'settings'	=> 'codeblowing_logo',
	// 		'label'		=> __('Upload Logo', 'codeblowing'),
	// 	))
	// );

    // // Text Logo Option
    // $options->add_text_field( 'codeblowing_logo_text', __('Logo Text', 'codeblowing'), 'title_tagline', 'Idream' );

    // Footer Section
	$options->add_section( 'codeblowing-footer', __('Footer', 'codeblowing'), 10, 'codeblowing-options' );

    // Copyright Text Area
    $options->add_textarea_field( 'copyright_text', __('Copyright Text', 'codeblowing'), 'codeblowing-footer', 'All Right Reserved by <a href="#">Code Blowing</a>' );
}

add_action('customize_register', 'codeblowing_customizer_options');