<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Zipli_Elementor_Breadcrumb extends Elementor\Widget_Base {

    public function get_name() {
        return 'zipli-breadcrumb';
    }

    public function get_title() {
        return esc_html__('Zipli Breadcrumbs', 'zipli');
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs';
    }

    public function get_keywords() {
        return ['breadcrumbs'];
    }

    public function get_categories() {
        return array('zipli-addons');
    }
    protected function register_controls() {

        $this->start_controls_section(
            'section_product_rating_style',
            [
                'label' => esc_html__('Style Breadcrumbs', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wc_style_warning',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'zipli'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__('Link Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label'     => esc_html__('Link Color Hover', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .breadcrumb span',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'zipli'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'zipli'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'zipli'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'zipli'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb'     => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .zipli-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'listItem_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .breadcrumb-listItem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'listItem_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .breadcrumb-listItem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'display_list_item',
            [
                'label'        => esc_html__('Hidden List Item', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-zipli-list-item-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_product_rating_style_title',
            [
                'label' => esc_html__('Style Title', 'zipli'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_title',
            [
                'label'     => esc_html__('Title Color', 'zipli'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .zipli-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .zipli-title',
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label'        => esc_html__('Hidden Title', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-zipli-title-',
            ]
        );

        $this->add_control(
            'display_title_single',
            [
                'label'        => esc_html__('Hidden Title Single', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-zipli-title-single-'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'zipli'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .zipli-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $setting              = $this->get_settings_for_display();
        $display_title_single = $setting['display_title_single'];
        $hide_list_item       = $setting['display_title_single'] == 'yes';
        $hide_allway          = $setting['display_title'] == 'yes';
        $hide_single          = (is_singular('post') || is_singular('product')) && $display_title_single == 'yes';
        ?>
        <div class="breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php
            if (!$hide_allway) {
                if (!$hide_single) {
                    ?>
                    <h1 class="zipli-title"><?php
                        if (is_page() || is_single()) {
                            the_title();
                        } elseif (is_archive() && is_tax() && !is_category() && !is_tag()) {
                            $tax_object = get_queried_object();
                            echo esc_html($tax_object->name);
                        } elseif (is_category()) {
                            single_cat_title();
                        } elseif (is_home()) {
                            echo esc_html__('News', 'zipli');
                        } elseif (is_404()) {
                            echo esc_html__('Error 404', 'zipli');
                        } elseif (is_post_type_archive()) {
                            $tax_object = get_queried_object();
                            echo esc_html($tax_object->label);
                        } elseif (is_tag()) {
                            // Get tag information
                            $term_id  = get_query_var('tag_id');
                            $taxonomy = 'post_tag';
                            $args     = 'include=' . esc_attr($term_id);
                            $terms    = get_terms($taxonomy, $args);
                            // Display the tag name
                            if (isset($terms[0]->name)) {
                                echo esc_html($terms[0]->name);
                            }
                        } elseif (is_day()) {
                            echo esc_html__('Day Archives', 'zipli');
                        } elseif (is_month()) {
                            echo get_the_time('F') . esc_html__(' Archives', 'zipli');
                        } elseif (is_year()) {
                            echo get_the_time('Y') . esc_html__(' Archives', 'zipli');
                        } elseif (is_search()) {
                            esc_html_e('Search Results', 'zipli');
                        } elseif (is_author()) {
                            global $author;
                            if (!empty($author)) {
                                $usermetadata = get_userdata($author);
                                echo esc_html__('Author', 'zipli') . ': ' . $usermetadata->display_name;
                            }
                        }
                        ?></h1>
                    <?php
                }
            }
            if (zipli_is_bcn_nav_activated() && !$hide_list_item) {
                echo '<div class="breadcrumb-listItem">';
                bcn_display();
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new Zipli_Elementor_Breadcrumb());
