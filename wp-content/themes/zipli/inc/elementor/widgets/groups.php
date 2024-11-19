<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


/**
 * Class Zipli_Elementor_Group
 */
class Zipli_Elementor_Group extends Zipli_Base_Widgets_Swiper {

    public function get_name() {
        return 'zipli-groups';
    }

    public function get_title() {
        return esc_html__('Zipli Groups', 'zipli');
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
        return ['zipli-elementor-groups', 'zipli-elementor-swiper'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Group', 'zipli'),
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
            'group_style',
            [
                'label'        => esc_html__('Style', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'options'      => [
                    'group-style-1' => esc_html__('Style 1', 'zipli'),
                    'group-style-2' => esc_html__('Style 2', 'zipli'),
                    'group-style-3' => esc_html__('Style 3', 'zipli'),
                ],
                'render_type'  => 'template',
                'default'      => 'group-style-1',
                'prefix_class' => 'elementor-'
            ]
        );

        $this->add_control(
            'enable_style_effect',
            [
                'label'        => esc_html__('Enable Effect Sticky', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'elementor-style-effect-',
                'condition'    => [
                    'group_style' => 'group-style-1'
                ]
            ]
        );

        $this->add_control(
            'includes_ids',
            [
                'label'       => esc_html__('Includes', 'zipli'),
                'type'        => 'groups',
                'label_block' => true,
                'multiple'    => true,
            ]
        );

        $this->add_control(
            'excludes_ids',
            [
                'label'       => esc_html__('Excludes', 'zipli'),
                'type'        => 'groups',
                'label_block' => true,
                'multiple'    => true,
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
                'label'      => esc_html__('Columns', 'zipli'),
                'type'       => \Elementor\Controls_Manager::SELECT,
                'default'    => 3,
                'options'    => [1 => 1, 2 => 2, 3 => 3],
                'selectors'  => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
                'condition' => ['enable_carousel!'=>'yes']
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

        $this->start_controls_section(
            'inner_style',
            [
                'label' => esc_html__('Inner', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'inner_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .group-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .group-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'Icon_style',
            [
                'label' => esc_html__('Icon', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .group-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'group_style' => 'group-style-3'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_vertical_spacing',
            [
                'label'      => esc_html__('Vertical', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '100' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .group-icon-wrap' => 'top: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'group_style' => 'group-style-5'
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_horizontal_spacing',
            [
                'label'      => esc_html__('Horizontal', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '100' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .group-icon-wrap' => 'left: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'group_style' => 'group-style-5'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .grid-item .group-title',
            ]
        );

        $this->start_controls_tabs('title_color_tabs');

        $this->start_controls_tab('title_colors_normal',
            [
                'label' => esc_html__('Normal', 'zipli'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .group-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_colors_hover',
            [
                'label' => esc_html__('Hover', 'zipli'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .group-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->add_control_carousel(['enable_carousel' => 'yes']);

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-group-wrapper');

        $this->get_data_elementor_columns();

        $style = $settings['group_style'];

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
                        <?php get_template_part('template-parts/group/item', $style); ?>
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

    public static function get_query_args($settings) {
        $query_args = [
            'posts_per_page'      => $settings['posts_per_page'],
            'post_type'           => 'zipli_group',
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post__in'            => $settings['includes_ids'],
            'post__not_in'        => $settings['excludes_ids'],
            'post_status'         => 'publish',
        ];

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

$widgets_manager->register(new Zipli_Elementor_Group());