<?php
// nested-tabs
use Elementor\Controls_Manager;

add_action('elementor/element/nested-tabs/section_tabs/before_section_end', function ($element, $args) {
    /** @var \Elementor\Element_Base $element */
    $element->add_control(
        'tabs_style',
        [
            'label'        => esc_html__('Style', 'zipli'),
            'type'         => Controls_Manager::SELECT,
            'default'      => '2',
            'options'      => [
                '1' => esc_html__('Style 1', 'zipli'),
                '2' => esc_html__('Style 2', 'zipli'),
            ],
            'prefix_class' => 'elementor-tabs-style-',
        ]
    );
}, 10, 2);

add_action( 'elementor/element/nested-tabs/section_tabs_style/before_section_end', function ( $element, $args ) {

    $element->add_responsive_control(
        'margin',
        [
            'label' => esc_html__( 'Margin', 'zipli' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
            'selectors' => [
                '{{WRAPPER}}.elementor-widget-n-tabs .e-n-tabs-heading' => "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]
    );

}, 10, 2 );

add_action( 'elementor/element/nested-tabs/section_title_style/before_section_end', function ( $element, $args ) {

    $element->add_responsive_control(
        'tabs_title_width',
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
                    'max' => 5000,
                ],
                'vw' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}}.elementor-tabs-style-2 .e-n-tabs-heading' => 'width: {{SIZE}}{{UNIT}};margin:0 auto',
                '{{WRAPPER}}.elementor-tabs-style-2 .e-n-tabs&:before' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => ['tabs_style' => '2']
        ]
    );

}, 10, 2 );