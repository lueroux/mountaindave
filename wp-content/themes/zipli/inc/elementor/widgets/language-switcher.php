<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Zipli_Elementor_Language_Switcher extends Elementor\Widget_Base {

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
        return 'zipli-language-switcher';
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
        return esc_html__('Language Switcher', 'zipli');
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
        return 'eicon-global-settings';
    }

    public function get_script_depends() {
        return ['zipli-elementor-language-switcher'];
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
            'section_language_switcher',
            [
                'label' => esc_html__('Layout', 'zipli'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .zipli-language-switcher span.title',
            ]
        );

        $this->start_controls_tabs('style_color');

        $this->start_controls_tab('typo_normal',
            [
                'label' => esc_html__('Normal', 'zipli'),
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Label Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item .sub-item span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item > div span.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Icon Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .zipli-language-switcher .language-switcher-head:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .zipli-language-switcher .language-switcher-head:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('typo_hover',
            [
                'label' => esc_html__('Hover', 'zipli'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Title Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item > div:hover span.title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item > div:hover:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'trigger',
            [
                'label'        => esc_html__('Dropdown action', 'zipli'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'hover' => esc_html__('Hover', 'zipli'),
                    'click' => esc_html__('Click', 'zipli'),
                ],
                'default'      => 'hover',
                'prefix_class' => 'language-switcher-action-',
            ]
        );

        $this->add_control(
            'dropdown_position',
            [
                'label'        => esc_html__('Dropdown position', 'zipli'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'bottom_left'   => esc_html__('Bottom Left', 'zipli'),
                    'bottom_center' => esc_html__('Bottom Center', 'zipli'),
                    'bottom_right'  => esc_html__('Bottom Right', 'zipli'),
                    'top_left'      => esc_html__('Top Left', 'zipli'),
                    'top_center'    => esc_html__('Top Center', 'zipli'),
                    'top_right'     => esc_html__('Top Right', 'zipli'),
                ],
                'default'      => 'bottom_left',
                'prefix_class' => 'language-switcher-dropdown-position-',
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
        zipli_language_switcher();
    }
}

$widgets_manager->register(new Zipli_Elementor_Language_Switcher());

