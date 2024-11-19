<?php

use HFE\Lib\Astra_Target_Rules_Fields;

class Zipli_breadcrumb {

    private static $_instance = null;

    public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        add_action('init', [$this, 'breadcrumb_register']);
        add_action('admin_menu', [$this, 'register_admin_menu'], 50);
        add_action('add_meta_boxes', [$this, 'ehf_register_metabox']);
        add_action('save_post', [$this, 'ehf_save_meta']);
        add_action('save_post', [$this, 'ehf_save_meta']);
        add_action('template_redirect', [$this, 'block_template_frontend']);
        add_filter('single_template', [$this, 'load_canvas_template']);
        add_action('hfe_header', [$this, 'render_breadcrumb'], 99);
        add_filter('zipli_page_title', [$this, 'hide_title']);

        add_action('wp_enqueue_scripts', [$this, 'scripts']);

    }


    public function breadcrumb_register() {
        $labels = [
            'name'               => esc_html__('Breadcrumbs', 'zipli'),
            'singular_name'      => esc_html__('Breadcrumb', 'zipli'),
            'menu_name'          => esc_html__('Breadcrumbs', 'zipli'),
            'name_admin_bar'     => esc_html__('Breadcrumb', 'zipli'),
            'add_new'            => esc_html__('Add New', 'zipli'),
            'add_new_item'       => esc_html__('Add New Breadcrumb', 'zipli'),
            'new_item'           => esc_html__('New Header Footer & Blocks Template', 'zipli'),
            'edit_item'          => esc_html__('Edit Header Footer & Blocks Template', 'zipli'),
            'view_item'          => esc_html__('View Header Footer & Blocks Template', 'zipli'),
            'all_items'          => esc_html__('All Breadcrumb', 'zipli'),
            'search_items'       => esc_html__('Search Header Footer & Blocks Templates', 'zipli'),
            'parent_item_colon'  => esc_html__('Parent Header Footer & Blocks Templates:', 'zipli'),
            'not_found'          => esc_html__('No Header Footer & Blocks Templates found.', 'zipli'),
            'not_found_in_trash' => esc_html__('No Header Footer & Blocks Templates found in Trash.', 'zipli'),
        ];

        $args = [
            'labels'              => $labels,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => ['title', 'thumbnail', 'elementor'],
        ];

        register_post_type('zipli-breadcrumb', $args);
    }


    /**
     * Register the admin menu for Header Footer & Blocks builder.
     *
     * @since  1.0.0
     * @since  1.0.1
     *         Moved the menu under Appearance -> Header Footer & Blocks Builder
     */
    public function register_admin_menu() {
        add_submenu_page(
            'themes.php',
            esc_html__('Breadcrumbs', 'zipli'),
            esc_html__('Breadcrumbs', 'zipli'),
            'edit_pages',
            'edit.php?post_type=zipli-breadcrumb'
        );
    }


    /**
     * Register meta box(es).
     */
    function ehf_register_metabox() {
        add_meta_box(
            'ehf-meta-box',
            esc_html__('Breadcrumb Options', 'zipli'),
            [
                $this,
                'efh_metabox_render',
            ],
            'zipli-breadcrumb',
            'normal',
            'high'
        );
    }

    function efh_metabox_render($post) {
        // We'll use this nonce field later on when saving.
        wp_nonce_field('ehf_meta_nounce', 'ehf_meta_nounce');
        ?>
        <table class="hfe-options-table widefat">
            <tbody>
            <?php
            // Load Target Rule assets.
            HFE\Lib\Astra_Target_Rules_Fields::get_instance()->admin_styles();

            $include_locations = get_post_meta(get_the_id(), 'ehf_target_include_locations', true);
            $exclude_locations = get_post_meta(get_the_id(), 'ehf_target_exclude_locations', true);
            $users             = get_post_meta(get_the_id(), 'ehf_target_user_roles', true);

            ?>
            <tr class="bsf-target-rules-row hfe-options-row">
                <td class="bsf-target-rules-row-heading hfe-options-row-heading">
                    <label><?php esc_html_e('Display On', 'zipli'); ?></label>
                    <i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
                       title="<?php echo esc_attr__('Add locations for where this template should appear.', 'zipli'); ?>"></i>
                </td>
                <td class="bsf-target-rules-row-content hfe-options-row-content">
                    <input type="hidden" id="ehf_template_type" value="breadcrumb">
                    <?php
                    HFE\Lib\Astra_Target_Rules_Fields::target_rule_settings_field(
                        'bsf-target-rules-location',
                        [
                            'title'          => esc_html__('Display Rules', 'zipli'),
                            'value'          => '[{"type":"basic-global","specific":null}]',
                            'tags'           => 'site,enable,target,pages',
                            'rule_type'      => 'display',
                            'add_rule_label' => esc_html__('Add Display Rule', 'zipli'),
                        ],
                        $include_locations
                    );
                    ?>
                </td>
            </tr>
            <tr class="bsf-target-rules-row hfe-options-row">
                <td class="bsf-target-rules-row-heading hfe-options-row-heading">
                    <label><?php esc_html_e('Do Not Display On', 'zipli'); ?></label>
                    <i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
                       title="<?php echo esc_attr__('Add locations for where this template should not appear.', 'zipli'); ?>"></i>
                </td>
                <td class="bsf-target-rules-row-content hfe-options-row-content">
                    <?php
                    HFE\Lib\Astra_Target_Rules_Fields::target_rule_settings_field(
                        'bsf-target-rules-exclusion',
                        [
                            'title'          => esc_html__('Exclude On', 'zipli'),
                            'value'          => '[]',
                            'tags'           => 'site,enable,target,pages',
                            'add_rule_label' => esc_html__('Add Exclusion Rule', 'zipli'),
                            'rule_type'      => 'exclude',
                        ],
                        $exclude_locations
                    );
                    ?>
                </td>
            </tr>
            <tr class="bsf-target-rules-row hfe-options-row">
                <td class="bsf-target-rules-row-heading hfe-options-row-heading">
                    <label><?php esc_html_e('User Roles', 'zipli'); ?></label>
                    <i class="bsf-target-rules-heading-help dashicons dashicons-editor-help" title="<?php echo esc_attr__('Display custom template based on user role.', 'zipli'); ?>"></i>
                </td>
                <td class="bsf-target-rules-row-content hfe-options-row-content">
                    <?php
                    HFE\Lib\Astra_Target_Rules_Fields::target_user_role_settings_field(
                        'bsf-target-rules-users',
                        [
                            'title'          => esc_html__('Users', 'zipli'),
                            'value'          => '[]',
                            'tags'           => 'site,enable,target,pages',
                            'add_rule_label' => esc_html__('Add User Rule', 'zipli'),
                        ],
                        $users
                    );
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
    }

    public function ehf_save_meta($post_id) {

        // Bail if we're doing an auto save.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail.
        if (!isset($_POST['ehf_meta_nounce']) || !wp_verify_nonce($_POST['ehf_meta_nounce'], 'ehf_meta_nounce')) {
            return;
        }

        // if our current user can't edit this post, bail.
        if (!current_user_can('edit_posts')) {
            return;
        }

        $target_locations = Astra_Target_Rules_Fields::get_format_rule_value($_POST, 'bsf-target-rules-location');
        $target_exclusion = Astra_Target_Rules_Fields::get_format_rule_value($_POST, 'bsf-target-rules-exclusion');
        $target_users     = [];

        if (isset($_POST['bsf-target-rules-users'])) {
            $target_users = array_map('sanitize_text_field', $_POST['bsf-target-rules-users']);
        }

        update_post_meta($post_id, 'ehf_target_include_locations', $target_locations);
        update_post_meta($post_id, 'ehf_target_exclude_locations', $target_exclusion);
        update_post_meta($post_id, 'ehf_target_user_roles', $target_users);
    }

    public function hide_title($val) {

        if ($this->get_template_id()) {
            $val = false;
        }

        return $val;
    }

    public static function get_template_id() {
        $option = [
            'location'  => 'ehf_target_include_locations',
            'exclusion' => 'ehf_target_exclude_locations',
            'users'     => 'ehf_target_user_roles',
        ];

        $hfe_templates = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions('zipli-breadcrumb', $option);

        foreach ($hfe_templates as $template) {
            return apply_filters('zipli_breadcrumb_id', $template['id']);
        }

        return '';
    }

    public function render_breadcrumb() {
        $template_id = $this->get_template_id();

        echo '<div class="breadcrumb-wrap"><div class="breadcrumb-overlay"></div>' . Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id) . '</div>';

    }

    public function scripts() {
        if ($this->get_template_id()) {

            if (class_exists('\Elementor\Core\Files\CSS\Post')) {
                $css_file = new \Elementor\Core\Files\CSS\Post($this->get_template_id());
            } elseif (class_exists('\Elementor\Post_CSS_File')) {
                $css_file = new \Elementor\Post_CSS_File($this->get_template_id());
            }

            $css_file->enqueue();
        }
    }

    /**
     * Don't display the elementor header footer & blocks templates on the frontend for non edit_posts capable users.
     *
     * @since  1.0.0
     */
    public function block_template_frontend() {
        if (is_singular('zipli-breadcrumb') && !current_user_can('edit_posts')) {
            wp_redirect(site_url(), 301);
            die;
        }
    }

    function load_canvas_template($single_template) {
        global $post;

        if ('zipli-breadcrumb' == $post->post_type) {
            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

            if (file_exists($elementor_2_0_canvas)) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }

        return $single_template;
    }

}

Zipli_breadcrumb::instance();
