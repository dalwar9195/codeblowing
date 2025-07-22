<?php
/**
 * The template for displaying the archive of the "services" custom post type.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header(); ?>

<div class="page-header bg-primary py-5">
    <div class="container">
        <div class="banner-content">
            <h2 class="text-center fs-1 text-white">Our Services</h2>
        </div>
    </div>
</div><!-- .page-header -->

<div id="primary" class="content-area">
    <main id="main" class="site-main">        
        <div class="container">
            <div class="row">
                <?php if (have_posts()) : ?>
                        <?php 
                        while (have_posts()) : the_post();
                            // Display each service
                            ?>
                            <div class="col-md-4">
                                <article class="service-item mb-3 bg-white border border-1 post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="service-thumb">
                                        <?php the_post_thumbnail('post-thumbnail'); ?>
                                    </div>
                                    <div class="service-title">
                                        <?php the_title('<h4><a class="text-dark" href="' . esc_url(get_permalink()) . '">', '</a></h4>'); ?>
                                    </div><!-- .entry-header -->

                                    <div class="service-excerpt">
                                        <?php echo wp_trim_words( get_the_content(), 20, ' ' ); ?>
                                    </div><!-- .entry-content -->
                                    <div class="service-btn mt-3">
                                        <a href="<?php echo esc_attr(get_the_permalink()); ?>" class="btn btn-outline-primary">Read More</a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    <?php the_posts_navigation(); ?>

                <?php else : ?>
                    <p>No services found.</p>
                <?php endif; ?>
            </div>
        </div>
        
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>