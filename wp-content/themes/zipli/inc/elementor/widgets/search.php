<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Zipli_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'zipli-search';
    }

    public function get_title() {
        return esc_html__('Zipli Search Form', 'zipli');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-layout',
            [
                'label' => esc_html__('Layout', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zipli'),
                    'layout-2' => esc_html__('Layout 2', 'zipli'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'display_block',
            [
                'label'        => esc_html__('Display Block', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'search-form-layout-block-',
                'condition'  => [
                        'layout_style' => 'layout-2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'search-form-input-style',
            [
                'label' => esc_html__('Input', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'layout_style' => 'layout-1'
                ]
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__('Border width', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Focus', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Form', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius Input', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'search-form-button-style',
            [
                'label' => esc_html__('Button', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_button',
            [
                'label'     => esc_html__('Background', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form button[type=submit]' => 'background: {{VALUE}};',
                ],
                'condition'    => [
                    'layout_style' => 'layout-1'
                ]
            ]
        );
        $this->add_control(
            'background_button_hover',
            [
                'label'     => esc_html__('Background Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form button[type=submit]:hover' => 'background: {{VALUE}};',
                ],
                'condition'    => [
                    'layout_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__('Text Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form button[type=submit] span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup .content'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup i'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget_search form:before'  => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form button[type=submit]:hover span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup:hover .content'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup:hover i'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label'     => esc_html__('Border Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-zipli-search .site-header-search .button-search-popup' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius_button',
            [
                'label'      => esc_html__('Border Radius Button', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form button[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-widget-zipli-search .site-search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'layout_style' => 'layout-1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'search_typography',
                'selector' => '{{WRAPPER}}.elementor-widget-zipli-search .content',
                'condition'    => [
                    'layout_style' => 'layout-2'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Icon size', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-search > a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'layout_style' => 'layout-2'
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'     => esc_html__('Spacing', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .zipli-icon-search-3' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.search-form-layout-block-yes .zipli-icon-search-3' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: 0;',
                ],
                'condition'    => [
                    'layout_style' => 'layout-2'
                ]
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-zipli-search .site-header-search .button-search-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-widget-zipli-search .site-search form input[type=search]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'layout-1') {
            ?>
            <div class="site-search widget_search">
                <?php get_search_form(); ?>
            </div>
            <?php

        }

        if ($settings['layout_style'] === 'layout-2') {
            add_action('wp_footer', 'zipli_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup">
                    <i class="zipli-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search', 'zipli'); ?></span>
                </a>
            </div>
            <?php
        }

    }
}

$widgets_manager->register(new Zipli_Elementor_Search());
