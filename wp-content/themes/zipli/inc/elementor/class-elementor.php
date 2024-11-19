<?php

use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Zipli_Elementor')) :

    /**
     * The Zipli Elementor Integration class
     */
    class Zipli_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/elements/categories_registered', [$this, 'register_widget_category']);
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/controls_registered', [$this, 'add_icons']);

            if (!zipli_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/sticky-section.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
                require get_theme_file_path('inc/elementor/motion-fx/controls-group.php');
                require get_theme_file_path('inc/elementor/motion-fx/module.php');
            }

            require get_theme_file_path('inc/elementor/modules/page-settings.php');
            if (function_exists('hfe_init')) {
                require get_theme_file_path('inc/elementor/modules/header-settings.php');
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }

                $var = "body{{$css}}";
                wp_add_inline_style('zipli-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts['Hiatus']   = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'zipli');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_script('zipli-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend'. $suffix . '.js'), [], ZIPLI_VERSION);
        }

        public function add_style_editor() {

            wp_enqueue_style('zipli-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], ZIPLI_VERSION);
        }

        public function add_scripts() {

            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('zipli-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', ZIPLI_VERSION);
            wp_style_add_data('zipli-elementor', 'rtl', 'replace');

            // Add Scripts

            $e_swiper_latest     = Plugin::$instance->experiments->is_feature_active('e_swiper_latest');
            $e_swiper_asset_path = $e_swiper_latest ? 'assets/lib/swiper/v8/' : 'assets/lib/swiper/';
            $e_swiper_version    = $e_swiper_latest ? '8.4.5' : '5.3.6';
            wp_register_script(
                'swiper',
                plugins_url('elementor/' . $e_swiper_asset_path . 'swiper.js', 'elementor'),
                [],
                $e_swiper_version,
                true
            );
        }

        public function register_auto_scripts_frontend() {
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_register_script('zipli-elementor-swiper', get_theme_file_uri('/assets/js/elementor-swiper' . $suffix . '.js'), array('jquery', 'elementor-frontend'), ZIPLI_VERSION, true);
            // Register auto scripts frontend

            $files  = glob(get_theme_file_path('/assets/js/elementor/*' . $suffix . '.js'));
            foreach ($files as $file) {
                $file_name = wp_basename($file);
                $handle    = str_replace($suffix.".js", '', $file_name);
                $scr       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
                if (file_exists($file)) {
                    wp_register_script('zipli-elementor-' . $handle, $scr, ['jquery', 'elementor-frontend'], ZIPLI_VERSION, true);
                }
            }
        }

        public function register_widget_category($this_cat) {
            $this_cat->add_category(
                'zipli-addons',
                [
                    'title' => esc_html__('Zipli Addons', 'zipli'),
                    'icon'  => 'fa fa-plug',
                ]
            );
            return $this_cat;
        }

        public function add_animations_scroll($animations) {
            $animations['Zipli Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            require 'base-swiper-widget.php';
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"zipli-icon-angle-down":"angle-down","zipli-icon-angle-left":"angle-left","zipli-icon-angle-right":"angle-right","zipli-icon-angle-up":"angle-up","zipli-icon-arrow-left":"arrow-left","zipli-icon-arrow-right":"arrow-right","zipli-icon-arrow-triangel":"arrow-triangel","zipli-icon-binoculars":"binoculars","zipli-icon-checkbox-circle":"checkbox-circle","zipli-icon-collaborate":"collaborate","zipli-icon-compass":"compass","zipli-icon-discount":"discount","zipli-icon-e-mail":"e-mail","zipli-icon-long-arrow-left":"long-arrow-left","zipli-icon-long-arrow-right":"long-arrow-right","zipli-icon-mail":"mail","zipli-icon-map-pin":"map-pin","zipli-icon-phone":"phone","zipli-icon-play":"play","zipli-icon-route":"route","zipli-icon-star-1":"star-1","zipli-icon-tag1":"tag1","zipli-icon-team-management":"team-management","zipli-icon-tent":"tent","zipli-icon-weight":"weight","zipli-icon-360":"360","zipli-icon-bars":"bars","zipli-icon-cart-empty":"cart-empty","zipli-icon-check-square":"check-square","zipli-icon-chevron-down":"chevron-down","zipli-icon-chevron-left":"chevron-left","zipli-icon-chevron-right":"chevron-right","zipli-icon-chevron-up":"chevron-up","zipli-icon-circle":"circle","zipli-icon-clock":"clock","zipli-icon-cloud-download-alt":"cloud-download-alt","zipli-icon-comment":"comment","zipli-icon-comments":"comments","zipli-icon-contact":"contact","zipli-icon-credit-card":"credit-card","zipli-icon-dot-circle":"dot-circle","zipli-icon-edit":"edit","zipli-icon-envelope":"envelope","zipli-icon-expand-alt":"expand-alt","zipli-icon-external-link-alt":"external-link-alt","zipli-icon-file-alt":"file-alt","zipli-icon-file-archive":"file-archive","zipli-icon-folder-open":"folder-open","zipli-icon-folder":"folder","zipli-icon-frown":"frown","zipli-icon-gift":"gift","zipli-icon-grid":"grid","zipli-icon-grip-horizontal":"grip-horizontal","zipli-icon-heart-fill":"heart-fill","zipli-icon-history":"history","zipli-icon-home":"home","zipli-icon-info-circle":"info-circle","zipli-icon-instagram":"instagram","zipli-icon-level-up-alt":"level-up-alt","zipli-icon-list":"list","zipli-icon-map-marker-check":"map-marker-check","zipli-icon-meh":"meh","zipli-icon-minus-circle":"minus-circle","zipli-icon-minus":"minus","zipli-icon-mobile-android-alt":"mobile-android-alt","zipli-icon-money-bill":"money-bill","zipli-icon-pencil-alt":"pencil-alt","zipli-icon-plus":"plus","zipli-icon-quote":"quote","zipli-icon-random":"random","zipli-icon-reply-all":"reply-all","zipli-icon-reply":"reply","zipli-icon-search":"search","zipli-icon-shield-check":"shield-check","zipli-icon-shopping-basket":"shopping-basket","zipli-icon-sign-out-alt":"sign-out-alt","zipli-icon-smile":"smile","zipli-icon-spinner":"spinner","zipli-icon-square":"square","zipli-icon-star":"star","zipli-icon-store":"store","zipli-icon-sync":"sync","zipli-icon-tachometer-alt":"tachometer-alt","zipli-icon-thumbtack":"thumbtack","zipli-icon-ticket":"ticket","zipli-icon-times-circle":"times-circle","zipli-icon-times-square":"times-square","zipli-icon-times":"times","zipli-icon-trophy-alt":"trophy-alt","zipli-icon-truck":"truck","zipli-icon-user":"user","zipli-icon-video":"video","zipli-icon-wishlist-empty":"wishlist-empty","zipli-icon-adobe":"adobe","zipli-icon-amazon":"amazon","zipli-icon-android":"android","zipli-icon-angular":"angular","zipli-icon-apper":"apper","zipli-icon-apple":"apple","zipli-icon-atlassian":"atlassian","zipli-icon-behance":"behance","zipli-icon-bitbucket":"bitbucket","zipli-icon-bitcoin":"bitcoin","zipli-icon-bity":"bity","zipli-icon-bluetooth":"bluetooth","zipli-icon-btc":"btc","zipli-icon-centos":"centos","zipli-icon-chrome":"chrome","zipli-icon-codepen":"codepen","zipli-icon-cpanel":"cpanel","zipli-icon-discord":"discord","zipli-icon-dochub":"dochub","zipli-icon-docker":"docker","zipli-icon-dribbble":"dribbble","zipli-icon-dropbox":"dropbox","zipli-icon-drupal":"drupal","zipli-icon-ebay":"ebay","zipli-icon-facebook-f":"facebook-f","zipli-icon-facebook-r":"facebook-r","zipli-icon-facebook":"facebook","zipli-icon-figma":"figma","zipli-icon-firefox":"firefox","zipli-icon-google-plus":"google-plus","zipli-icon-google":"google","zipli-icon-grunt":"grunt","zipli-icon-gulp":"gulp","zipli-icon-html5":"html5","zipli-icon-joomla":"joomla","zipli-icon-link-brand":"link-brand","zipli-icon-linkedin":"linkedin","zipli-icon-mailchimp":"mailchimp","zipli-icon-opencart":"opencart","zipli-icon-paypal":"paypal","zipli-icon-pinterest-p":"pinterest-p","zipli-icon-reddit":"reddit","zipli-icon-skype":"skype","zipli-icon-slack":"slack","zipli-icon-snapchat":"snapchat","zipli-icon-spotify":"spotify","zipli-icon-trello":"trello","zipli-icon-twitter-x":"twitter-x","zipli-icon-twitter":"twitter","zipli-icon-vimeo":"vimeo","zipli-icon-whatsapp":"whatsapp","zipli-icon-wordpress":"wordpress","zipli-icon-yoast":"yoast","zipli-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {

            $tabs['opal-custom'] = [
                'name'          => 'zipli-icon',
                'label'         => esc_html__('Zipli Icon', 'zipli'),
                'prefix'        => 'zipli-icon-',
                'displayPrefix' => 'zipli-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => ZIPLI_VERSION,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Zipli_Elementor();
