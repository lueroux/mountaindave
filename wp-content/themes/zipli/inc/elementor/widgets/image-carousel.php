<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Zipli_Elementor_ImageCarousel extends Zipli_Base_Widgets_Swiper {
    /**
     * Get widget name.
     *
     * Retrieve imagecarousel widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'zipli-image-carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve imagecarousel widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Zipli ImageCarousel', 'zipli');
    }

    /**
     * Get widget icon.
     *
     * Retrieve imagecarousel widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_script_depends() {
        return ['zipli-elementor-image-carousel', 'zipli-elementor-swiper'];
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    /**
     * Register imagecarousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_imagecarousel',
            [
                'label' => esc_html__('ImageCarousel', 'zipli'),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Add Images', 'zipli' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label'        => esc_html__('Columns', 'zipli'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 1,
                'options'      => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                'selectors' => [
                    '{{WRAPPER}} .d-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
                'condition' => ['enable_carousel!' => 'yes']
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
                'condition'  => ['enable_carousel!' => 'yes']
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable Carousel', 'zipli'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        // Carousel options
        $this->add_control_carousel(['enable_carousel' => 'yes']);

    }

    /**
     * Render imagecarousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-imagecarousel-item-wrapper');

        // Carousel
        $this->get_data_elementor_columns();

        $item_number = 0;
        $html = '';
        $item_count = count($settings['carousel']);

        foreach ( $settings['carousel'] as $index => $attachment ) {

            if ($item_number%2 == 0){
                $html .= '<div class="elementor-imagecarousel-item swiper-slide">';
                $html .='<img class="image-carousel" src="' . esc_attr( $attachment['url'] ) . '" alt="'.esc_attr($index).'" />';
            }
            else{
                $html .='<img class="image-carousel" src="' . esc_attr( $attachment['url'] ) . '" alt="'.esc_attr($index).'" />';
                $html .='</div>';
            }

            $item_number++;
        }

        if ($item_count%2 == 1){
            $html .= '</div>';
        }

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); // WPCS: XSS ok. ?>>

            <div <?php $this->print_render_attribute_string('row'); // WPCS: XSS ok. ?>>
                <?php printf('%s', $html); ?>
            </div>
        </div>
        <?php $this->render_swiper_pagination_navigation();?>
        <?php
    }
}

$widgets_manager->register(new Zipli_Elementor_ImageCarousel());

