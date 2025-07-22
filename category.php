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
            <h2 class="text-center fs-1 text-white"><?php single_cat_title(); ?></h2>
        </div>
    </div>
</div><!-- .page-header -->

<div id="primary" class="content-area">
    <main id="main" class="site-main">        
        <div class="container">
            <div class="row">
                <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="blog-post-item">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="blog-post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'full' ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="blog-post-content p-3 bg-white">
                                        <div class="post-meta border-bottom pb-2 d-flex justify-content-between align-items-center">
                                            <span class="text-secondary"><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
                                            <span class="text-secondary"><i class="fa-solid fa-calendar-days"></i> <?php the_time('F j, Y'); ?></span>
                                        </div>
                                        <h3 class="blog-post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="blog-post-excerpt">
                                            <p><?php echo wp_trim_words( get_the_content(), 20, '' ); ?></p>
                                        </div>
                                        <div class="mt-3">
                                            <a href="<?php echo esc_url( get_the_permalink()); ?>" class="btn btn-dark">Read More</a>
                                        </div>
                                    </div>
                                </div>
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