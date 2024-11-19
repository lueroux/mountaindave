<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Zipli_Elementor_Slide_Scrolling extends Elementor\Widget_Base {

    public function get_categories() {
        return array('zipli-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'zipli-slide-scrolling';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Zipli Slide Scrolling', 'zipli');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-image';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_scrolling',
            [
                'label' => esc_html__('Items', 'zipli'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'scrolling_title',
            [
                'label'       => esc_html__('Scrolling name', 'zipli'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Scrolling Name', 'zipli'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'scrolling_image',
            [
                'label' => esc_html__('Choose Image', 'zipli'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );
        $this->add_responsive_control(
            'duration',
            [
                'label'     => esc_html__('Scrolling duration', 'zipli'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 10,
                'selectors' => [
                    '{{WRAPPER}} .elementor-scrolling-inner' => 'animation-duration: {{VALUE}}s',
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__('Link to', 'zipli'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'zipli'),
            ]
        );


        $repeater->add_control(
            'item_text_stroke',
            [
                'label'     => esc_html__('Text Stroke', 'zipli'),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.scrolling-title a' => ' -webkit-text-fill-color: transparent;',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'item_width',
            [
                'label'      => esc_html__('Width Stroke', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'condition'  => [
                    'item_text_stroke' => 'yes',
                ],

                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.scrolling-title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $repeater->add_control(
            'item_color_stroke',
            [
                'label'     => esc_html__('Color Stroke', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.scrolling-title a' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'item_text_stroke' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'scrolling',
            [
                'label'       => esc_html__('Items', 'zipli'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ scrolling_title }}}',
            ]
        );


        $this->add_control(
            'heading_settings',
            [
                'label'     => esc_html__('Settings', 'zipli'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'scrolling_align',
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
                    '{{WRAPPER}} .elementor-scrolling-wrapper .elementor-scrolling-item-inner' => 'align-items: {{VALUE}};',
                ],
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
                'default'            => [
                    'size' => 30
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-scrolling-wrapper .elementor-scrolling-item'  => 'margin-left: calc({{SIZE}}{{UNIT}}/2); margin-right: calc({{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label'        => esc_html__('Border', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'prefix_class' => 'zipli-scrolling-border-'
            ]
        );

        $this->add_control(
            'rtl',
            [
                'label'        => esc_html__('Direction Right/Left', 'zipli'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'ltr',
                'options'      => [
                    'ltr' => esc_html__('Left', 'zipli'),
                    'rtl' => esc_html__('Right', 'zipli'),
                ],
                'prefix_class' => 'zipli-scrolling-',
            ]
        );

        $this->end_controls_section();

        // WRAPPER STYLE
        $this->start_controls_section(
            'section_scrolling_wrapper',
            [
                'label' => esc_html__('Wrapper', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'color_scrolling_wrapper',
            [
                'label'     => esc_html__('Background Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-scrolling-inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_scrolling_wrapper',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-scrolling-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_scrolling_item',
            [
                'label' => esc_html__('Item', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'scrolling_item',
                'selector' => '{{WRAPPER}} .elementor-scrolling-item-inner',
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-scrolling-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Title.
        $this->start_controls_section(
            'section_style_scrolling_title',
            [
                'label' => esc_html__('Title', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_stroke',
            [
                'label'     => esc_html__('Text Stroke', 'zipli'),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .scrolling-title a' => ' -webkit-text-fill-color: transparent;',
                ],

            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'      => esc_html__('Width Stroke', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'condition'  => [
                    'text_stroke' => 'yes',
                ],

                'selectors' => [
                    '{{WRAPPER}} .scrolling-title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'color_stroke',
            [
                'label'     => esc_html__('Color Stroke', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scrolling-title a' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'text_stroke' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'color_stroke_hover',
            [
                'label'     => esc_html__('Color Stroke Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scrolling-title:hover a' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'text_stroke' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .scrolling-title a' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
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
                    '{{WRAPPER}} .scrolling-title:hover a' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .scrolling-title',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['scrolling']) && is_array($settings['scrolling'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-scrolling-wrapper');


            $this->add_render_attribute('item', 'class', 'elementor-scrolling-item');


            ?>
            <div class="elementor-scrolling">
                <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                    <?php
                    for ($i = 0; $i <= 3; $i++) {
                        ?>
                        <div class="elementor-scrolling-inner">
                            <?php foreach ($settings['scrolling'] as $item) : ?>
                                <div <?php $this->print_render_attribute_string('item'); ?>>
                                    <div class="elementor-scrolling-item-inner">
                                        <?php if (!empty($item['scrolling_image']['url'])) : ?>
                                            <?php echo Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image', 'scrolling_image'); ?>
                                        <?php endif; ?>
                                        <div class="scrolling-title elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <?php if ($item['scrolling_title']) {
                                                if (!empty($item['link'])) {
                                                    if (!empty($item['link']['is_external'])) {
                                                        $this->add_render_attribute('scrolling-title', 'target', '_blank');
                                                    }

                                                    if (!empty($item['link']['nofollow'])) {
                                                        $this->add_render_attribute('scrolling-title', 'rel', 'nofollow');
                                                    }

                                                    echo '<a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->get_render_attribute_string('scrolling-title') . ' title="' . esc_attr($item['scrolling_title']) . '">';
                                                }
                                                echo '<span>' . esc_html($item['scrolling_title']) . '</span>';
                                                if (!empty($item['link'])) {
                                                    echo '</a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new Zipli_Elementor_Slide_Scrolling());
