<?php
function codeblowing_single_product_custom_metabox_value(){
    global $product;
    $product_version = get_post_meta($product->get_id(), '_cb_product_version', true);
    $product_type = get_post_meta($product->get_id(), '_product_type', true);
    $high_resolution = get_post_meta($product->get_id(), '_high_resolution', true);
    $image_included = get_post_meta($product->get_id(), '_image_included', true);
    $compatible_browsers = get_post_meta($product->get_id(), '_compatible_browsers', true);
    $frontend_framework = get_post_meta($product->get_id(), '_frontend_framework', true);
    $files_included = get_post_meta($product->get_id(), '_files_included', true);
    $wordpress_version = get_post_meta($product->get_id(), '_wordpress_version', true);
    if( !empty( $product_type ) || !empty( $high_resolution ) || !empty( $image_included ) || !empty( $compatible_browsers ) || !empty( $frontend_framework ) || !empty( $files_included ) || !empty( $wordpress_version )) :
    ?>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-white product-single-meta mb-0">
                <?php if( ! empty( $product_type ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">Product Type:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary"><?php echo $product_type; ?></div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $product_version ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">Product Version:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary"><?php echo $product_version; ?></div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $high_resolution ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">High Resolution:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary"><?php echo $high_resolution; ?></div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $compatible_browsers ) && is_array( $compatible_browsers ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">Compatible Browsers:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary">
                            <?php 
                                if ( ! empty( $compatible_browsers ) ) {
                                    echo implode( ', ', $compatible_browsers ); // Display selected values
                                }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $frontend_framework ) && is_array( $frontend_framework ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">Frontend Framework:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary">
                            <?php 
                                if ( ! empty( $frontend_framework ) ) {
                                    echo implode( ', ', $frontend_framework ); // Display selected values
                                }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $wordpress_version ) && is_array( $wordpress_version ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">WordPress Version:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary">
                            <?php 
                                if ( ! empty( $wordpress_version ) ) {
                                    echo implode( ', ', $wordpress_version ); // Display selected values
                                }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php if( ! empty( $image_included ) ) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <h4 class="m-0 fs-6 text-dark fw-bold">Image Included:</h4>
                        </div>
                    </td>
                    <td>
                        <div class="text-capitalize text-secondary">
                            <?php 
                                echo $image_included;
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php
    endif;
}


add_action('woocommerce_product_options_general_product_data', 'codeblowing_add_custom_field_to_product');

function codeblowing_add_custom_field_to_product() {

    woocommerce_wp_text_input(
        array(
            'id'          => '_product_live_url', // Field ID
            'label'       => __('Live URL', 'textdomain'), // Field Label
            'placeholder' => __('Enter live url', 'textdomain'), // Placeholder
            'description' => __('This is a field for showing live url.', 'textdomain'), // Description
            'desc_tip'    => true, // Tooltip
            'type'        => 'text', // Input type
        )
    );

    woocommerce_wp_text_input(
        array(
            'id'          => '_cb_product_version', // Field ID
            'label'       => __('Product Version', 'textdomain'), // Field Label
            'placeholder' => __('Enter product version', 'textdomain'), // Placeholder
            'description' => __('This is a field for showing version.', 'textdomain'), // Description
            'desc_tip'    => true, // Tooltip
            'type'        => 'text', // Input type
        )
    );

    woocommerce_wp_select( array(
        'id'          => '_product_type',
        'label'       => __( 'Product Type', 'codeblowing' ),
        'description' => __( 'Choose an option for product type.', 'codeblowing' ),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => array(
            ''                      => __( 'Select an option', 'codeblowing' ),
            'PSD Template'          => __( 'PSD Template', 'codeblowing' ),
            'HTML Template'         => __( 'HTML Template', 'codeblowing' ),
            'WordPress Theme'       => __( 'WordPress Theme', 'codeblowing' ),
            'WordPress Plugin'      => __( 'WordPress Plugin', 'codeblowing' ),
            'Laravel Application'   => __( 'Laravel Application', 'codeblowing' ),
        ),
    ));
    woocommerce_wp_select( array(
        'id'          => '_high_resolution',
        'label'       => __( 'High Resolution', 'codeblowing' ),
        'description' => __( 'Choose an option for high resolution.', 'codeblowing' ),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => array(
            ''          => __( 'Select an option', 'codeblowing' ),
            'Yes'       => __( 'Yes', 'codeblowing' ),
            'No'        => __( 'No', 'codeblowing' )
        ),
    ));

    woocommerce_wp_select( array(
        'id'          => '_image_included',
        'label'       => __( 'Images included', 'codeblowing' ),
        'description' => __( 'Choose an option for high resolution.', 'codeblowing' ),
        'desc_tip'    => true,
        'class'       => 'select2 select short',
        'options'     => array(
            ''          => __( 'Select an option', 'codeblowing' ),
            'Yes'       => __( 'Yes', 'codeblowing' ),
            'No'        => __( 'No', 'codeblowing' )
        ),
    ));

    $compatible_browsers = get_post_meta( get_the_id(), '_compatible_browsers', true );
    $frontend_framework = get_post_meta( get_the_id(), '_frontend_framework', true );
    $wordpress_version = get_post_meta( get_the_id(), '_wordpress_version', true );
?>
    <p class="form-field">
        <label for="_compatible_browsers"><?php esc_html_e( 'Compatible Browsers', 'codeblowing' ); ?></label>
        <select id="_compatible_browsers" name="_compatible_browsers[]" class="select2 select short" multiple="multiple">
            <option value="Mozilla" <?php selected( in_array( 'Mozilla', (array) $compatible_browsers ), true ); ?>>Mozilla</option>
            <option value="Chrome" <?php selected( in_array( 'Chrome', (array) $compatible_browsers ), true ); ?>>Chrome</option>
            <option value="Opera" <?php selected( in_array( 'Opera', (array) $compatible_browsers ), true ); ?>>Opera</option>
            <option value="Edge" <?php selected( in_array( 'Edge', (array) $compatible_browsers ), true ); ?>>Edge</option>
            <option value="Safari" <?php selected( in_array( 'Safari', (array) $compatible_browsers ), true ); ?>>Safari</option>
        </select>
    </p>

    <p class="form-field">
        <label for="_frontend_framework"><?php esc_html_e( 'Frontend Framework', 'codeblowing' ); ?></label>
        <select id="_frontend_framework" name="_frontend_framework[]" class="select2 short" multiple="multiple">
            <option value="Bootstrap" <?php selected( in_array( 'Bootstrap', (array) $frontend_framework ), true ); ?>>Bootstrap</option>
            <option value="Tailwind" <?php selected( in_array( 'Tailwind', (array) $frontend_framework ), true ); ?>>Tailwind</option>
            <option value="React JS" <?php selected( in_array( 'React JS', (array) $frontend_framework ), true ); ?>>React JS</option>
            <option value="Next JS" <?php selected( in_array( 'Next JS', (array) $frontend_framework ), true ); ?>>Next JS</option>
            <option value="Vue JS" <?php selected( in_array( 'Vue JS', (array) $frontend_framework ), true ); ?>>Vue JS</option>
        </select>
    </p>

    <p class="form-field">
        <label for="_wordpress_version"><?php esc_html_e( 'WordPress Version', 'codeblowing' ); ?></label>
        <select id="_wordpress_version" name="_wordpress_version[]" class="select2 select short" multiple="multiple">
            <option value="WordPress 6.7" <?php selected( in_array( 'WordPress 6.7', (array) $wordpress_version ), true ); ?>>WordPress 6.7</option>
            <option value="WordPress 6.6" <?php selected( in_array( 'WordPress 6.6', (array) $wordpress_version ), true ); ?>>WordPress 6.6</option>
            <option value="WordPress 6.5" <?php selected( in_array( 'WordPress 6.5', (array) $wordpress_version ), true ); ?>>WordPress 6.5</option>
            <option value="WordPress 6.4" <?php selected( in_array( 'WordPress 6.4', (array) $wordpress_version ), true ); ?>>WordPress 6.4</option>
            <option value="WordPress 6.3" <?php selected( in_array( 'WordPress 6.3', (array) $wordpress_version ), true ); ?>>WordPress 6.3</option>
            <option value="WordPress 6.2" <?php selected( in_array( 'WordPress 6.2', (array) $wordpress_version ), true ); ?>>WordPress 6.2</option>
            <option value="WordPress 6.1" <?php selected( in_array( 'WordPress 6.1', (array) $wordpress_version ), true ); ?>>WordPress 6.1</option>
            <option value="WordPress 6.0" <?php selected( in_array( 'WordPress 6.0', (array) $wordpress_version ), true ); ?>>WordPress 6.0</option>
        </select>
    </p>
    <?php
}

add_action('woocommerce_process_product_meta', 'codeblowing_save_product_custom_field_value');

function codeblowing_save_product_custom_field_value($post_id) {
    $product_type = isset($_POST['_product_type']) ? sanitize_text_field($_POST['_product_type']) : '';
    $product_live_url = isset($_POST['_product_live_url']) ? sanitize_text_field($_POST['_product_live_url']) : '';
    $product_version = isset($_POST['_cb_product_version']) ? sanitize_text_field($_POST['_product_version']) : '';
    $high_resolution = isset($_POST['_high_resolution']) ? sanitize_text_field($_POST['_high_resolution']) : '';
    $image_included = isset($_POST['_image_included']) ? sanitize_text_field($_POST['_image_included']) : '';
    $compatible_browsers = isset($_POST['_compatible_browsers']) ? sanitize_text_field($_POST['_compatible_browsers']) : '';
    $frontend_framework = isset($_POST['_frontend_framework']) ? sanitize_text_field($_POST['_frontend_framework']) : '';
    $files_included = isset($_POST['_files_included']) ? sanitize_text_field($_POST['_files_included']) : '';
    $wordpress_version = isset($_POST['_wordpress_version']) ? sanitize_text_field($_POST['_wordpress_version']) : '';
    update_post_meta($post_id, '_product_type', $product_type);
    update_post_meta($post_id, '_product_live_url', $product_live_url);
    update_post_meta($post_id, '_cb_product_version', $product_version);
    update_post_meta($post_id, '_high_resolution', $high_resolution);
    update_post_meta($post_id, '_image_included', $image_included);
    update_post_meta($post_id, '_compatible_browsers', $compatible_browsers);
    update_post_meta($post_id, '_frontend_framework', $frontend_framework);
    update_post_meta($post_id, '_wordpress_version', $wordpress_version);

    if ( isset( $_POST['_compatible_browsers'] ) ) {
        $frontend_framework = array_map( 'sanitize_text_field', $_POST['_compatible_browsers'] );
        update_post_meta( $post_id, '_compatible_browsers', $frontend_framework );
    } else {
        // If no values are selected, remove the meta key
        delete_post_meta( $post_id, '_frontend_framework' );
    }

    if ( isset( $_POST['_frontend_framework'] ) ) {
        $frontend_framework = array_map( 'sanitize_text_field', $_POST['_frontend_framework'] );
        update_post_meta( $post_id, '_frontend_framework', $frontend_framework );
    } else {
        // If no values are selected, remove the meta key
        delete_post_meta( $post_id, '_frontend_framework' );
    }

    if ( isset( $_POST['_wordpress_version'] ) ) {
        $wordpress_version = array_map( 'sanitize_text_field', $_POST['_wordpress_version'] );
        update_post_meta( $post_id, '_wordpress_version', $wordpress_version );
    } else {
        // If no values are selected, remove the meta key
        delete_post_meta( $post_id, '_wordpress_version' );
    }
}