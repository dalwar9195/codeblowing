<?php
/**
 * Add custom fields to WooCommerce product edit screen.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action('woocommerce_product_options_general_product_data', 'codeblowing_add_custom_fields_to_product');

function codeblowing_add_custom_fields_to_product() {
    // Text Fields
    woocommerce_wp_text_input([
        'id'          => '_product_live_url',
        'label'       => __('Live URL', 'codeblowing'),
        'placeholder' => __('Enter live URL', 'codeblowing'),
        'description' => __('This is a field for showing the live URL.', 'codeblowing'),
        'desc_tip'    => true,
    ]);

    woocommerce_wp_text_input([
        'id'          => '_cb_product_version',
        'label'       => __('Product Version', 'codeblowing'),
        'placeholder' => __('Enter product version', 'codeblowing'),
        'description' => __('This is a field for showing the product version.', 'codeblowing'),
        'desc_tip'    => true,
    ]);

    // Select Fields
    woocommerce_wp_select([
        'id'          => '_product_type',
        'label'       => __('Product Type', 'codeblowing'),
        'description' => __('Choose a product type.', 'codeblowing'),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => [
            ''                    => __('Select an option', 'codeblowing'),
            'PSD Template'        => __('PSD Template', 'codeblowing'),
            'HTML Template'       => __('HTML Template', 'codeblowing'),
            'WordPress Theme'     => __('WordPress Theme', 'codeblowing'),
            'WordPress Plugin'    => __('WordPress Plugin', 'codeblowing'),
            'Laravel Application' => __('Laravel Application', 'codeblowing'),
        ],
    ]);

    woocommerce_wp_select([
        'id'          => '_high_resolution',
        'label'       => __('High Resolution', 'codeblowing'),
        'description' => __('Is the product high resolution?', 'codeblowing'),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => [
            ''    => __('Select an option', 'codeblowing'),
            'Yes' => __('Yes', 'codeblowing'),
            'No'  => __('No', 'codeblowing'),
        ],
    ]);

    woocommerce_wp_select([
        'id'          => '_image_included',
        'label'       => __('Images Included', 'codeblowing'),
        'description' => __('Are images included?', 'codeblowing'),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => [
            ''    => __('Select an option', 'codeblowing'),
            'Yes' => __('Yes', 'codeblowing'),
            'No'  => __('No', 'codeblowing'),
        ],
    ]);

    // Multi-select Fields
    $post_id = get_the_ID();
    $compatible_browsers = get_post_meta($post_id, '_compatible_browsers', true);
    $frontend_framework  = get_post_meta($post_id, '_frontend_framework', true);
    $wordpress_version   = get_post_meta($post_id, '_wordpress_version', true);
    ?>

    <p class="form-field">
        <label for="_compatible_browsers"><?php esc_html_e('Compatible Browsers', 'codeblowing'); ?></label>
        <select id="_compatible_browsers" name="_compatible_browsers[]" class="select2 select short" multiple="multiple">
            <?php
            $browsers = ['Mozilla', 'Chrome', 'Opera', 'Edge', 'Safari'];
            foreach ($browsers as $browser) {
                printf(
                    '<option value="%1$s" %2$s>%1$s</option>',
                    esc_attr($browser),
                    selected(in_array($browser, (array) $compatible_browsers, true), true, false)
                );
            }
            ?>
        </select>
    </p>

    <p class="form-field">
        <label for="_frontend_framework"><?php esc_html_e('Frontend Framework', 'codeblowing'); ?></label>
        <select id="_frontend_framework" name="_frontend_framework[]" class="select2 short" multiple="multiple">
            <?php
            $frameworks = ['Bootstrap', 'Tailwind', 'React JS', 'Next JS', 'Vue JS'];
            foreach ($frameworks as $framework) {
                printf(
                    '<option value="%1$s" %2$s>%1$s</option>',
                    esc_attr($framework),
                    selected(in_array($framework, (array) $frontend_framework, true), true, false)
                );
            }
            ?>
        </select>
    </p>

    <p class="form-field">
        <label for="_wordpress_version"><?php esc_html_e('WordPress Version', 'codeblowing'); ?></label>
        <select id="_wordpress_version" name="_wordpress_version[]" class="select2 select short" multiple="multiple">
            <?php
            $versions = [
                'WordPress 6.7', 'WordPress 6.6', 'WordPress 6.5',
                'WordPress 6.4', 'WordPress 6.3', 'WordPress 6.2',
                'WordPress 6.1', 'WordPress 6.0'
            ];
            foreach ($versions as $version) {
                printf(
                    '<option value="%1$s" %2$s>%1$s</option>',
                    esc_attr($version),
                    selected(in_array($version, (array) $wordpress_version, true), true, false)
                );
            }
            ?>
        </select>
    </p>
    <?php
}

/**
 * Save custom fields from WooCommerce product edit screen.
 */
add_action('woocommerce_process_product_meta', 'codeblowing_save_custom_fields');

function codeblowing_save_custom_fields($post_id) {
    // Sanitize and save single-value fields
    $fields = [
        '_product_type',
        '_product_live_url',
        '_cb_product_version',
        '_high_resolution',
        '_image_included',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Sanitize and save multi-select fields
    $multi_fields = [
        '_compatible_browsers',
        '_frontend_framework',
        '_wordpress_version',
    ];

    foreach ($multi_fields as $field) {
        if (isset($_POST[$field]) && is_array($_POST[$field])) {
            $sanitized = array_map('sanitize_text_field', $_POST[$field]);
            update_post_meta($post_id, $field, $sanitized);
        } else {
            delete_post_meta($post_id, $field);
        }
    }
}