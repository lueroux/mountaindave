<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;


/**
 * Class Zipli_Elementor_Adventure
 */
class Zipli_Elementor_Adventure extends Zipli_Base_Widgets_Swiper {

    public function get_name() {
        return 'zipli-adventures';
    }

    public function get_title() {
        return esc_html__('Zipli Adventure', 'zipli');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    public function get_script_depends() {
        return ['zipli-elementor-adventures', 'zipli-elementor-swiper'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Adventure', 'zipli'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'zipli'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label'    => __('Include Categories', 'zipli'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_adventure_cat(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'adventure_style',
            [
                'label'        => esc_html__('Style', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'options'      => [
                    'adventure-style-1' => esc_html__('Style 1', 'zipli'),
                    'adventure-style-2' => esc_html__('Style 2', 'zipli'),
                    'adventure-style-3' => esc_html__('Style 3', 'zipli'),
                ],
                'render_type'  => 'template',
                'default'      => 'adventure-style-1',
                'prefix_class' => 'elementor-'
            ]
        );

        $this->add_control(
            'enable_style_masonory',
            [
                'label'        => esc_html__('Enable Style Masonory', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'condition'    => ['adventure_style' => 'adventure-style-1'],
                'prefix_class' => 'elementor-style-masonory-'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => esc_html__('Date', 'zipli'),
                    'post_title' => esc_html__('Title', 'zipli'),
                    'menu_order' => esc_html__('Menu Order', 'zipli'),
                    'rand'       => esc_html__('Random', 'zipli'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__('ASC', 'zipli'),
                    'desc' => esc_html__('DESC', 'zipli'),
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'     => esc_html__('Columns', 'zipli'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
                'condition' => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label'      => esc_html__('Spacing', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 30
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .d-grid' => 'grid-gap:{{SIZE}}{{UNIT}}',
                ],
                'condition'  => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label'     => esc_html__('Enable Carousel', 'zipli'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => ['enable_style_masonory!' => 'yes']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label'     => esc_html__('Pagination', 'zipli'),
                'condition' => ['enable_carousel!' => 'yes']
            ]

        );

        $this->add_control(
            'pagination_type',
            [
                'label'   => esc_html__('Pagination', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''                      => esc_html__('None', 'zipli'),
                    'numbers'               => esc_html__('Numbers', 'zipli'),
                    'prev_next'             => esc_html__('Previous/Next', 'zipli'),
                    'numbers_and_prev_next' => esc_html__('Numbers', 'zipli') . ' + ' . esc_html__('Previous/Next', 'zipli'),
                ],
            ]
        );

        $this->add_control(
            'pagination_page_limit',
            [
                'label'     => esc_html__('Page Limit', 'zipli'),
                'default'   => '5',
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
            [
                'label'     => esc_html__('Alignment', 'zipli'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'zipli'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'zipli'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'zipli'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} ul.page-numbers' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel([
            'relation' => 'and',
            'terms'    => [
                [
                    'name'     => 'enable_carousel',
                    'operator' => '==',
                    'value'    => 'yes',
                ],
                [
                    'name'     => 'enable_style_masonory',
                    'operator' => '!==',
                    'value'    => 'yes',
                ],
            ],
        ], 'conditions');

    }

    public static function get_query_args($settings) {
        $query_args = [
            'post_type'           => 'zipli_adventure',
            'posts_per_page'      => $settings['posts_per_page'],
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish',
        ];

        if (!empty($settings['cat'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'zipli_adventure_cat',
                'field'    => 'slug',
                'terms'    => $settings['cat'],
                'operator' => 'IN'
            ];
        }

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-adventure-wrapper');
        $this->get_data_elementor_columns();
        $style = $settings['adventure_style'];
        $query = $this->query_posts();
        if (!$query->found_posts) {
            return;
        }

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('row'); ?>>
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div <?php $this->print_render_attribute_string('item'); ?>>
                        <?php include get_theme_file_path('template-parts/adventure/item-' . $style . '.php'); ?>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <?php $this->render_swiper_pagination_navigation();
        if ($settings['pagination_type'] && !empty($settings['pagination_type'])) {
            $this->render_loop_footer();
        }
        wp_reset_postdata();

    }

    protected function get_adventure_cat() {
        $cats    = get_terms(array(
                'taxonomy'   => 'zipli_adventure_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if ($cats && !is_wp_error($cats)) {
            foreach ($cats as $cat) {
                $results[$cat->slug] = $cat->name;
            }
        }
        return $results;

    }

    protected function render_loop_footer() {

        $parent_settings = $this->get_settings();
        if ('' === $parent_settings['pagination_type']) {
            return;
        }

        $page_limit = $this->query_posts()->max_num_pages;
        if ('' !== $parent_settings['pagination_page_limit']) {
            $page_limit = min($parent_settings['pagination_page_limit'], $page_limit);
        }

        if (2 > $page_limit) {
            return;
        }

        $this->add_render_attribute('pagination', 'class', 'elementor-pagination');

        $has_numbers = in_array($parent_settings['pagination_type'], ['numbers', 'numbers_and_prev_next']);

        $links = [];

        if ($has_numbers) {
            $links = paginate_links([
                'type'               => 'list',
                'current'            => $this->get_current_page(),
                'total'              => $page_limit,
                'prev_text'          => '<i class="zipli-icon-chevron-left"></i>',
                'next_text'          => '<i class="zipli-icon-chevron-right"></i>',
                'before_page_number' => '<span class="elementor-screen-only">' . esc_html__('Page', 'zipli') . '</span>',
            ]);
        }

        ?>
        <nav class="pagination">
            <div class="nav-links">
                <?php printf('%s', $links); ?>
            </div>
        </nav>
        <?php
    }

    public function get_current_page() {
        if ('' === $this->get_settings('pagination_type')) {
            return 1;
        }

        return max(1, get_query_var('paged'), get_query_var('page'));
    }

}

$widgets_manager->register(new Zipli_Elementor_Adventure());