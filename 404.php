<?php
/**
 * Page Template for 404
 */
?>

<?php get_header(); ?>

<main class="site-main">
    <section class="error-404 not-found py-5">
        <div class="container">
            <div class="page-header text-center">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'codeblowing' ); ?></h1>
            </div>

            <div class="page-content text-center">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'codeblowing' ); ?></p>

                <?php get_search_form(); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Go to Homepage</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

