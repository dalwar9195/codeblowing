<?php
/**
 * The template for displaying all single posts of the "services" custom post type.
 */

get_header(); ?>

<?php get_template_part('template-parts/page', 'banner'); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            
            <div class="row">
                <div class="col-md-8">
                    <?php
                        while (have_posts()) : the_post();
                            // Display the service content
                            get_template_part('template-parts/services/single');
                        endwhile;
                    ?>
                </div>
                <div class="col-md-4">
                    <?php get_sidebar(); ?>                 
                </div>
            </div>
        </div>
        
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>