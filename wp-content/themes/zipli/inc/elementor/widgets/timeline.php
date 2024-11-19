<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;

class Zipli_Elementor_Timeline extends Zipli_Base_Widgets_Swiper
{
    /**
     * Get widget name.
     *
     * Retrieve timeline widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'zipli-timeline';
    }

    /**
     * Get widget title.
     *
     * Retrieve timeline widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Zipli Timeline', 'zipli');
    }

    /**
     * Get widget icon.
     *
     * Retrieve timeline widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-carousel';
    }

    public function get_script_depends()
    {
        return ['zipli-elementor-timeline', 'zipli-elementor-swiper'];
    }

    public function get_categories()
    {
        return array('zipli-addons');
    }

    /**
     * Register timeline widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_timeline_items',
            [
                'label' => esc_html__('Items', 'zipli'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'timeline_title',
            [
                'label' => esc_html__('Title', 'zipli'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'timeline_desc',
            [
                'label' => esc_html__('Content', 'zipli'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            ]
        );

        $repeater->add_control(
            'timeline_link',
            [
                'label' => esc_html__('Link to', 'zipli'),
                'placeholder' => esc_html__('https://your-link.com', 'zipli'),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'timeline_image',
            [
                'label' => esc_html__('Choose Image', 'zipli'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'timelines',
            [
                'label' => esc_html__('Items', 'zipli'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ timeline_title }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'timeline_image',
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__('Columns', 'zipli'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
                'condition' => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label' => esc_html__('Gutter', 'zipli'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-gap:{{SIZE}}{{UNIT}}',
                ],
                'condition' => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable Carousel', 'zipli'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('View', 'zipli'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();

        // Title.
        $this->start_controls_section(
            'section_style_timeline_title',
            [
                'label' => esc_html__('Title', 'zipli'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label' => esc_html__('Color', 'zipli'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .timeline-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_text_color_hover',
            [
                'label' => esc_html__('Color Hover', 'zipli'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .timeline-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .timeline-title',
            ]
        );

        $this->add_responsive_control(
            'padding_title',
            [
                'label' => esc_html__('Padding', 'zipli'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Description
        $this->start_controls_section(
            'section_style_timeline_desc',
            [
                'label' => esc_html__('Description', 'zipli'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_text_color',
            [
                'label' => esc_html__('Color', 'zipli'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .timeline-desc',
            ]
        );

        $this->add_responsive_control(
            'padding_desc',
            [
                'label' => esc_html__('Padding', 'zipli'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Carousel options
        $this->add_control_carousel(['enable_carousel' => 'yes']);

    }

    /**
     * Render timeline widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['timelines']) && is_array($settings['timelines'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-timeline-item-wrapper');
            $this->add_render_attribute('inner', 'class', 'elementor-timeline-inner');
            // Carousel
            $this->get_data_elementor_columns();
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-timeline-item');
            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok. ?>>
                <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['timelines'] as $timeline): ?>
                        <div <?php $this->print_render_attribute_string('item'); // WPCS: XSS ok. ?>>
                            <div <?php $this->print_render_attribute_string('inner'); // WPCS: XSS ok. ?>>
                                <div class="timeline-imgwrap">
                                    <?php $this->render_image($settings, $timeline); ?>
                                </div>
                                <div class="timeline-content">

                                    <?php $timeline_title = $timeline['timeline_title'];
                                    if (!empty($timeline['timeline_link']['url'])) {
                                        $timeline_title = '<a href="' . esc_url($timeline['timeline_link']['url']) . '">' . esc_html($timeline_title) . '</a>';
                                    }
                                    printf('<h3 class="timeline-title">%s</h3>', $timeline_title);
                                    ?>

                                    <?php if (!empty($timeline['timeline_desc'])) { ?>
                                        <div class="timeline-desc"><?php echo sprintf('%s', $timeline['timeline_desc']); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php $this->render_swiper_pagination_navigation(); ?>
            <?php
        }
    }

    private function render_image($settings, $timeline)
    {
        if (!empty($timeline['timeline_image']['url'])) :
            ?>
            <div class="timeline-image">
                <?php
                $timeline['timeline_image_size'] = $settings['timeline_image_size'];
                $timeline['timeline_image_custom_dimension'] = $settings['timeline_image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($timeline, 'timeline_image');
                ?>
            </div>
        <?php
        endif;
    }
}

$widgets_manager->register(new Zipli_Elementor_Timeline());

