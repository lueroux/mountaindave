<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class Zipli_Elementor_Image_Hotspots_Widget extends  Elementor\Widget_Base {

    public function get_name() {
        return 'zipli-image-hotspots';
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_title() {
        return 'Zipli Image Hotspots';
    }

    public function get_script_depends() {
        return [
            'zipli-elementor-image-hotspots', 'tooltipster'
        ];
    }

    public function get_style_depends() {
        return [
            'tooltipster',
        ];
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    protected function register_controls() {

        $this->start_controls_section('image_hotspots_infomation_section',
            [
                'label' => esc_html__('Layout', 'zipli'),
            ]
        );

        $this->add_control('image_hotspots_infomation_show',
            [
                'label' => esc_html__('Show Infomation', 'zipli'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control('image_hotspots_all_tooltip',
            [
                'label' => esc_html__('Show All Tooltip', 'zipli'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        /**START Background Image Section  **/
        $this->start_controls_section('image_hotspots_image_section',
            [
                'label' => esc_html__('Image', 'zipli'),
            ]
        );

        $this->add_control('image_hotspots_image',
            [
                'label'       => __('Choose Image', 'zipli'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'background_image', // Actually its `image_size`.
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_icons_settings',
            [
                'label' => esc_html__('Hotspots', 'zipli'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_responsive_control('zipli_image_hotspots_main_icons_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.zipli-image-hotspots-main-icons' => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control('zipli_image_hotspots_main_icons_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.zipli-image-hotspots-main-icons' => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_control('image_hotspots_content',
            [
                'label'   => esc_html__('Content to Show', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'text_editor'         => esc_html__('Text Editor', 'zipli'),
                    'elementor_templates' => esc_html__('Elementor Template', 'zipli'),
                ],
                'default' => 'text_editor'
            ]
        );

        $repeater->add_control('image_hotspots_tooltips_title',
            [
                'label'       => esc_html__('Title', 'zipli'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Title',
                'label_block' => true,
            ]);

        $repeater->add_control('image_hotspots_tooltips_texts',
            [
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Lorem ipsum',
                'dynamic'     => ['active' => true],
                'label_block' => true,
                'condition'   => [
                    'image_hotspots_content' => 'text_editor'
                ]
            ]);

        $repeater->add_control('image_hotspots_tooltips_temp',
            [
                'label'     => esc_html__('Teamplate ID', 'zipli'),
                'type'      => Controls_Manager::NUMBER,
                'condition' => [
                    'image_hotspots_content' => 'elementor_templates'
                ],
            ]);

        $repeater->add_control('image_hotspots_link_switcher',
            [
                'label'       => esc_html__('Link', 'zipli'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('Add a custom link or select an existing page link', 'zipli'),
            ]);

        $repeater->add_control('image_hotspots_link_type',
            [
                'label'       => esc_html__('Link/URL', 'zipli'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'url'  => esc_html__('URL', 'zipli'),
                    'link' => esc_html__('Existing Page', 'zipli'),
                ],
                'default'     => 'url',
                'condition'   => [
                    'image_hotspots_link_switcher' => 'yes',
                ],
                'label_block' => true,
            ]);

        $repeater->add_control('image_hotspots_url',
            [
                'label'       => esc_html__('URL', 'zipli'),
                'type'        => Controls_Manager::URL,
                'condition'   => [
                    'image_hotspots_link_switcher' => 'yes',
                    'image_hotspots_link_type'     => 'url',
                ],
                'placeholder' => 'https://wpzipli.com/',
                'label_block' => true
            ]);

        $repeater->add_control('image_hotspots_link_text',
            [
                'label'       => esc_html__('Link Title', 'zipli'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'condition'   => [
                    'image_hotspots_link_switcher' => 'yes',
                ],
                'label_block' => true
            ]);

        $this->add_control('image_hotspots_icons',
            [
                'label'  => esc_html__('Hotspots', 'zipli'),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control('image_hotspots_icons_animation',
            [
                'label' => esc_html__('Radar Animation', 'zipli'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_section',
            [
                'label' => esc_html__('Tooltips', 'zipli'),
            ]
        );

        $this->add_control(
            'image_hotspots_trigger_type',
            [
                'label'   => esc_html__('Trigger', 'zipli'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'click' => esc_html__('Click', 'zipli'),
                    'hover' => esc_html__('Hover', 'zipli'),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'image_hotspots_arrow',
            [
                'label'     => esc_html__('Show Arrow', 'zipli'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Show', 'zipli'),
                'label_off' => esc_html__('Hide', 'zipli'),
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_position',
            [
                'label'       => esc_html__('Positon', 'zipli'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'top'    => esc_html__('Top', 'zipli'),
                    'bottom' => esc_html__('Bottom', 'zipli'),
                    'left'   => esc_html__('Left', 'zipli'),
                    'right'  => esc_html__('Right', 'zipli'),
                ],
                'description' => esc_html__('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', 'zipli'),
                'default'     => ['top', 'bottom'],
                'label_block' => true,
                'multiple'    => true
            ]
        );

        $this->add_control('image_hotspots_tooltips_distance_position',
            [
                'label'   => esc_html__('Spacing', 'zipli'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('The distance between the origin and the tooltip in pixels, default is 6', 'zipli'),
                'default' => 6,
            ]
        );

        $this->add_control('image_hotspots_min_width',
            [
                'label'       => esc_html__('Min Width', 'zipli'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a minimum width for the tooltip in pixels, default: 0 (auto width)', 'zipli'),
            ]
        );

        $this->add_control('image_hotspots_max_width',
            [
                'label'       => esc_html__('Max Width', 'zipli'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a maximum width for the tooltip in pixels, default: null (no max width)', 'zipli'),
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_height',
            [
                'label'       => esc_html__('Height', 'zipli'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em', '%'],
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ]
                ],
                'label_block' => true,
                'selectors'   => [
                    '.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control('image_hotspots_anim',
            [
                'label'       => esc_html__('Animation', 'zipli'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'fade'  => esc_html__('Fade', 'zipli'),
                    'grow'  => esc_html__('Grow', 'zipli'),
                    'swing' => esc_html__('Swing', 'zipli'),
                    'slide' => esc_html__('Slide', 'zipli'),
                    'fall'  => esc_html__('Fall', 'zipli'),
                ],
                'default'     => 'fade',
                'label_block' => true,
            ]
        );

        $this->add_control('image_hotspots_anim_dur',
            [
                'label'   => esc_html__('Animation Duration', 'zipli'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation duration in milliseconds, default is 350', 'zipli'),
                'default' => 350,
            ]
        );

        $this->add_control('image_hotspots_delay',
            [
                'label'   => esc_html__('Delay', 'zipli'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation delay in milliseconds, default is 10', 'zipli'),
                'default' => 10,
            ]
        );

        $this->add_control('image_hotspots_hide',
            [
                'label'        => esc_html__('Hide on Mobiles', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => 'Show',
                'label_off'    => 'Hide',
                'description'  => esc_html__('Hide tooltips on mobile phones', 'zipli'),
                'return_value' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_image_style_settings',
            [
                'label' => esc_html__('Image', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_image_border',
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-container .zipli-addons-image-hotspots-ib-img',
            ]
        );

        $this->add_control('image_hotspots_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container .zipli-addons-image-hotspots-ib-img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('image_hotspots_image_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container .zipli-addons-image-hotspots-ib-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_hotspots_image_align',
            [
                'label'     => __('Text Alignment', 'zipli'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'zipli'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'zipli'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'zipli'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_style_settings',
            [
                'label' => esc_html__('Tooltips', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_color',
            [
                'label'     => esc_html__('Text Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .zipli-image-hotspots-tooltips-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_typo',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .zipli-image-hotspots-tooltips-text, .zipli-image-hotspots-tooltips-text-{{ID}}'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_content_text_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .zipli-image-hotspots-tooltips-text'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_background_color',
            [
                'label'     => esc_html__('Background Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'                                 => 'background: {{VALUE}};',
                    '.tooltipster-base.tooltipster-top .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'    => 'border-top-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-bottom .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-bottom-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-right .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'  => 'border-right-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-left .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'   => 'border-left-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_border',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_box_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content, .tooltipster-arrow-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_heading_section',
            [
                'label'     => esc_html__('Heading', 'zipli'),
                'condition' =>
                    [
                        'image_hotspots_infomation_show' => 'yes',
                    ]
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
                'default' => 'This is the subtitle',
                'placeholder' => esc_html__('Enter your subtitle', 'zipli'),
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
                'placeholder' => esc_html__( 'Enter your heading', 'zipli' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section('img_hotspots_infomation_style',
            [
                'label'     => esc_html__('Infomation', 'zipli'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>
                    [
                        'image_hotspots_infomation_show' => 'yes',
                    ]
            ]
        );

        $this->add_responsive_control('img_hotspots_infomation_width',
            [
                'label'      => esc_html__('Infomation Width', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-accordion' => 'width: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control('img_hotspots_infomation_padding',
            [
                'label'      => esc_html__('Paddding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_control(
            'infomation_text',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Text', 'zipli' ),
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .elementor-hotspots .elementor-hotspots-tab-title' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-hotspots .elementor-hotspots-tab-title',
            ]
        );

        $this->add_control(
            'infomation_number',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Number', 'zipli' ),
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Number Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .elementor-hotspots .elementor-hotspots-item-number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'number_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .elementor-hotspots .elementor-hotspots-item-number' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-hotspots .elementor-hotspots-item-number',
            ]
        );

        $this->add_responsive_control(
            'info_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-hotspots .elementor-hotspots-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );



        $this->end_controls_section();

        $this->start_controls_section('img_hotspots_container_style',
            [
                'label' => esc_html__('Container hotspots', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('img_hotspots_container_width',
            [
                'label'      => esc_html__('Width', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  =>
                    [
                        'image_hotspots_infomation_show' => 'yes',
                    ]
            ]
        );

        $this->add_control('img_hotspots_container_background',
            [
                'label'     => esc_html__('Background Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'img_hotspots_container_border',
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-container',
            ]
        );

        $this->add_control('img_hotspots_container_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_hotspots_container_box_shadow',
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-container',
            ]
        );

        $this->add_responsive_control('img_hotspots_container_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('img_hotspots_container_padding',
            [
                'label'      => esc_html__('Paddding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-image-hotspots-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('img_hotspots_heading_style',
            [
                'label'     => esc_html__('Heading', 'zipli'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>
                    [
                        'image_hotspots_infomation_show' => 'yes',
                    ]
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


        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'SubTitle Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
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
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_subtitle',
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
                    '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
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

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'zipli' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_title' => 'color: {{VALUE}}',
                ],
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
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .zipli-image-hotspots-accordion .elementor-hotspots_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );



        $this->end_controls_section();
    }


    protected function render($instance = []) {
        // get our input from the widget settings.
        $settings        = $this->get_settings_for_display();
        $animation_class = '';
        if ($settings['image_hotspots_icons_animation'] == 'yes') {
            $animation_class = 'zipli-image-hotspots-anim';
        }

        $image_src = $settings['image_hotspots_image'];

        $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'background_image', $settings);
        if (empty($image_src_size)) : $image_src_size = $image_src['url'];
        else: $image_src_size = $image_src_size; endif;

        $image_hotspots_settings = [
            'anim'        => $settings['image_hotspots_anim'],
            'animDur'     => !empty($settings['image_hotspots_anim_dur']) ? $settings['image_hotspots_anim_dur'] : 350,
            'delay'       => !empty($settings['image_hotspots_anim_delay']) ? $settings['image_hotspots_anim_delay'] : 10,
            'arrow'       => ($settings['image_hotspots_arrow'] == 'yes') ? true : false,
            'distance'    => !empty($settings['image_hotspots_tooltips_distance_position']) ? $settings['image_hotspots_tooltips_distance_position'] : 6,
            'minWidth'    => !empty($settings['image_hotspots_min_width']['size']) ? $settings['image_hotspots_min_width']['size'] : 0,
            'maxWidth'    => !empty($settings['image_hotspots_max_width']['size']) ? $settings['image_hotspots_max_width']['size'] : 'null',
            'side'        => !empty($settings['image_hotspots_tooltips_position']) ? $settings['image_hotspots_tooltips_position'] : array(
                'right',
                'left'
            ),
            'hideMobiles' => ($settings['image_hotspots_hide'] == true) ? true : false,
            'trigger'     => $settings['image_hotspots_trigger_type'],
            'id'          => $this->get_id()
        ];
        $check_all_tooltip = (!empty($settings['image_hotspots_all_tooltip'] && $settings['image_hotspots_all_tooltip'] == 'yes'));
        ?>
        <?php if ($settings['image_hotspots_infomation_show'] == 'yes'): ?>
            <div class="zipli-image-hotspots-accordion">
                <div class="zipli-image-hotspots-accordion-inner">

                    <?php if (!empty($settings['subtitle'])) : ?>
                        <div class="elementor-hotspots_subtitle"><?php $this->print_unescaped_setting('subtitle'); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?>
                        <div class="elementor-hotspots_title"><?php $this->print_unescaped_setting('title'); ?></div>
                    <?php endif; ?>
                    <div class="elementor-hotspots" role="tablist">
                        <?php
                        foreach ($settings['image_hotspots_icons'] as $index => $item) :
                            $tab_count = $index + 1;

                            $tab_title_setting_key = $this->get_repeater_setting_key('image_hotspots_tooltips_texts', 'image_hotspots_icons', $index);

                            $this->add_render_attribute($tab_title_setting_key, [
                                'id'       => 'elementor-hotspots-tab-title-' . $item['_id'],
                                'class'    => ['elementor-hotspots-tab-title'],
                                'tabindex' => $item['_id'],
                                'data-tab' => '.zipli-image-hotspots-main-icons-' . $item['_id'],
                                'role'     => 'tab',
                            ]);

                            ?>
                            <div class="elementor-hotspots-item">
                                <div <?php $this->print_render_attribute_string($tab_title_setting_key); ?>>
                                    <span class="elementor-hotspots-item-number"><?php echo esc_html($tab_count < 10 ? $tab_count : $tab_count); ?></span><?php echo esc_html($item['image_hotspots_tooltips_title']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        <?php endif; ?>
        <div id="zipli-image-hotspots-<?php echo esc_attr($this->get_id()); ?>"
             class="zipli-image-hotspots-container<?php echo esc_attr($check_all_tooltip) ? ' show-all-tooltip' : '' ?>"
             data-settings='<?php echo wp_json_encode($image_hotspots_settings); ?>'>
            <img class="zipli-addons-image-hotspots-ib-img" alt="Background" src="<?php echo esc_url($image_src_size); ?>">
            <?php foreach ($settings['image_hotspots_icons'] as $index => $item) {
                $list_item_key = 'img_hotspot_' . $index;
                $this->add_render_attribute($list_item_key, 'class',
                    [
                        $animation_class,
                        'zipli-image-hotspots-main-icons',
                        'elementor-repeater-item-' . $item['_id'],
                        'tooltip-wrapper',
                        'zipli-image-hotspots-main-icons-' . $item['_id']
                    ]);
                $this->add_render_attribute($list_item_key, 'data-tab', '#elementor-hotspots-tab-title-' . $item['_id']);
                ?>
                <div <?php $this->print_render_attribute_string($list_item_key); ?>
                        data-tooltip-content="#tooltip_content-<?php echo esc_attr($this->get_id()); ?>">
                    <?php
                    $link_type = $item['image_hotspots_link_type'];
                    if ($link_type == 'url') {
                        $link_url = $item['image_hotspots_url']['url'];
                    } elseif ($link_type == 'link') {
                        $link_url = get_permalink($item['image_hotspots_existing_page']);
                    }
                    if ($item['image_hotspots_link_switcher'] == 'yes' && $settings['image_hotspots_trigger_type'] == 'hover') :
                        ?>
                        <a class="zipli-image-hotspots-tooltips-link" href="<?php echo esc_url($link_url); ?>"
                           title="<?php echo esc_attr($item['image_hotspots_link_text']); ?>"
                           <?php if (!empty($item['image_hotspots_url']['is_external'])) : ?>target="_blank"
                           <?php endif; ?><?php if (!empty($item['image_hotspots_url']['nofollow'])) : ?>rel="nofollow"<?php endif; ?>>
                            <i class="zipli-image-hotspots-icon <?php echo esc_attr($settings['image_hotspots_infomation_show'] == 'yes' ? ' style-2' : ''); ?>"><span><?php echo esc_html($index + 1); ?></span></i>
                        </a>
                    <?php else : ?>
                        <i class="zipli-image-hotspots-icon <?php echo esc_attr($settings['image_hotspots_infomation_show'] == 'yes' ? ' style-2' : ''); ?>"><span><?php echo esc_html($index + 1); ?></span></i>
                    <?php endif; ?>
                    <div class="zipli-image-hotspots-tooltips-wrapper">
                        <div id="tooltip_content-<?php echo esc_attr($this->get_id()); ?>"
                             class="zipli-image-hotspots-tooltips-text zipli-image-hotspots-tooltips-text-<?php echo esc_attr($this->get_id()); ?>"><?php
                            if ($item['image_hotspots_content'] == 'elementor_templates') {
                                echo Plugin::instance()->frontend->get_builder_content_for_display($item['image_hotspots_tooltips_temp']);
                            } else {
                                echo zipli_parse_text_editor($item['image_hotspots_tooltips_texts']);
                            } ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

$widgets_manager->register(new Zipli_Elementor_Image_Hotspots_Widget());
