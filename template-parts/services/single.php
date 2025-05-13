<?php 

/**
 * The template part for displaying single services.
 *
 * @package YourThemeName
 */
?>
<div class="service-thumb">
    <?php if (has_post_thumbnail()) : ?>
        <div class="service-image">
            <?php the_post_thumbnail('full'); // Display the featured image ?>
        </div>
    <?php endif; ?>
</div>

<div class="bg-white p-3 mt-3">
    <?php the_content(); // Display the content ?>
</div>