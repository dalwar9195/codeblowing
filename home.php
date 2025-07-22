<?php
/**
 * Main Index File for Code Blowing Theme
 */

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); 

get_template_part('template-parts/page-banner');
?>

<main class="site-main py-5">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <?php get_template_part('template-parts/loop-blog', 'item'); ?>
                </div>
                <?php endwhile; ?>
            </div>
            <!-- Pagination Links -->
            <div class="pagination">
                <?php
                echo paginate_links( array(
                    'total'   => $wp_query->max_num_pages,
                    'current' => max( 1, get_query_var('paged') ),
                ) );
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer(); 
