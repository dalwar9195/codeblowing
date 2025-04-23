<?php
/**
 * The template for displaying all single posts of the "services" custom post type.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while (have_posts()) : the_post();
            // Display the service content
            the_title('<h1>', '</h1>');
            the_post_thumbnail(); // Display featured image
            the_content(); // Display the content
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>