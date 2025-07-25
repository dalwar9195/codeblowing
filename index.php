<?php
/**
 * Main Index File for Code Blowing Theme
 */
// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); 
?>

<main class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_format()); ?>
            <?php endwhile; ?>
            <!-- Pagination Links -->
            <div class="pagination">
                <?php
                echo paginate_links( array(
                    // 'type'    => 'list',
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
