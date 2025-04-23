<?php 
// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<section class="cb-no-content">
    <header class="cb-no-content-header">
        <h1 class="cb-no-content-title"><?php esc_html_e( 'Nothing Found', 'code-blowing' ); ?></h1>
    </header>

    <div class="cb-no-content-message">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p><?php 
                printf(
                    wp_kses(
                        __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'code-blowing' ), 
                        array( 'a' => array( 'href' => array() ) )
                    ), 
                    esc_url( admin_url( 'post-new.php' ) ) 
                ); 
            ?></p>
        <?php elseif ( is_search() ) : ?>
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'code-blowing' ); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'code-blowing' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
