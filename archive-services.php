<?php
/**
 * The template for displaying the archive of the "services" custom post type.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title">Our Services</h1>
            </header><!-- .page-header -->

            <?php
            while (have_posts()) : the_post();
                // Display each service
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_post_thumbnail(); ?>
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
            <?php endwhile; ?>

            <?php the_posts_navigation(); ?>

        <?php else : ?>
            <p>No services found.</p>
        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>