<?php
/**
 * Header Template for Code Blowing Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Preloader -->
    <div class="preloader-wrapper">
        <div class="preloader"></div>
    </div>
    <!-- Promotional Banner -->
    <?php if ( !is_admin() && get_theme_mod('header_promo_init', false) ) : ?>
    <div id="promo-banner" class="promo-banner bg-warning">
        <p><?php echo get_theme_mod('header_promo_text', 'Promotional text') ?></p>
        <span id="close-banner">&times;</span>
    </div>
    <?php endif; ?>

    <header class="site-header bg-white border-bottom">
        <div class="container">
            <div class="header-wrapper">
                <!-- Logo -->
                <div class="site-logo">
                    <?php if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <h1><?php bloginfo('name'); ?></h1>
                        </a>
                    <?php } ?>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="primary-nav">
                    <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                    )); 
                    ?>
                </nav>

                <div id="mobile-nav" class="d-lg-none"></div>
                
                <!-- Call to Action Button -->
                <?php if ( get_theme_mod('header_btn_text', '') ) : ?>
                <div class="header-button align-items-center d-lg-flex d-none">
                    <a href="<?php echo esc_url( get_theme_mod('header_btn_url', '') ); ?>" class="btn btn-outline-primary"><?php echo get_theme_mod('header_btn_text', ''); ?></a>

                    <?php if( class_exists( 'WooCommerce' ) && get_theme_mod('header_minicart_init', false) ) : ?>
                    <a class="mini-cart-icon" href="<?php echo wc_get_cart_url(); ?>" title="View your cart items">
                        <i class="fa-solid fa-basket-shopping"></i><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>