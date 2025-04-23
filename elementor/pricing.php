<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Codeblowing_Elementor_Pricing_Table extends Widget_Base {

    public function get_name() {
        return 'cb-pricing-el-widget';
    }

    public function get_title() {
        return __('Pricing Table', 'code-blowing');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return ['cb-el-category'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_pricing',
            [
                'label' => __('Pricing Table', 'code-blowing'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'code-blowing'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Basic Plan', 'code-blowing'),
            ]
        );

        $this->add_control(
            'price',
            [
                'label'   => __('Price', 'code-blowing'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('$19.99', 'code-blowing'),
            ]
        );

        $this->add_control(
            'feature_title',
            [
                'label'   => __('Feature Title', 'code-blowing'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Services', 'code-blowing'),
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'feature',
            [
                'label'   => __('Feature', 'code-blowing'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Feature 1', 'code-blowing'),
            ]
        );
        $repeater->add_control(
			'feature_icon',
			[
				'label' => esc_html__( 'Icon', 'code-blowing' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'check',
						'check-to-slot',
						'minus',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

        $this->add_control(
            'features',
            [
                'label'       => __('Features', 'code-blowing'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ feature }}}',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => __('Button Text', 'code-blowing'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Get Started', 'code-blowing'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'   => __('Button URL', 'code-blowing'),
                'type'    => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="pricing-table-wrapper">
            <div class="pricing-plan bg-white p-3 px-4 border rounded">
                <div class="price-header py-4 border-bottom">
                    <h4 class="fs-5"><?php echo esc_html($settings['title']); ?></h4>
                    <p class="price my-2"><span class="fs-1 fw-bold text-dark"><?php echo esc_html($settings['price']); ?></span> </p>
                    <a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="btn btn-outline-dark d-block">
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                </div>
                
                <ul class="my-3 feature-list">
                    <li><strong><?php echo esc_html($settings['feature_title']); ?></strong></li>
                    <?php foreach ( $settings['features'] as $feature ) : ?>
                        <li><i class="<?php echo esc_html( $feature['feature_icon']['value'] ); ?>"></i> <?php echo esc_html( $feature['feature'] ); ?></li>
                    <?php endforeach; ?>
                </ul>
                
            </div>
        </div>
        <?php
    }
}