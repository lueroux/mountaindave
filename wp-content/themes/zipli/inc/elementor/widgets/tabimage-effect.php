<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

class Zipli_Elementor_Tabimage_Effect extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve tabimage widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'zipli-tabimage-effect';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabimage widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Zipli Tab Image Effect', 'zipli');
    }

    public function get_categories()
    {
        return array('zipli-addons');
    }


    public function get_script_depends() {
        return ['zipli-elementor-tabimage-effect'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_tabimage',
            [
                'label' => esc_html__('Tab Image Effect', 'zipli'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control('tabimage_title', [
            'label' => esc_html__('Title', 'zipli'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Title',
        ]);

        $repeater->add_control('tabimage_content', [
            'label' => esc_html__('Content', 'zipli'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
            'label_block' => true,
            'rows' => '8',
        ]);

        $repeater->add_control('tabimage_image', [
            'label' => esc_html__('Image', 'zipli'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('tabimage_link_text', [
            'label' => esc_html__('Button text', 'zipli'),
            'placeholder' => esc_html__('Find out more', 'zipli'),
            'type' => Controls_Manager::TEXT,
        ]);

        $repeater->add_control('tabimage_link', [
            'label' => esc_html__('Link to', 'zipli'),
            'placeholder' => esc_html__('https://your-link.com', 'zipli'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control(
            'tabimage-effect',
            [
                'label' => esc_html__('Tabimage Effect Item', 'zipli'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tabimage_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tabimage_image',
                'default' => 'full',
                'separator' => 'none',
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__('Columns', 'zipli'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => esc_html__('Gutter', 'zipli'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .d-grid' => 'grid-gap:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tabimage_background',
                'label' => esc_html__('Background', 'zipli'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}',
            ]
        );

        $this->end_controls_section();

        // Wrapper.
        $this->start_controls_section(
            'tabimage_wrapper',
            [
                'label' => esc_html__('Wrapper', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'items_width',
            [
                'label' => esc_html__('Width', 'zipli'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 10000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabimage-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_height',
            [
                'label' => esc_html__('Height', 'zipli'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabimage-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabimage-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-zipli-tabimage-effect .tabimage-item-image:after,{{WRAPPER}}.elementor-widget-zipli-tabimage-effect .tabimage-item-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Item.
        $this->start_controls_section(
            'tabimage_item',
            [
                'label' => esc_html__('Item', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_height',
            [
                'label' => esc_html__('Height', 'zipli'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tabimage-item-content' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tabimage-item-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'item_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tabimage-item-content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Title.
        $this->start_controls_section(
            'tabimage_title',
            [
                'label' => esc_html__('Title', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tabimage_title_typography',
                'selector' => '{{WRAPPER}} .tabimage-item-title',
            ]
        );

        $this->add_control(
            'tabimage_title_color',
            [
                'label'     => esc_html__('Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabimage-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabimage_title_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tabimage-item-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'tabimage_button',
            [
                'label' => esc_html__('Button', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->add_responsive_control(
            'padding_button',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => esc_html__('Border Radius', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render tabimage widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (!empty($settings['tabimage-effect']) && is_array($settings['tabimage-effect'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-tabimage-wrapper');
            $this->add_render_attribute('row', 'class', 'd-grid');
            $this->add_render_attribute('item', 'class', 'elementor-tabimage-item grid-item');

            $id_int = substr($this->get_id_int(), 0, 3);
            ?>
            <div class="elementor-tabimage-group">
            <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok.
            ?>>
                <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok.
                ?>>
                    <?php foreach ($settings['tabimage-effect'] as $index => $tabimage):
                        $item_setting_key = $this->get_repeater_setting_key('item', 'items', $index);
                        $this->add_render_attribute($item_setting_key, [
                            'class'         => [
                                'elementor-tabimage-item',
                                'grid-item',
                                ($index == 0) ? 'elementor-active' : '',
                            ],
                            'data-trigger' => $index
                        ]);?>
                        <div <?php $this->print_render_attribute_string($item_setting_key); ?>>
                            <?php

                            if (!empty($tabimage['tabimage_image']['id'])) {
                                $image = Group_Control_Image_Size::get_attachment_image_src($tabimage['tabimage_image']['id'], 'tabimage_image', $settings);
                                echo '<div class="tabimage-item-image" style="background-image:url(' . esc_attr($image) . ')"></div>';
                            }
                            ?>
                            <div class="tabimage-item-content">
                                <div class="tabimage-item-content-inner">
                                    <?php printf('<h4 class="tabimage-item-title">%s</h4>', $tabimage['tabimage_title']); // WPCS: XSS ok. ?>

                                    <div class="tabimage-item-content-hide">
                                    <?php
                                    printf('<div class="tabimage-item-text">%s</div>', $tabimage['tabimage_content']); // WPCS: XSS ok.
                                    ?>
                                    <div class="elementor-button-outline">
                                        <?php
                                        if (!empty($tabimage['tabimage_link']['url'])) {
                                            $this->add_render_attribute('link' . $tabimage['_id'], 'href', $tabimage['tabimage_link']['url']);
                                            $this->add_render_attribute('link' . $tabimage['_id'], 'class', 'elementor-button');

                                            if (!empty($tabimage['tabimage_link']['is_external'])) {
                                                $this->add_render_attribute('link' . $tabimage['_id'], 'target', '_blank');
                                            }
                                            echo '<a ' . $this->get_render_attribute_string('link' . $tabimage['_id']) . '><span class="elementor-button-content-wrapper"><span class="elementor-button-text"> '. esc_html($tabimage['tabimage_link_text']) . ' </span><span class="elementor-button-icon"><i class="zipli-icon-long-arrow-right"></i></span></span></a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
            <?php

        }
    }
}

$widgets_manager->register(new Zipli_Elementor_Tabimage_Effect());
