<?php 
/**
 * Single Post Template
 *
 * @package Code Blowing
 * @since 1.0
 */

// Prevent direct file access for security
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); ?>

<main id="single-post" class="site-main">
    <?php get_template_part( 'template-parts/page', 'banner' ); ?>
    <div class="page-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    // Start the loop to display the post content
                    while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail bg-white p-3">
                                    <!-- Display the featured image -->
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="post-content bg-white p-3 mt-3">
                                <div class="entry-meta pb-3 border-bottom d-flex justify-content-between align-items-center">
                                    <!-- Display the author, post date, and categories -->
                                    <div class="author"><i class="fa-solid fa-user-tie"></i> By <?php the_author(); ?></div>
                                    <div class="categories"><i class="fa-solid fa-layer-group"></i> <?php the_category(', '); ?></div>
                                </div>

                                <div class="entry-content py-3">
                                    <!-- Display the post content -->
                                    <?php the_content(); ?>
                                </div>
                                
                                <div class="entry-footer">
                                    <div class="tags">
                                        <!-- Display post tags if available -->
                                        <?php the_tags('Tags: ', '', ''); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </article>
                        
                        <?php
                        // Load the comments template if comments are open or exist
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    <?php endwhile; ?>
                </div>
                
                <div class="col-md-4">
                    <!-- Load the sidebar -->
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
