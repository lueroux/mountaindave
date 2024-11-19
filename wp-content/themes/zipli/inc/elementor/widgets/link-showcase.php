<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;
use Elementor\Utils;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Zipli_Elementor_Link_Showcase extends Widget_Base {

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
        return 'zipli-link-showcase';
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
        return esc_html__('Zipli Link Showcase', 'zipli');
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
        return 'eicon-tabs';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since 2.1.0
     * @access public
     *
     */
    public function get_keywords() {
        return ['tabs', 'accordion', 'toggle', 'link', 'showcase'];
    }

    public function get_script_depends() {
        return ['zipli-elementor-link-showcase'];
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
            'section_items',
            [
                'label' => esc_html__('Items', 'zipli'),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'zipli'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Title', 'zipli'),
                'placeholder' => esc_html__('Title', 'zipli'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'linksc_desc',
            [
                'label'       => esc_html__('Content', 'zipli'),
                'placeholder' => esc_html__('Content', 'zipli'),
                'type'        => Controls_Manager::TEXTAREA,
                'show_label'  => false,
            ]
        );

        $repeater->add_control(
            'link_image',
            [
                'label'   => esc_html__('Choose Image', 'zipli'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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

        $this->add_control(
            'items',
            [
                'label'       => esc_html__('Items', 'zipli'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'    => esc_html__('Title #1', 'zipli'),
                        'subtitle' => esc_html__('Subtitle #1', 'zipli'),
                        'link'     => esc_html__('#', 'zipli'),
                    ],
                    [
                        'title'    => esc_html__('Title #2', 'zipli'),
                        'subtitle' => esc_html__('Subtitle #2', 'zipli'),
                        'link'     => esc_html__('#', 'zipli'),
                    ],
                    [
                        'title'    => esc_html__('Title #3', 'zipli'),
                        'subtitle' => esc_html__('Subtitle #3', 'zipli'),
                        'link'     => esc_html__('#', 'zipli'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'link_layout',
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'link_image',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => esc_html__('Wapper', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_reverse',
            [
                'label'        => esc_html__('Reverse', 'zipli'),
                'type'         => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-inner' => 'flex-direction:row-reverse',
                ],
                'condition' => [
                    'link_layout' => '2',
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

        $this->add_responsive_control(
            'linksc_gap', [
            'label' => esc_html__( 'Gap', 'zipli' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 400,
                ],
            ],
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-link-showcase-inner' => 'gap: {{SIZE}}{{UNIT}}',
            ],
        ] );

        $this->add_responsive_control(
            'min-height',
            [
                'label'      => esc_html__('Height', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .link-showcase-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_width', [
            'label' => esc_html__( 'Width', 'zipli' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                '%' => [
                    'min' => 10,
                    'max' => 90,
                ],
                'px' => [
                    'min' => 20,
                    'max' => 800,
                ],
            ],
            'default' => [
                'unit' => '%',
            ],
            'size_units' => [ '%', 'px' ],
            'selectors' => [
                '{{WRAPPER}} .link-showcase-title-wrapper' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
            ],
        ] );

        $this->add_responsive_control( 'item_space_between', [
            'label' => esc_html__( 'Gap between item', 'zipli' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 400,
                ],
            ],
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .link-showcase-title-inner' => 'display: flex; flex-direction: column; gap: {{SIZE}}{{UNIT}}',
            ],
        ] );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'zipli' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'tab_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'zipli' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-link-showcase-title .link-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Spacing', 'zipli' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .link-showcase-title-wrapper .link-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_desc_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'zipli' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_content',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-link-showcase-title .linksc-desc',
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
            'title_color',
            [
                'label'     => esc_html__('Title', 'zipli'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title .link-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_content_color',
            [
                'label'     => esc_html__('Description', 'zipli'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title .linksc-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'colors_hover',
            [
                'label' => esc_html__( 'Hover', 'zipli' ),
            ]
        );

        $this->add_control(
            'title_color_active',
            [
                'label'     => esc_html__('Title', 'zipli'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title.elementor-active .link-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_content_color_active',
            [
                'label'     => esc_html__('Description', 'zipli'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title.elementor-active .linksc-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_bg_hover',
            [
                'label'     => esc_html__('Background Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-link-showcase-title:after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'link_layout' => '2',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__('Image', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_alignment',
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
                'prefix_class' => 'image-align-',
            ]
        );

        $this->add_responsive_control(
            'image_min_width',
            [
                'label'      => esc_html__('Width', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-link-showcase-content img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .link-showcase-contnet-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-link-showcase-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        if (!empty($settings['items']) && is_array($settings['items'])) {
            $items = $settings['items'];
            // Row
            $this->add_render_attribute('wrapper', 'class', 'elementor-link-showcase-wrapper');
            $this->add_render_attribute('row', 'class', 'layout-' . esc_attr($settings['link_layout']));
            $this->add_render_attribute('row', 'class', 'elementor-link-showcase-inner');
            $this->add_render_attribute('row', 'role', 'tablist');
            $id_int = substr($this->get_id_int(), 0, 3);
            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div <?php $this->print_render_attribute_string('row'); ?>>
                    <div class="link-showcase-item link-showcase-title-wrapper">
                        <div class="link-showcase-title-inner">
                            <?php foreach ($items as $index => $item) :
                                $count = $index + 1;
                                $item_title_setting_key = $this->get_repeater_setting_key('item_title', 'items', $index);
                                $this->add_render_attribute($item_title_setting_key, [
                                    'id'            => 'elementor-link-showcase-title-' . $id_int . $count,
                                    'class'         => [
                                        'elementor-link-showcase-title',
                                        ($index == 0) ? 'elementor-active' : '',
                                        'elementor-repeater-item-' . $item['_id']
                                    ],
                                    'data-tab'      => $count,
                                    'role'          => 'tab',
                                    'aria-controls' => 'elementor-link-showcase-content-' . $id_int . $count,
                                ]);

                                $title = $item['title'];
                                if (!empty($item['link']['url'])) {
                                    $title = '<a href="' . esc_url($item['link']['url']) . '">' . $title . '</a>';
                                }
                                ?>
                                <div <?php $this->print_render_attribute_string($item_title_setting_key); ?>>
                                    <div class="link-showcase-title-wrap">
                                        <div class="link-title"><?php echo wp_kses_post($title); ?></div>
                                        <?php if (!empty($item['linksc_desc'])) { ?>
                                            <div class="linksc-desc"><?php echo sprintf('%s', $item['linksc_desc']); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="link-showcase-item link-showcase-contnet-wrapper">
                        <div class="link-showcase-contnet-inner">
                            <?php foreach ($items as $index => $item) :
                                $count = $index + 1;
                                $item_content_setting_key = $this->get_repeater_setting_key('item_content', 'items', $index);
                                $this->add_render_attribute($item_content_setting_key, [
                                    'id'            => 'elementor-link-showcase-content-' . $id_int . $count,
                                    'class'         => [
                                        'elementor-link-showcase-content',
                                        'elementor-repeater-item-' . $item['_id'],
                                        ($index == 0) ? 'elementor-active' : '',
                                    ],
                                    'data-tab'      => $count,
                                    'role'          => 'tab',
                                    'aria-controls' => 'elementor-link-showcase-title-' . $id_int . $count,
                                ]);
                                ?>
                                <div <?php $this->print_render_attribute_string($item_content_setting_key); ?>>
                                        <?php $this->render_image($settings, $item); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    private function render_image($settings, $item) {
        if (!empty($item['link_image']['url'])) :
            ?>
            <?php
            $item['link_image_size']             = $settings['link_image_size'];
            $item['link_image_custom_dimension'] = $settings['link_image_custom_dimension'];
            echo Group_Control_Image_Size::get_attachment_image_html($item, 'link_image');
            ?>
        <?php
        endif;
    }

}

$widgets_manager->register(new Zipli_Elementor_Link_Showcase());
