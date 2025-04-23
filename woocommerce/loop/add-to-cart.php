<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$live_url = get_post_meta($product->get_id(), '_product_live_url', true);

$aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';
$args['class'] = 'btn btn-primary';
?>
<div class="buttons pt-3 border-top">
    <a href="<?php echo $live_url; ?>" class="btn btn-dark" target="_blank"><?php _e('Live Demo', 'codeblowing') ?></a>
    <?php
    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<a href="%s" %s data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            $aria_describedby,
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'btn btn-primary' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product,
        $args
    );
    ?>
</div>
<?php if ( isset( $args['aria-describedby_text'] ) ) : ?>
	<span id="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr( $product->get_id() ); ?>" class="screen-reader-text">
		<?php echo esc_html( $args['aria-describedby_text'] ); ?>
	</span>
<?php endif; ?>
