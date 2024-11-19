<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class Zipli_Banner extends Elementor\Widget_Base
{
    public function get_name()
    {
        return 'banner';
    }

    public function get_title()
    {
        return esc_html__('Zipli Banner', 'zipli');
    }

    public function get_icon()
    {
        return 'eicon-image-rollover';
    }

    public function get_categories()
    {
        return ['zipli-addons'];
    }

    public function get_keywords() {
        return [ 'call to action', 'cta', 'button' ];
    }

    public function get_css_config() {
        return $this->get_widget_css_config( 'call-to-action' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_main_image',
            [
                'label' => esc_html__( 'Image', 'zipli' ),
            ]
        );


        $this->add_control(
            'skin',
            [
                'label' => esc_html__( 'Skin', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'classic' => esc_html__( 'Classic', 'zipli' ),
                    'cover' => esc_html__( 'Cover', 'zipli' ),
                ],
                'render_type' => 'template',
                'prefix_class' => 'elementor-cta--skin-',
                'default' => 'classic',
            ]
        );

        $this->add_responsive_control(
            'layout',
            [
                'label' => esc_html__( 'Position', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zipli' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'above' => [
                        'title' => esc_html__( 'Above', 'zipli' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zipli' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-cta-%s-layout-image-',
                'condition' => [
                    'skin!' => 'cover',
                ],
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__( 'Choose Image', 'zipli' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image', // Actually its `image_size`
                'label' => esc_html__( 'Image Resolution', 'zipli' ),
                'default' => 'large',
                'condition' => [
                    'bg_image[id]!' => '',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'zipli' ),
            ]
        );

        $this->add_control(
            'graphic_element',
            [
                'label' => esc_html__( 'Graphic Element', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'zipli' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'zipli' ),
                        'icon' => 'eicon-image-bold',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'zipli' ),
                        'icon' => 'eicon-star',
                    ],
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'graphic_image',
            [
                'label' => esc_html__( 'Choose Image', 'zipli' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
                'show_label' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'graphic_image', // Actually its `image_size`
                'default' => 'thumbnail',
                'condition' => [
                    'graphic_element' => 'image',
                    'graphic_image[id]!' => '',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'zipli' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_view',
            [
                'label' => esc_html__( 'View', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'zipli' ),
                    'stacked' => esc_html__( 'Stacked', 'zipli' ),
                    'framed' => esc_html__( 'Framed', 'zipli' ),
                ],
                'default' => 'default',
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_shape',
            [
                'label' => esc_html__( 'Shape', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => esc_html__( 'Circle', 'zipli' ),
                    'square' => esc_html__( 'Square', 'zipli' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'icon_view!' => 'default',
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
        'layout_icon',
            [
                'label' => esc_html__( 'Position Icon', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zipli' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'above' => [
                        'title' => esc_html__( 'Above', 'zipli' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zipli' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-cta-%s-layout-icon-',
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Sub title', 'zipli'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'placeholder' => esc_html__('Enter your sub title', 'zipli'),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'zipli' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This is the heading', 'zipli' ),
                'placeholder' => esc_html__( 'Enter your title', 'zipli' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'zipli' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'zipli' ),
                'placeholder' => esc_html__( 'Enter your description', 'zipli' ),
                'separator' => 'none',
                'rows' => 5,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'h2',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button Text', 'zipli' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Click Here', 'zipli' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_style_theme',
            [
                'label' => esc_html__('Style', 'zipli'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => 'Default',
                    'outline' => 'Outline',
                    'link' => 'Link',
                ],
                'default' => 'outline',
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__( 'Icon', 'zipli' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'button_icon_align',
            [
                'label' => esc_html__( 'Icon Position', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'row' => esc_html__( 'Before', 'zipli' ),
                    'row-reverse' => esc_html__( 'After', 'zipli' ),
                ],

                'selectors' => [
                    '{{WRAPPER}} .elementor-button-content-wrapper' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'     => esc_html__('Spacing', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'zipli' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'zipli' ),
            ]
        );

        $this->add_control(
            'link_click',
            [
                'label' => esc_html__( 'Apply Link On', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => esc_html__( 'Whole Box', 'zipli' ),
                    'button' => esc_html__( 'Button Only', 'zipli' ),
                ],
                'default' => 'button',
                'separator' => 'none',
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );
        $this->add_control(
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
        $this->add_control(
            'style_theme-color',
            [
                'label' => esc_html__( 'Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style_theme' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_theme-width',
            [
                'label'     => esc_html__('Width', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'custom' ],
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style_theme' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_theme-horizontal',
            [
                'label'     => esc_html__('Horizontal', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style_theme' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_theme-vertical',
            [
                'label'     => esc_html__('Vertical', 'zipli'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style_theme' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon',
            [
                'label' => esc_html__( 'Ribbon', 'zipli' ),
            ]
        );

        $this->add_control(
            'ribbon_title',
            [
                'label' => esc_html__( 'Title', 'zipli' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'ribbon_horizontal_position',
            [
                'label' => esc_html__( 'Position', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zipli' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zipli' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'ribbon_title!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__( 'Box', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_stretch',
            [
                'label' => esc_html__('Stretch', 'zipli'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'content-stretch-'
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label' => esc_html__( 'Height', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'content_stretch' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zipli' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'zipli' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zipli' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'skin!' => 'cover',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'zipli' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'zipli' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'zipli' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'zipli' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-cta--valign-',
                'separator' => 'none',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'brand_wrapper_border',
                'selector'  => '{{WRAPPER}} .elementor-cta__content',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'heading_bg_image_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Image', 'zipli' ),
                'condition' => [
                    'bg_image[url]!' => '',
                    'skin' => 'classic',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_min_width',
            [
                'label' => esc_html__( 'Width', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'classic',
                    'layout!' => 'above',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_min_height',
            [
                'label' => esc_html__( 'Height', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );


        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'graphic_element_style',
            [
                'label' => esc_html__( 'Graphic Element', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'graphic_element!' => [
                        'none',
                        '',
                    ],
                ],
            ]
        );

        $this->add_control(
            'graphic_image_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_width',
            [
                'label' => esc_html__( 'Width', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'graphic_image_border',
                'selector' => '{{WRAPPER}} .elementor-cta__image img',
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-cta--layout-icon-left .elementor-icon-wrapper' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom:0;',
                    '{{WRAPPER}}.elementor-cta--layout-icon-right .elementor-icon-wrapper' => 'margin-left: {{SIZE}}{{UNIT}}; margin-bottom:0;',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_primary_color',
            [
                'label' => esc_html__( 'Primary Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_secondary_color',
            [
                'label' => esc_html__( 'Secondary Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon svg' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                    'em' => [
                        'max' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'title',
                            'operator' => '!==',
                            'value' => '',
                        ],
                        [
                            'name' => 'description',
                            'operator' => '!==',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );


        $this->add_control(
            'content_reverse',
            [
                'label'        => esc_html__('Reverse', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}.elementor-cta--skin-classic .elementor-cta' => 'flex-direction: column-reverse;',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Width', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%'],

                'selectors' => [
                    '{{WRAPPER}}.elementor-cta--skin-cover .elementor-cta__content .elementor-cta__content-inner' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'skin' => 'cover',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__('Alignment', 'zipli'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'zipli'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'zipli'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'zipli'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'condition' => [
                    'skin' => 'cover',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'text-align: {{VALUE}}',
                ],
                'prefix_class' => 'box-align-',
            ]
        );

        $this->add_control(
            'heading_style_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'zipli' ),
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .elementor-cta__title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_style_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'SubTitle', 'zipli' ),
                'separator' => 'before',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_style_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'zipli' ),
                'separator' => 'before',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-cta__description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_content_colors',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Colors', 'zipli' ),
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'color_tabs' );

        $this->start_controls_tab( 'colors_normal',
            [
                'label' => esc_html__( 'Normal', 'zipli' ),
            ]
        );

        $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'SubTitle Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'colors_hover',
            [
                'label' => esc_html__( 'Hover', 'zipli' ),
            ]
        );

        $this->add_control(
            'content_bg_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__content' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'skin' => 'classic',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => esc_html__( 'SubTitle Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label' => esc_html__( 'Description Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );
        $this->add_control(
            'border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__content' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__( 'Size', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'sm',
                'options' => [
                    'xs' => esc_html__( 'Extra Small', 'zipli' ),
                    'sm' => esc_html__( 'Small', 'zipli' ),
                    'md' => esc_html__( 'Medium', 'zipli' ),
                    'lg' => esc_html__( 'Large', 'zipli' ),
                    'xl' => esc_html__( 'Extra Large', 'zipli' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-cta__button',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab( 'button_normal',
            [
                'label' => esc_html__( 'Normal', 'zipli' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( 'Border Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}}.button-style-theme-link.show-line-yes .elementor-button-text:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button .button-icon' => 'border-color: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_icon_color',
            [
                'label' => esc_html__( 'Background Icon', 'zipli' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-button-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => esc_html__( 'Hover', 'zipli' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta .elementor-cta__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_box_text_color',
            [
                'label' => esc_html__( 'Text Box', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:not(.button-style-theme-link) .elementor-cta:hover .elementor-cta__button .button-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.button-style-theme-link .elementor-cta:hover .elementor-cta__button .button-icon' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'bg_icon_color_hover',
            [
                'label' => esc_html__( 'Background Icon', 'zipli' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover .elementor-button-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_width',
            [
                'label' => esc_html__( 'Border Width', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                    'em' => [
                        'max' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ribbon_style',
            [
                'label' => esc_html__( 'Ribbon', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition' => [
                    'ribbon_title!' => '',
                ],
            ]
        );

        $this->add_control(
            'ribbon_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_ACCENT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-ribbon-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label' => esc_html__( 'Text Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-ribbon-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

        $this->add_responsive_control(
            'ribbon_distance',
            [
                'label' => esc_html__( 'Distance', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography',
                'selector' => '{{WRAPPER}} .elementor-ribbon-inner',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .elementor-ribbon-inner',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hover_effects',
            [
                'label' => esc_html__( 'Hover Effects', 'zipli' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Content', 'zipli' ),
                'condition' => [
                    'skin' => 'cover',
                ],
            ]
        );

        $this->add_control(
            'content_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'groups' => [
                    [
                        'label' => esc_html__( 'None', 'zipli' ),
                        'options' => [
                            '' => esc_html__( 'None', 'zipli' ),
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Entrance', 'zipli' ),
                        'options' => [
                            'enter-from-right' => 'Slide In Right',
                            'enter-from-left' => 'Slide In Left',
                            'enter-from-top' => 'Slide In Up',
                            'enter-from-bottom' => 'Slide In Down',
                            'enter-zoom-in' => 'Zoom In',
                            'enter-zoom-out' => 'Zoom Out',
                            'fade-in' => 'Fade In',
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Reaction', 'zipli' ),
                        'options' => [
                            'grow' => 'Grow',
                            'shrink' => 'Shrink',
                            'move-right' => 'Move Right',
                            'move-left' => 'Move Left',
                            'move-up' => 'Move Up',
                            'move-down' => 'Move Down',
                        ],
                    ],
                    [
                        'label' => esc_html__( 'Exit', 'zipli' ),
                        'options' => [
                            'exit-to-right' => 'Slide Out Right',
                            'exit-to-left' => 'Slide Out Left',
                            'exit-to-top' => 'Slide Out Up',
                            'exit-to-bottom' => 'Slide Out Down',
                            'exit-zoom-in' => 'Zoom In',
                            'exit-zoom-out' => 'Zoom Out',
                            'fade-out' => 'Fade Out',
                        ],
                    ],
                ],
                'default' => 'grow',
                'condition' => [
                    'skin' => 'cover',
                ],
            ]
        );

        /*
         *
         * Add class 'elementor-animated-content' to widget when assigned content animation
         *
         */
        $this->add_control(
            'animation_class',
            [
                'label' => esc_html__( 'Animation', 'zipli' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'animated-content',
                'prefix_class' => 'elementor-',
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );

        $this->add_control(
            'content_animation_duration',
            [
                'label' => esc_html__( 'Animation Duration', 'zipli' ) . ' (ms)',
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1000,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content-item' => 'transition-duration: {{SIZE}}ms',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
                ],
                'condition' => [
                    'content_animation!' => '',
                    'skin' => 'cover',
                ],
            ]
        );

        $this->add_control(
            'sequenced_animation',
            [
                'label' => esc_html__( 'Sequenced Animation', 'zipli' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'zipli' ),
                'label_off' => esc_html__( 'Off', 'zipli' ),
                'return_value' => 'elementor-cta--sequenced-animation',
                'prefix_class' => '',
                'condition' => [
                    'content_animation!' => '',
                    'skin' => 'cover',
                ],
            ]
        );

        $this->add_control(
            'background_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Background', 'zipli' ),
                'separator' => 'before',
                'condition' => [
                    'skin' => 'cover',
                ],
            ]
        );

        $this->add_control(
            'transformation',
            [
                'label' => esc_html__( 'Hover Animation', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => 'None',
                    'zoom-in' => 'Zoom In',
                    'zoom-out' => 'Zoom Out',
                    'move-left' => 'Move Left',
                    'move-right' => 'Move Right',
                    'move-up' => 'Move Up',
                    'move-down' => 'Move Down',
                ],
                'default' => 'zoom-in',
                'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
            ]
        );

        $this->start_controls_tabs( 'bg_effects_tabs' );

        $this->start_controls_tab( 'normal',
            [
                'label' => esc_html__( 'Normal', 'zipli' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'background',
                'label'          => esc_html__('Background Overlay', 'zipli'),
                'types'          => ['classic', 'gradient'],
                'exclude'        => ['image'],
                'selector'       => '{{WRAPPER}} .elementor-cta:not(:hover) .elementor-cta__bg-overlay',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters',
                'selector' => '{{WRAPPER}} .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'zipli' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Normal', 'zipli' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'exclusion' => 'Exclusion',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'zipli' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'background_hover',
                'label'          => esc_html__('Background Overlay Hover', 'zipli'),
                'types'          => ['classic', 'gradient'],
                'exclude'        => ['image'],
                'selector'       => '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg-overlay',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters_hover',
                'selector' => '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'effect_duration',
            [
                'label' => esc_html__( 'Transition Duration', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta .elementor-cta__bg, {{WRAPPER}} .elementor-cta .elementor-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $wrapper_tag = 'div';
        $button_tag = 'a';
        $bg_image = '';
        $content_animation = $settings['content_animation'];
        $animation_class = '';
        $print_bg = true;
        $print_content = true;

        $has_icon = !empty($settings['button_icon']);

        if ($has_icon) {
            $this->add_render_attribute('button-icon', 'class', $settings['button_icon']);
            $this->add_render_attribute('button-icon', 'aria-hidden', 'true');
        }

        if (empty($settings['button_icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['button_icon'] = 'fa fa-star';
        }

        if (!empty($settings['button_icon'])) {
            $this->add_render_attribute('button-icon', 'class', $settings['button_icon']);
            $this->add_render_attribute('button-icon', 'aria-hidden', 'true');
        }

        if ( ! empty( $settings['bg_image']['id'] ) ) {
            $bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
        } elseif ( ! empty( $settings['bg_image']['url'] ) ) {
            $bg_image = $settings['bg_image']['url'];
        }

        if ( empty( $bg_image ) && 'classic' == $settings['skin'] ) {
            $print_bg = false;
        }

        if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
            $print_content = false;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-cta' );
        $background_selector = "background-image: url($bg_image);";
/*
        $is_lazyload_active = Plugin::elementor()->experiments->is_feature_active( 'e_lazyload' );
        $is_edit_mode = Plugin::elementor()->editor->is_edit_mode();

        if ( $print_bg && ! $is_edit_mode && $is_lazyload_active ) {
            $background_selector = "background-image: var(--e-bg-lazyload-loaded); --e-bg-lazyload: url($bg_image);";
            $this->add_render_attribute( 'wrapper', 'data-e-bg-lazyload', '.elementor-bg' );
        }*/

        $this->add_render_attribute( 'background_image', 'style', $background_selector );

        $this->add_render_attribute( 'subtitle', 'class', [
            'elementor-cta__subtitle',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'title', 'class', [
            'elementor-cta__title',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'description', 'class', [
            'elementor-cta__description',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'button', 'class', [
            'elementor-cta__button',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ] );

        $this->add_render_attribute( 'graphic_element', 'class',
            [
                'elementor-content-item',
                'elementor-cta__content-item',
            ]
        );

        if ( 'icon' === $settings['graphic_element'] ) {
            $this->add_render_attribute( 'graphic_element', 'class',
                [
                    'elementor-icon-wrapper',
                    'elementor-cta__icon',
                ]
            );
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-view-' . $settings['icon_view'] );
            if ( 'default' != $settings['icon_view'] ) {
                $this->add_render_attribute( 'graphic_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
            }

            if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fa fa-star';
            }

            if ( ! empty( $settings['icon'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
            }
        } elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-cta__image' );
        }

        if ( ! empty( $content_animation ) && 'cover' == $settings['skin'] ) {

            $animation_class = 'elementor-animated-item--' . $content_animation;

            $this->add_render_attribute( 'subtitle', 'class', $animation_class );

            $this->add_render_attribute( 'title', 'class', $animation_class );

            $this->add_render_attribute( 'graphic_element', 'class', $animation_class );

            $this->add_render_attribute( 'description', 'class', $animation_class );

        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $link_element = 'button';

            if ( 'box' === $settings['link_click'] ) {
                $wrapper_tag = 'a';
                $button_tag = 'span';
                $link_element = 'wrapper';
            }

            $this->add_link_attributes( $link_element, $settings['link'] );
        }

        $this->add_inline_editing_attributes( 'subtitle' );
        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'description' );
        $this->add_inline_editing_attributes( 'button' );
        $this->add_render_attribute( 'button_icon', 'class', [ 'elementor-button-icon button-icon',] );

        if ( ! empty( $settings['button_icon_align'] ) ) {
            $this->add_render_attribute( 'button_icon', 'class', 'elementor-align-icon-' . $settings['button_icon_align'] );
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <?php if ( $print_bg ) : ?>
            <div class="elementor-cta__bg-wrapper">
                <div class="elementor-cta__bg elementor-bg" <?php $this->print_render_attribute_string( 'background_image' ); ?>></div>
                <div class="elementor-cta__bg-overlay"></div>
            </div>
        <?php endif; ?>
        <?php if ( $print_content ) : ?>
            <div class="elementor-cta__content">
                <div class="elementor-cta__content-inner">
                <?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                    <div <?php $this->print_render_attribute_string( 'graphic_element' ); ?>>
                        <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'graphic_image' ); ?>
                    </div>
                <?php elseif ( 'icon' === $settings['graphic_element'] && ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) : ?>
                    <div <?php $this->print_render_attribute_string( 'graphic_element' ); ?>>
                        <div class="elementor-icon">
                            <?php if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            else : ?>
                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class='elementor-content-wrapper'>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'subtitle' ); ?>>
                            <?php $this->print_unescaped_setting( 'subtitle' ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="elementor-content-info">
                    <?php
                    if ( ! empty( $settings['title'] ) ) :
                        $title_tag = Utils::validate_html_tag( $settings['title_tag'] );

                        echo '<' . $title_tag . ' ' . $this->get_render_attribute_string( 'title' ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        $this->print_unescaped_setting( 'title' );
                        echo '</' . $title_tag . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    endif;
                    ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                            <?php $this->print_unescaped_setting( 'description' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['button'] ) ) : ?>
                    <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item <?php echo esc_attr( $animation_class ); ?>">
                        <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                       <!-- --><?php /*$this->print_unescaped_setting( 'button' ); */?>
                        <span class="elementor-button-content-wrapper">
                            <?php if ( ! empty( $settings['button_icon']['value'] ) ) : ?>
                                <span <?php $this->print_render_attribute_string( 'button_icon' ); ?>>
                                   <?php Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );?>
                                </span>
                            <?php endif; ?>
                            <span class="elementor-button-text" data-name="<?php echo sprintf('%s', $settings['button']); ?>">
                                <span><?php echo sprintf('%s', $settings['button']); ?></span>
                            </span>
                        </span>

                        </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                </div>
            </div>
        <?php endif; ?>
        <?php
        if ( ! empty( $settings['ribbon_title'] ) ) :
            $this->add_render_attribute( 'ribbon-wrapper', 'class', 'elementor-ribbon' );

            if ( ! empty( $settings['ribbon_horizontal_position'] ) ) {
                $this->add_render_attribute( 'ribbon-wrapper', 'class', 'elementor-ribbon-' . $settings['ribbon_horizontal_position'] );
            }
            ?>
            <div <?php $this->print_render_attribute_string( 'ribbon-wrapper' ); ?>>
                <div class="elementor-ribbon-inner"><?php $this->print_unescaped_setting( 'ribbon_title' ); ?></div>
            </div>
        <?php endif; ?>
        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
        <?php
    }

}

$widgets_manager->register(new Zipli_Banner());
