<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Zipli_Group
 */
class Zipli_Group {
    public $post_type = 'zipli_group';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Zipli_Group)) {
            self::$instance = new Zipli_Group();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('init', [$this, 'create_post_type']);
        if (zipli_is_cmb2_activated()) {
            add_action('init', [$this, 'setup_metabox']);
        }
    }

    public function setup_metabox() {
        add_action('cmb2_admin_init', [$this, 'metabox_group']);
    }

    public function metabox_group() {
        $prefix = 'zipli_';
        
        $cmb2   = new_cmb2_box(array(
            'id'           => $prefix . 'group_meta',
            'title'        => __('Infomation', 'zipli'),
            'object_types' => array('zipli_group'),
        ));

        $group_field_id = $cmb2->add_field(array(
            'id'      => 'group_meta_repeat',
            'type'    => 'group',
            'options' => array(
                'group_title'   => __('Entry {#}', 'zipli'),
                'add_button'    => __('Add Another Entry', 'zipli'),
                'remove_button' => __('Remove Entry', 'zipli'),
                'sortable'      => true,
            ),
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Title', 'zipli'),
            'id'   => 'title',
            'type' => 'text',
        ));
    }


    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => esc_html__('Groups', 'zipli'),
            'singular_name'      => esc_html__('Group', 'zipli'),
            'add_new'            => esc_html__('Add New Group', 'zipli'),
            'add_new_item'       => esc_html__('Add New Group', 'zipli'),
            'edit_item'          => esc_html__('Edit Group', 'zipli'),
            'new_item'           => esc_html__('New Group', 'zipli'),
            'view_item'          => esc_html__('View Group', 'zipli'),
            'search_items'       => esc_html__('Search Groups', 'zipli'),
            'not_found'          => esc_html__('No Groups found', 'zipli'),
            'not_found_in_trash' => esc_html__('No Groups found in Trash', 'zipli'),
            'parent_item_colon'  => esc_html__('Parent Group:', 'zipli'),
            'menu_name'          => esc_html__('Groups', 'zipli'),
        );

        $labels     = apply_filters('zipli_group_labels', $labels);
        $slug_field = apply_filters('zipli_group_slug', 'groups');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
                'public'        => true,
                'has_archive'   => false,
                'rewrite'       => array('slug' => $slug_field),
                'menu_position' => 5,
            )
        );
    }

}

Zipli_Group::getInstance();
