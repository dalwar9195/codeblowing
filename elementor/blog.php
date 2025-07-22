<?php
/**
 * Elementor Blog Widget
 *
 * This widget displays a list of blog posts with customizable settings.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Codeblowing_Elementor_Blog_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'cb-blog-el-widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Blog Posts', 'code-blowing' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'cb-el-category' ];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to customize the widget settings.
     */
    protected function _register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'code-blowing' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number of Posts', 'code-blowing' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 12,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Order By', 'code-blowing' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => __( 'Date', 'code-blowing' ),
                    'title' => __( 'Title', 'code-blowing' ),
                    'rand' => __( 'Random', 'code-blowing' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'code-blowing' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __( 'Ascending', 'code-blowing' ),
                    'desc' => __( 'Descending', 'code-blowing' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'code-blowing' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'code-blowing' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __( 'Excerpt Color', 'code-blowing' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Query posts
        $query_args = [
            'post_type'         => 'post',
            'posts_per_page'    => $settings['posts_per_page'],
            'orderby'           => $settings['orderby'],
            'order'             => $settings['order'],
        ];

        $blog_posts = new WP_Query( $query_args );

        if ( $blog_posts->have_posts() ) : ?>
            <div class="row">
                <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-post-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="blog-post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="blog-post-content p-3 bg-white">
                            <div class="post-meta border-bottom pb-2 d-flex justify-content-between align-items-center">
                                <span class="text-secondary"><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
                                <span class="text-secondary"><i class="fa-solid fa-calendar-days"></i> <?php the_time('F j, Y'); ?></span>
                            </div>
                            <h3 class="blog-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="blog-post-excerpt">
                                <p><?php echo wp_trim_words( get_the_content(), 20, '' ); ?></p>
                            </div>
                            <div class="mt-3">
                                <a href="<?php echo esc_url( get_the_permalink()); ?>" class="btn btn-dark">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php _e( 'No posts found.', 'code-blowing' ); ?></p>
        <?php endif;
    }
}