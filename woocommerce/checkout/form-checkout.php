<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="container">
    <div class="bg-white p-3">
        <?php
        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }

        ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">
            <div class="row">
                <div class="col-lg-8">
                    <?php if ( $checkout->get_checkout_fields() ) : ?>

                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <div id="customer_details">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            
                    <h4 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h4>
                    
                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                </div>
            </div>
            

        </form>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
</div>