<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Zipli_Customize')) {

    class Zipli_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
            add_action('wp_enqueue_scripts', [$this, 'customize_custom_css']);
        }


        public function customize_custom_css() {
            $line_color = zipli_get_theme_option('line_color', '#e3e3e3');
            $css = '--vertical-line-color:'.$line_color.';';
            $var = "body{{$css}}";
            wp_add_inline_style('zipli-style', $var);
        }
        
        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            require_once get_theme_file_path('inc/customize-control/button-switch.php');
            
            $this->init_zipli_blog($wp_customize);

            $this->init_zipli_social($wp_customize);

            $this->init_zipli_scroll($wp_customize);

            do_action('zipli_customize_register', $wp_customize);
        }


        public function init_zipli_scroll($wp_customize) {

            $wp_customize->add_section('zipli_settings', array(
                'title' => esc_html__('Zipli Settings', 'zipli'),
            ));

            $wp_customize->add_setting('zipli_options_smooth_scroll', array(
                'type'              => 'option',
                'default'           => '',
                'sanitize_callback' => 'zipli_sanitize_button_switch',
            ));

            $wp_customize->add_control(new Zipli_Customize_Control_Button_Switch( $wp_customize, 'zipli_options_smooth_scroll', array(
                'section' => 'zipli_settings',
                'label' => esc_html__( 'Enable', 'zipli' ),
                'description' => esc_html__('Smooth Scroll On Windows', 'zipli'),
            ) ));

            $wp_customize->add_setting('zipli_options_enable_backtop', array(
                'type'              => 'option',
                'default'           => '',
                'sanitize_callback' => 'zipli_sanitize_button_switch',
            ));

            $wp_customize->add_control(new Zipli_Customize_Control_Button_Switch($wp_customize, 'zipli_options_enable_backtop', array(
                'section'   => 'zipli_settings',
                'transport' => 'refresh',
                'label'     => esc_html__('Enable back to top', 'zipli'),
            )));
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_zipli_blog($wp_customize) {

            $wp_customize->add_section('zipli_blog_archive', array(
                'title' => esc_html__('Blog', 'zipli'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('zipli_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_blog_style', array(
                'section' => 'zipli_blog_archive',
                'label'   => esc_html__('Blog style', 'zipli'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'zipli'),
                    //====start_premium
                    'style-1'  => esc_html__('Blog Grid', 'zipli'),
                    'list'     => esc_html__('Blog List', 'zipli'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('zipli_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_blog_columns', array(
                'section' => 'zipli_blog_archive',
                'label'   => esc_html__('Colunms', 'zipli'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'zipli'),
                    2 => esc_html__('2', 'zipli'),
                    3 => esc_html__('3', 'zipli'),
                    4 => esc_html__('4', 'zipli'),
                ),
            ));

            $wp_customize->add_setting('zipli_options_blog_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'right',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_blog_archive_sidebar', array(
                'section' => 'zipli_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'zipli'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'zipli'),
                    'right' => esc_html__('Right', 'zipli'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_zipli_social($wp_customize) {

            $wp_customize->add_section('zipli_social', array(
                'title' => esc_html__('Socials', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Show Social Share', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Facebook', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Twitter', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Linkedin', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Google+', 'zipli'),
            ));

            $wp_customize->add_setting('zipli_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Pinterest', 'zipli'),
            ));
            $wp_customize->add_setting('zipli_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('zipli_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'zipli_social',
                'label'   => esc_html__('Share on Email', 'zipli'),
            ));
        }
    }
}
return new Zipli_Customize();
