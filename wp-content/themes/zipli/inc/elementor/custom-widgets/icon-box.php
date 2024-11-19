<?php
use Elementor\Controls_Manager;

// Icon-box

add_action( 'elementor/element/icon-box/section_icon/before_section_end', function ( $element, $args ) {
    $element->add_control(
        'icon-box_style_theme',
        [
            'label' => esc_html__('Theme Style', 'zipli'),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'prefix_class' => 'icon-box-style-zipli-',
        ]
    );

}, 10, 2 );

add_action('elementor/element/icon-box/section_style_icon/after_section_end', function ($element, $args) {
    /** @var \Elementor\Element_Base $element */
    $element->update_control(
        'hover_primary_color',
        [
            'label' => esc_html__( 'Primary Color', 'zipli' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],

        ]
    );

    $element->update_control(
        'hover_secondary_color',
        [
            'label' => esc_html__( 'Secondary Color', 'zipli' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'condition' => [
                'view!' => 'default',
            ],
            'selectors' => [
                '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],

        ]
    );

}, 10, 2);

add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function ( $element, $args ) {
    $element->add_control(
        'border_color',
        [
            'label' => esc_html__( 'Border Color', 'zipli' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'border-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'border-color: {{VALUE}};',
            ],

        ]
    );

    $element->add_control(
        'hover_border_color',
        [
            'label' => esc_html__( 'Border Color Hover', 'zipli' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'condition' => [
                'view!' => 'default',
            ],
            'selectors' => [
                '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' => 'border-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'border-color: {{VALUE}};',
            ],

        ]
    );

}, 10, 2 );

// Icon-list
add_action('elementor/element/icon-list/section_icon_style/after_section_end', function ($element, $args) {
    $element->update_responsive_control(
        'text_indent',
            [
                'label' => esc_html__( 'Gap', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => is_rtl() ? 'padding-left: {{SIZE}}{{UNIT}};' : 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
    );
}, 10, 2 );

// Icon
add_action('elementor/element/icon/section_style_icon/after_section_end', function ($element, $args) {
    $element->update_responsive_control(
        'icon_padding',
        [
            'label' => esc_html__( 'Padding', 'zipli' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
            ],
            'range' => [
                'px' => [
                    'max' => 50,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 5,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 5,
                ],
            ],
            'condition' => [
                'view!' => 'default',
            ],
        ]
    );
}, 10, 2 );