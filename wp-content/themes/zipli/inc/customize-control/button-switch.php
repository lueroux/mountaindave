<?php
if (!defined( 'ABSPATH' )) {
    exit;
}

/**
 * Class OSF_Customize_Control_Button_Switch
 */
class Zipli_Customize_Control_Button_Switch extends WP_Customize_Control {
    public $type    = 'zipli-button-switch';
    public function enqueue() {
        wp_enqueue_style(
            'zipli-button-switch',
            get_template_directory_uri() . '/assets/css/admin/button-switch.css',
            '',
            ZIPLI_VERSION
        );
    }

    /**
     * Render the control.
     */
    public function render_content() {
        if ($this->label) {
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php
        }

        if ($this->description) {
            ?>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
        }
        ?>
            <input class="zipli-switch zipli-switch-ios" id="<?php echo esc_attr($this->id); ?>" type="checkbox" <?php $this->link(); ?>>
            <label class="zipli-switch-btn" for="<?php echo esc_attr($this->id); ?>"></label>
        <?php
    }
}