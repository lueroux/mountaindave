<?php

/**
 * Producta_Control control.
 *
 */
class Groups_Control extends \Elementor\Control_Select2 {

    public function get_type() {
        return 'groups';
    }

    public function enqueue() {

        wp_register_script('elementor-groups-control', get_theme_file_uri('/inc/elementor/elementor-control/select2.js'), ['jquery'], ZIPLI_VERSION, true);
        wp_enqueue_script('elementor-groups-control');
    }
}
