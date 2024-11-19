<?php
// Button
use Elementor\Controls_Manager;

add_action('elementor/element/button/section_button/after_section_end', function ($element, $args) {
    /** @var \Elementor\Element_Base $element */
    $element->update_control(
        'button_type',
        [
            'label'        => esc_html__('Type', 'zipli'),
            'type'         => Controls_Manager::SELECT,
            'default'      => 'default',
            'options'      => [
                'default'   => esc_html__('Default', 'zipli'),
                'outline' => esc_html__('OutLine', 'zipli'),
                'info'    => esc_html__('Info', 'zipli'),
                'success' => esc_html__('Success', 'zipli'),
                'warning' => esc_html__('Warning', 'zipli'),
                'danger'  => esc_html__('Danger', 'zipli'),
                'type-link'  => esc_html__('Link', 'zipli'),
            ],
            'prefix_class' => 'elementor-button-',
        ]
    );

    $element->update_control(
        'icon_align',[
            'prefix_class' => 'elementor-button-icon-align-',
        ]
    );

}, 10, 2);

add_action('elementor/element/button/section_style/after_section_end', function ($element, $args) {

    $element->update_control(
        'button_text_color',
        [
            'global'    => [
                'default' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                '{{WRAPPER}}.elementor-button-type-link .elementor-button:after,{{WRAPPER}}.elementor-button-type-link .elementor-button:before' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->update_control(
        'background_color',
        [
            'global'    => [
                'default' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->update_control(
        'button_background_hover_color',
        [
            'global'    => [
                'default' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .elementor-button:before' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-button-type-link .elementor-button .elementor-button-icon:before' => 'background-color: {{VALUE}};',
            ],
        ]
    );

}, 10, 2);


add_action('elementor/element/button/section_button/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_size',
        [
            'label' => esc_html__( 'Icon Size', 'zipli' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 50,
                ],
            ],
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon svg' => '--size-icon: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => '--font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'icon_color',
        [
            'label' => esc_html__( 'Icon Color', 'zipli' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .elementor-button .elementor-button-icon svg' => 'fill: {{VALUE}};',
            ],
        ]
    );
    $element->add_control(
        'icon_color_hover',
        [
            'label' => esc_html__( 'Icon Color Hover', 'zipli' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon svg' => 'fill: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'bg_icon_color',
        [
            'label' => esc_html__( 'Background Color', 'zipli' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'bg_icon_color_hover',
        [
            'label' => esc_html__( 'Background Color Hover', 'zipli' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'enable_effect_icon',
        [
            'label'     => esc_html__('Enable Effect Icon', 'zipli'),
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
                'selected_icon[value]!' => '',
            ],
            'prefix_class' => 'elementor-button-effect-icon-',
        ]
    );
}, 10, 2);