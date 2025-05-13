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
    <?php if ( !is_admin() ) : ?>
    <div id="promo-banner" class="promo-banner bg-warning">
        <p>🔥 Limited-time offer! Get 30% off on all products. Use code: <strong>SALE30</strong> 🎉</p>
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
                <div class="header-button d-lg-block d-none">
                    <a href="#" class="btn btn-outline-primary">Get Started</a>
                </div>
            </div>
        </div>
    </header>