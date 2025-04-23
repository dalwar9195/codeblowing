<?php 
// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cb-post' ); ?>>
    <header class="cb-post-header">
        <?php if ( is_single() ) : ?>
            <h1 class="cb-post-title"><?php the_title(); ?></h1>
        <?php else : ?>
            <h2 class="cb-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
        <?php endif; ?>
        <div class="cb-post-meta">
            <span class="cb-post-date"><?php echo get_the_date(); ?></span>
            <span class="cb-post-author"><?php the_author_posts_link(); ?></span>
        </div>
    </header>

    <div class="cb-post-thumbnail">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'large' ); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="cb-post-content">
        <?php if ( is_single() ) : ?>
            <?php the_content(); ?>
        <?php else : ?>
            <?php the_excerpt(); ?>
        <?php endif; ?>
    </div>

    <footer class="cb-post-footer">
        <?php if ( has_category() ) : ?>
            <div class="cb-post-categories"><?php the_category( ', ' ); ?></div>
        <?php endif; ?>
        <?php if ( has_tag() ) : ?>
            <div class="cb-post-tags"><?php the_tags(); ?></div>
        <?php endif; ?>
    </footer>
</article>
