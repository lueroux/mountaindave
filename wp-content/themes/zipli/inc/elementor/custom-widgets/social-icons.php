<?php

use Elementor\Controls_Manager;

add_action('elementor/element/social-icons/section_social_style/before_section_end', function ($element, $args) {
    /** @var \Elementor\Element_Base $element */
    $element->add_control(
        'show_icon_effect',
        [
            'label'        => esc_html__('Show Icon Effect', 'zipli'),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'icon-style-zipli-',
        ]
    );

}, 10, 2);