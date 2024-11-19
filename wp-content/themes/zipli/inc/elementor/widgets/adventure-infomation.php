<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;


/**
 * Class Zipli_Elementor_Adventure
 */
class Zipli_Elementor_Adventure_Infomation extends \Elementor\Widget_Base {

    public function get_name() {
        return 'zipli-adventures-infomation';
    }

    public function get_title() {
        return esc_html__('Zipli Adventure Detail Infomation', 'zipli');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array('zipli-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Adventure Infomation', 'zipli'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!is_singular('zipli_adventure')) {
            return;
        }
        $id = get_the_ID();
        ?>
        <div class="sinlge-adventure-meta">
            <?php if (has_post_thumbnail()) : ?>
                <div class="adventure-thumbnail">
                    <?php the_post_thumbnail('medium_large'); ?>
                </div>
            <?php endif; ?>
             <div class="sinlge-adventure-meta-inner">
                 <div class="sinlge-adventure-meta-list">
                    <?php
                    $age      = get_post_meta($id, 'zipli_adventure_age', true);
                    $duration = get_post_meta($id, 'zipli_adventure_duration', true);
                    $people   = get_post_meta($id, 'zipli_adventure_people', true);
                    $weight   = get_post_meta($id, 'zipli_adventure_weight', true);
                    $price    = get_post_meta($id, 'zipli_adventure_price', true);
                    $person    = get_post_meta($id, 'zipli_adventure_price_per', true);
                    $link    = get_post_meta($id, 'zipli_adventure_link', true);
                    ?>
                    <?php
                    if (!empty($age)) {
                        echo '<div class="meta-list"><i class="zipli-icon-smile"></i><span class="meta-name">' . esc_html__('Min Age', 'zipli') . '</span><span>' . esc_html($age) . '</span></div>';
                    }
                    if (!empty($duration)) {
                        echo '<div class="meta-list"><i class="zipli-icon-clock"></i><span class="meta-name">' . esc_html__('Duration', 'zipli') . '</span><span>' . esc_html($duration) . '</span></div>';
                    }
                    if (!empty($people)) {
                        echo '<div class="meta-list"><i class="zipli-icon-user"></i><span class="meta-name">' . esc_html__('Max People', 'zipli') . '</span><span>' . esc_html($people) . '</span></div>';
                    }
                    if (!empty($weight)) {
                        echo '<div class="meta-list"><i class="zipli-icon-weight"></i><span class="meta-name">' . esc_html__('Weight Range', 'zipli') . '</span><span>' . esc_html($weight) . '</span></div>';
                    }
                    if (!empty($price)) {
                        echo '<div class="meta-list"><i class="zipli-icon-tag1"></i><span class="meta-name">' . esc_html__('Price from', 'zipli') . '</span><span class="price">' . esc_html($price) . '</span><span>/' . esc_html($person) . '</span></div>';
                    }
                    ?>
                 </div>
                <?php
                if (!empty($link)) {
                    echo '<div class="adventure-button"><a class="adventure-link" href="' . esc_html($link) . '" ><span>' . esc_html__('Book Now', 'zipli') . '</span><i class="zipli-icon-long-arrow-right"></i></a></div>';
                }
                ?>
            </div>
        </div>
        <?php

    }
}

$widgets_manager->register(new Zipli_Elementor_Adventure_Infomation());