<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Zipli_Adventure
 */
class Zipli_Adventure {
    public $post_type = 'zipli_adventure';
    public $taxonomy  = 'zipli_adventure_cat';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Zipli_Adventure)) {
            self::$instance = new Zipli_Adventure();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('init', [$this, 'create_post_type']);
        add_action('init', [$this, 'create_taxonomy']);
        add_action('cmb2_admin_init', array($this, 'create_meta_box'));
        add_action('cmb2_admin_init', [$this, 'zipli_register_theme_options_metabox']);

        add_action('pre_get_posts', [$this, 'posts_per_page']);

    }

    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => esc_html__('Adventures', 'zipli'),
            'singular_name'      => esc_html__('Adventure', 'zipli'),
            'add_new'            => esc_html__('Add New Adventure', 'zipli'),
            'add_new_item'       => esc_html__('Add New Adventure', 'zipli'),
            'edit_item'          => esc_html__('Edit Adventure', 'zipli'),
            'new_item'           => esc_html__('New Adventure', 'zipli'),
            'view_item'          => esc_html__('View Adventure', 'zipli'),
            'search_items'       => esc_html__('Search Adventures', 'zipli'),
            'not_found'          => esc_html__('No Adventures found', 'zipli'),
            'not_found_in_trash' => esc_html__('No Adventures found in Trash', 'zipli'),
            'parent_item_colon'  => esc_html__('Parent Adventure:', 'zipli'),
            'menu_name'          => esc_html__('Adventures', 'zipli'),
        );

        $labels     = apply_filters('zipli_adventure_labels', $labels);
        $slug_field = apply_filters('zipli_adventure_slug', 'adventures');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug_field),
                'menu_position' => 5,
                'categories'    => array(),
            )
        );
    }

    public function create_taxonomy() {
        $labels         = array(
            'name'              => __('Categories', 'zipli'),
            'singular_name'     => __('Category', 'zipli'),
            'search_items'      => __('Search Category', 'zipli'),
            'all_items'         => __('All Categories', 'zipli'),
            'parent_item'       => __('Parent Category', 'zipli'),
            'parent_item_colon' => __('Parent Category:', 'zipli'),
            'edit_item'         => __('Edit Category', 'zipli'),
            'update_item'       => __('Update Category', 'zipli'),
            'add_new_item'      => __('Add New Category', 'zipli'),
            'new_item_name'     => __('New Category Name', 'zipli'),
            'menu_name'         => __('Categories', 'zipli'),
        );
        $labels         = apply_filters('zipli_postype_adventure_cat_labels', $labels);
        $slug_cat_field = apply_filters('slug_category_adventure', 'category-adventure');
        $args           = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_nav_menus' => true,
            'rewrite'           => array('slug' => $slug_cat_field)
        );
        // Now register the taxonomy
        register_taxonomy($this->taxonomy, array($this->post_type), $args);
    }

    public function create_meta_box() {
        $prefix = 'zipli_';
        $cmb2   = new_cmb2_box(array(
            'id'           => $prefix . 'adventure_meta',
            'title'        => __('Infomation', 'zipli'),
            'object_types' => array('zipli_adventure'),
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Price from', 'zipli'),
            'id'   => $prefix . 'adventure_price',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Price from per', 'zipli'),
            'id'   => $prefix . 'adventure_price_per',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Min Age', 'zipli'),
            'id'   => $prefix . 'adventure_age',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Duration', 'zipli'),
            'id'   => $prefix . 'adventure_duration',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Max People', 'zipli'),
            'id'   => $prefix . 'adventure_people',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Weight Range', 'zipli'),
            'id'   => $prefix . 'adventure_weight',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Book Link', 'zipli'),
            'id'   => $prefix . 'adventure_link',
            'type' => 'text_url',
        ));

    }

    public function zipli_register_theme_options_metabox() {

        /**
         * Registers options page menu item and form.
         */
        $cmb2 = new_cmb2_box(array(
            'id'           => 'zipli_adventure_archive',
            'title'        => esc_html__('Adventures Setting', 'zipli'),
            'object_types' => array('options-page'),
            'option_key'   => 'zipli_adventure_archive',
            'position'     => 8,
        ));

        $cmb2->add_field(array(
            'name'             => esc_html__('Archive Style', 'zipli'),
            'id'               => 'archive_style',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => 'style-1',
            'options'          => array(
                'style-1' => esc_html__('Style 1', 'zipli'),
                'style-2' => esc_html__('Style 2', 'zipli'),
                'style-3' => esc_html__('Style 3', 'zipli'),
            ),
        ));

        $cmb2->add_field(array(
            'name'             => esc_html__('Columns Desktop', 'zipli'),
            'id'               => 'columns_desktop',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => '3',
            'options'          => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ),
        ));
        $cmb2->add_field(array(
            'name'             => esc_html__('Columns Tablet', 'zipli'),
            'id'               => 'columns_tablet',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => '2',
            'options'          => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ),
        ));

        $cmb2->add_field(array(
            'name'             => esc_html__('Columns Mobile', 'zipli'),
            'id'               => 'columns_mobile',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => '1',
            'options'          => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ),
        ));

        $cmb2->add_field(array(
            'name'    => __('Gutter (px)', 'zipli'),
            'id'      => 'gutter',
            'type'    => 'text',
            'default' => 30,
        ));

        $cmb2->add_field(array(
            'name'    => __('Posts Per Page', 'zipli'),
            'id'      => 'posts_per_page',
            'type'    => 'text',
            'default' => 9,
        ));
    }

    public function posts_per_page($query) {
        $options        = get_option('zipli_adventure_archive');
        $posts_per_page = 9;
        if ($options && is_array($options)) {
            $posts_per_page = isset($options['posts_per_page']) ? $options['posts_per_page'] : 9;
        }
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('zipli_adventure') || is_tax('zipli_adventure_cat')) {
            $query->set('posts_per_page', $posts_per_page);
        }
    }

}

Zipli_Adventure::getInstance();


function zipli_adventure_item_get_price($id) {
    $price = get_post_meta($id, 'zipli_adventure_price', true);
    if (!empty($price)) {
        ?>
        <div class="adventure-item-price-from">
            <div class="price-title"><?php echo esc_html__('from', ''); ?></div>
            <div class="price-value"><?php echo esc_html($price); ?></div>
        </div>
        <?php
    }
}

function zipli_adventure_item_get_meta($id) {
    $age      = get_post_meta($id, 'zipli_adventure_age', true);
    $duration = get_post_meta($id, 'zipli_adventure_duration', true);
    $people   = get_post_meta($id, 'zipli_adventure_people', true);
    if (!empty($age) || !empty($duration) || !empty(($people))) {
        ?>
        <div class="adventure-item-meta">
            <?php
            if (!empty($age)) {
                echo '<div><i class="zipli-icon-smile"></i><span>' . sprintf('%1s %2s',esc_html__('Ages','zipli'),esc_html($age)) . '</span></div>';
            }
            if (!empty($duration)) {
                echo '<div><i class="zipli-icon-clock"></i><span>' . esc_html($duration) . '</span></div>';
            }
            if (!empty($people)) {
                echo '<div><i class="zipli-icon-user"></i><span>' . sprintf('%1s %2s',esc_html__('Max','zipli'),esc_html($people)) . '</span></div>';
            }
            ?>
        </div>
        <?php
    }
}
