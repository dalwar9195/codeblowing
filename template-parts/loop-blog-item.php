<?php 
// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

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