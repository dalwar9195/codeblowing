<?php 
/**
 * Required functions and required files.
 *
 * @package Code Blowing
 * @version 1.0.0
*/
defined( 'ABSPATH' ) || exit;

require_once get_stylesheet_directory() . '/inc/supports.php';
require_once get_stylesheet_directory() . '/inc/scripts.php';
require_once get_stylesheet_directory() . '/hooks/theme-hooks.php';
require_once get_stylesheet_directory() . '/classes/class-customizer.php';
require_once get_stylesheet_directory() . '/inc/product-metabox.php';
require_once get_stylesheet_directory() . '/inc/custom-functions.php';
require_once get_stylesheet_directory() . '/inc/post-type-services.php';
require_once get_stylesheet_directory() . '/inc/customizer-options.php';
require_once get_stylesheet_directory() . '/widgets/about.php';
require_once get_stylesheet_directory() . '/elementor/init.php';

if( class_exists('WooCommerce') ){
    require_once get_stylesheet_directory() . '/hooks/wc-removed-hooks.php';
    require_once get_stylesheet_directory() . '/hooks/wc-added-hooks.php';
}

function codeblowing_pagination($query = null) {
    global $wp_query;

    if (!$query) $query = $wp_query;

    $big = 999999999; // need an unlikely integer

    $paginate_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $query->max_num_pages,
        'type'      => 'array',
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
    ]);

    if (is_array($paginate_links)) {
        echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

        foreach ($paginate_links as $link) {
            // Add active class for current page
            if (strpos($link, 'current') !== false) {
                echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            } elseif (strpos($link, 'dots') !== false) {
                echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
            } else {
                echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            }
        }

        echo '</ul></nav>';
    }
}