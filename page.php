<?php
/**
 * Page Template for Code Blowing Theme
 */
?>

<?php get_header(); ?>

<main class="site-main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="page-content">
                    <div class="container">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('Sorry, no pages found.', 'code-blowing'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
