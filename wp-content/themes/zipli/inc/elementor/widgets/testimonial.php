<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;

class Zipli_Elementor_Testimonials extends Zipli_Base_Widgets_Swiper {
    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'zipli-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Zipli Testimonials', 'zipli');
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
        return 'eicon-testimonial';
    }

    public function get_script_depends() {
        return ['zipli-elementor-testimonial', 'zipli-elementor-swiper'];
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__('Testimonials', 'zipli'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_icon',
            [
                'label' => esc_html__('Icon', 'zipli'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'testimonial_title',
            [
                'label'   => esc_html__('Title', 'zipli'),
                'type'    => Controls_Manager::TEXT,
                'default'     => '',
            ]
        );

        $repeater->add_control(
            'testimonial_rating',
            [
                'label'   => esc_html__('Rating', 'zipli'),
                'default' => 5,
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    0 => esc_html__('Hidden', 'zipli'),
                    1 => esc_html__('Very poor', 'zipli'),
                    2 => esc_html__('Not that bad', 'zipli'),
                    3 => esc_html__('Average', 'zipli'),
                    4 => esc_html__('Good', 'zipli'),
                    5 => esc_html__('Perfect', 'zipli'),
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label'       => esc_html__('Content', 'zipli'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => esc_html__('Name', 'zipli'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_job',
            [
                'label'   => esc_html__('Job', 'zipli'),
                'default' => 'Design',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_link',
            [
                'label'       => esc_html__('Link to', 'zipli'),
                'placeholder' => esc_html__('https://your-link.com', 'zipli'),
                'type'        => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'testimonial_image',
            [
                'label'      => esc_html__('Choose Image', 'zipli'),
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'       => esc_html__('Items', 'zipli'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'testimonial_layout',
            [
                'label'   => esc_html__('Layout', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Layout 1', 'zipli'),
                    '2' => esc_html__('Layout 2', 'zipli'),
                ]
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'        => esc_html__('Columns', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 1,
                'options'      => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
                'condition' => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => esc_html__('Gutter', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .d-grid' => 'grid-gap:{{SIZE}}{{UNIT}}',
                ],
                'condition'  => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'testimonial_alignment',
            [
                'label'       => esc_html__('Alignment', 'zipli'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__('Left', 'zipli'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'zipli'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'zipli'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'label_block' => false,
                'render_type'        => 'template',
                'default'      => 'left',
                'selectors'   => [
                    '{{WRAPPER}} .elementor-testimonial-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable Carousel', 'zipli'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'zipli'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();


        // WRAPPER STYLE
        $this->start_controls_section(
            'section_style_testimonial_wrapper',
            [
                'label' => esc_html__('Wrapper', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
            'testimonial_width',
            [
                'label'          => esc_html__('Width', 'zipli'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper' => 'max-width: {{SIZE}}{{UNIT}}; margin-right: auto; margin-left: auto',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_height',
            [
                'label'          => esc_html__('Height', 'zipli'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .grid-item .testimonial-content' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['testimonial_layout' => '2']
            ]
        );
        $this->add_responsive_control(
            'padding_testimonial_wrapper',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-item .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_testimonial_wrapper',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-item .testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_testimonial_wrapper',
            [
                'label'     => esc_html__('Background Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-item .testimonial-content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_testimonial_wrapper_hover',
            [
                'label'     => esc_html__('Background Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-item .testimonial-content:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .grid-item .testimonial-content',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-item .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .grid-item .testimonial-content',
            ]
        );

        $this->end_controls_section();

        // Image style
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => esc_html__('Image', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'image_width',
            [
                'label'          => esc_html__('Width', 'zipli'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label'          => esc_html__('Height', 'zipli'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon style
        $this->start_controls_section(
            'section_style_testimonial_icon',
            [
                'label' => esc_html__('Icon', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Icon Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Icon Size', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content style
        $this->start_controls_section(
            'section_style_testimonial_content',
            [
                'label' => esc_html__('Content', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-item .testimonial-content .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-item .testimonial-content:hover .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .grid-item .content',
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Title.
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => esc_html__('Title', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .testimonial-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'size_units' => ['px', 'em', '%'],
                'label'      => esc_html__('Spacing', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => esc_html__('Name', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .grid-item .testimonial-content:hover .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'size_units' => ['px', 'em', '%'],
                'label'      => esc_html__('Spacing', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => esc_html__('Job', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper:hover .job' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->add_responsive_control(
            'job_spacing',
            [
                'size_units' => ['px', 'em', '%'],
                'label'      => esc_html__('Spacing', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .job' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Carousel options
        $this->add_control_carousel(['enable_carousel' => 'yes']);

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-item-wrapper');
            $this->add_render_attribute('row', 'class', 'layout-' . esc_attr($settings['testimonial_layout']));
            $this->add_render_attribute('row', 'class', 'alignment-' . esc_attr($settings['testimonial_alignment']));
            // Carousel
            $this->get_data_elementor_columns();
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');

            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok. ?>>
                <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['testimonials'] as $testimonial): ?>
                        <div <?php $this->print_render_attribute_string('item'); // WPCS: XSS ok. ?>>
                            <div class="testimonial-content">
                                <div class="header-content">
                                    <?php if (!empty($testimonial['testimonial_icon']['value'])) : ?>
                                        <div class="icon">
                                            <?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($testimonial['testimonial_rating'] && $testimonial['testimonial_rating'] > 0) {
                                        echo '<div class="elementor-testimonial-rating">';
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $testimonial['testimonial_rating']) {
                                                echo '<i class="zipli-icon-star-1 active" aria-hidden="true"></i>';
                                            }
                                        }
                                        echo '</div>';
                                    } ?>
                                    <?php if ($testimonial['testimonial_title']) { ?>
                                        <div class="testimonial-title"><?php echo esc_html($testimonial['testimonial_title']); ?></div>
                                    <?php } ?>
                                    <?php if ($settings['testimonial_layout'] !== '2') {
                                        $this->render_image($settings, $testimonial);
                                    } ?>
                                    <?php if (!empty($testimonial['testimonial_content'])) { ?>
                                        <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                    <?php } ?>
                                </div>
                                <div class="details">
                                    <?php if ($settings['testimonial_layout'] === '2') {
                                        $this->render_image($settings, $testimonial);
                                    } ?>
                                    <div class="details-info">
                                        <?php $testimonial_name_html = $testimonial['testimonial_name'];

                                        if (!empty($testimonial['testimonial_link']['url'])) {
                                            $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                        }

                                        printf('<span class="name">%s</span>', $testimonial_name_html);
                                        ?>
                                        <?php if ($testimonial['testimonial_job']) { ?>
                                             <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                        <?php } ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php $this->render_swiper_pagination_navigation();?>
            <?php
        }
    }

    private function render_image($settings, $testimonial) {
        if (!empty($testimonial['testimonial_image']['url'])) :
            ?>
            <div class="elementor-testimonial-image">
                <?php
                $testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
                $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                ?>
            </div>
        <?php
        endif;
    }
}

$widgets_manager->register(new Zipli_Elementor_Testimonials());

