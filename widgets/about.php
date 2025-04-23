<?php
class About_Company_Widget extends WP_Widget {
    /**
     * Constructor to initialize the widget
     */
    public function __construct() {
        parent::__construct(
            'about_company_widget',
            __('About Company', 'text_domain'),
            array('description' => __('A widget to display company info', 'text_domain'))
        );
    }

    /**
     * Outputs the widget content on the front-end
     *
     * @param array $args Display arguments including 'before_widget' and 'after_widget'.
     * @param array $instance The settings for the widget instance.
     */
    public function widget($args, $instance) {
        $socials_links = [
            'facebook'      => 'fa-brands fa-facebook-f',
            'twitter'       => 'fa-brands fa-x-twitter',
            'linkedin'      => 'fa-brands fa-linkedin-in',
            'instagram'     => 'fa-brands fa-instagram',
            'youtube'       => 'fa-brands fa-youtube'
        ];
        echo $args['before_widget'];
        ?>
        <div class="about-company-widget">
            <?php if (!empty($instance['logo'])) : ?>
                <img src="<?php echo esc_url($instance['logo']); ?>" alt="Company Logo" class="company-logo">
            <?php endif; ?>
            <p class="text-white py-3"><?php echo esc_html($instance['description']); ?></p>
            <div class="company-social-links">
                <?php foreach ( $socials_links as $key => $value ) : ?>
                    <?php if (!empty($instance[$key])) : ?>
                        <a href="<?php echo esc_url($instance[$key]); ?>" target="_blank">
                            <i class="<?php echo esc_attr($value); ?>"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Outputs the widget settings form in the admin panel
     *
     * @param array $instance The settings for the widget instance.
     */
    public function form($instance) {
        $logo = !empty($instance['logo']) ? $instance['logo'] : '';
        $description = !empty($instance['description']) ? $instance['description'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('logo'); ?>">Logo:</label>
            <input class="widefat logo-url" id="<?php echo $this->get_field_id('logo'); ?>" name="<?php echo $this->get_field_name('logo'); ?>" type="text" value="<?php echo esc_attr($logo); ?>">
            <button class="upload-cb-logo button button-primary" style="margin-top: .5rem;">Upload Logo</button>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>">Description:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <?php foreach (['facebook', 'twitter', 'linkedin', 'instagram', 'youtube'] as $social) : ?>
            <p>
                <label for="<?php echo $this->get_field_id($social); ?>"><?php echo ucfirst($social); ?> URL:</label>
                <input class="widefat" id="<?php echo $this->get_field_id($social); ?>" name="<?php echo $this->get_field_name($social); ?>" type="text" value="<?php echo !empty($instance[$social]) ? esc_attr($instance[$social]) : ''; ?>">
            </p>
        <?php endforeach; 
    }

    /**
     * Handles updating the widget settings in the admin panel
     *
     * @param array $new_instance New settings for this instance.
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['logo'] = (!empty($new_instance['logo'])) ? esc_url_raw($new_instance['logo']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_text_field($new_instance['description']) : '';
        foreach (['facebook', 'twitter', 'linkedin', 'instagram', 'youtube'] as $social) {
            $instance[$social] = (!empty($new_instance[$social])) ? esc_url_raw($new_instance[$social]) : '';
        }
        return $instance;
    }
}

/**
 * Registers the About Company widget
 */
function codeblowing_register_about_company_widget() {
    register_widget('About_Company_Widget');
}
add_action('widgets_init', 'codeblowing_register_about_company_widget');