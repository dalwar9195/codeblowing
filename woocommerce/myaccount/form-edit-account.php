<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>
<div class="bg-white p-3">
    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
        
        <?php do_action( 'woocommerce_edit_account_form_start' ); ?>
        <div class="row">
            <div class="col-lg-6">
                <h4><?php esc_html_e( 'Account Info', 'woocommerce' ); ?></h4>
                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                    <label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="form-control" name="account_first_name" id="account_first_name" autocomplete="given-name" placeholder="First Name" value="<?php echo esc_attr( $user->first_name ); ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                    <label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="form-control" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
                </p>
                <div class="clear"></div>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="form-control" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
                </p>
                <div class="clear"></div>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="email" class="form-control" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
                </p>          
            </div>
            <div class="col-lg-6">
                <h4><?php esc_html_e( 'Change Password', 'codeblowing' ); ?></h4>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'codeblowing' ); ?></label>
                    <input type="password" class="form-control" name="password_current" id="password_current" autocomplete="off" placeholder="Current Password" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'codeblowing' ); ?></label>
                    <input type="password" class="form-control" name="password_1" id="password_1" autocomplete="off" placeholder="New Password" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password_2"><?php esc_html_e( 'Confirm new password', 'codeblowing' ); ?></label>
                    <input type="password" class="form-control" name="password_2" id="password_2" autocomplete="off" placeholder="Confirm New Password" />
                </p>
                <div class="clear"></div>
            </div>
        </div>
        <?php
            /**
             * Hook where additional fields should be rendered.
             *
             * @since 8.7.0
             */
            do_action( 'woocommerce_edit_account_form_fields' );
        ?>

        <?php
            /**
             * My Account edit account form.
             *
             * @since 2.6.0
             */
            do_action( 'woocommerce_edit_account_form' );
        ?>

        <p class="mt-3">
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <button type="submit" class="btn btn-dark<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save Changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
            <input type="hidden" name="action" value="save_account_details" />
        </p>

        <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>
</div>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
