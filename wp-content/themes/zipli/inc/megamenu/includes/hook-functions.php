<?php

defined('ABSPATH') || exit();

/**
 * Hook to delete post elementor related with this menu
 */
add_action("before_delete_post", "zipli_megamenu_on_delete_menu_item", 9);
function zipli_megamenu_on_delete_menu_item($post_id) {
    if (is_nav_menu_item($post_id)) {
        $related_id = zipli_megamenu_get_post_related_menu($post_id);
        if ($related_id) {
            wp_delete_post($related_id, true);
        }
    }
}


add_filter('elementor/editor/footer', 'zipli_megamenu_add_back_button_inspector');
function zipli_megamenu_add_back_button_inspector() {
    if (!isset($_GET['zipli-menu-editable']) || !$_GET['zipli-menu-editable']) {
        return;
    }
    ?>
    <script type="text/template" id="tmpl-elementor-panel-footer-content">
        <div id="elementor-panel-footer-back-to-admin" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e('Back', 'zipli'); ?>">
            <i class="eicon-close" aria-hidden="true"></i>
        </div>
        <div id="elementor-panel-footer-settings" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e('Settings', 'zipli'); ?>">
            <i class="eicon-cog" aria-hidden="true"></i>
            <span class="elementor-screen-only"><?php echo esc_html__('Page Settings', 'zipli'); ?></span>
        </div>
        <div id="elementor-panel-footer-navigator" class="elementor-panel-footer-tool tooltip-target" data-tooltip="<?php esc_attr_e('Navigator', 'zipli'); ?>">
            <i class="eicon-navigator" aria-hidden="true"></i>
            <span class="elementor-screen-only">
                    <?php echo esc_html__('Navigator', 'zipli'); ?>
                </span>
        </div>
        <div id="elementor-panel-footer-responsive" class="elementor-panel-footer-tool">
            <i class="eicon-device-desktop tooltip-target" aria-hidden="true" data-tooltip="<?php esc_attr_e('Responsive Mode', 'zipli'); ?>"></i>
            <span class="elementor-screen-only">
					<?php echo esc_html__('Responsive Mode', 'zipli'); ?>
				</span>
        </div>
        <div id="elementor-panel-footer-history" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e('History', 'zipli'); ?>">
            <i class="eicon-history" aria-hidden="true"></i>
            <span class="elementor-screen-only"><?php echo esc_html__('History', 'zipli'); ?></span>
        </div>
        <div id="elementor-panel-footer-saver-publish" class="elementor-panel-footer-tool">
            <button id="elementor-panel-saver-button-publish" class="elementor-button elementor-button-success elementor-saver-disabled">
					<span class="elementor-state-icon">
						<i class="eicon-loading eicon-animation-spin" aria-hidden="true"></i>
					</span>
                <span id="elementor-panel-saver-button-publish-label">
						<?php echo esc_html__('Publish', 'zipli'); ?>
					</span>
            </button>
        </div>
        <div id="elementor-panel-saver-save-options" class="elementor-panel-footer-tool">
            <button id="elementor-panel-saver-button-save-options" class="elementor-button elementor-button-success tooltip-target elementor-disabled" data-tooltip="<?php esc_attr_e('Save Options', 'zipli'); ?>">
                <i class="eicon-caret-up" aria-hidden="true"></i>
                <span class="elementor-screen-only"><?php echo esc_html__('Save Options', 'zipli'); ?></span>
            </button>
        </div>
    </script>

    <?php
}

add_action('wp_ajax_zipli_load_menu_data', 'zipli_megamenu_load_menu_data');
function zipli_megamenu_load_menu_data() {
    $nonce   = !empty($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    $menu_id = !empty($_POST['menu_id']) ? absint($_POST['menu_id']) : false;
    if (!wp_verify_nonce($nonce, 'zipli-menu-data-nonce') || !$menu_id) {
        wp_send_json(array(
            'message' => esc_html__('Access denied', 'zipli')
        ));
    }

    $data = zipli_megamenu_get_item_data($menu_id);

    $data = $data ? $data : array();
    if (isset($_POST['istop']) && absint($_POST['istop']) == 1) {
        if (class_exists('Elementor\Plugin')) {
            if (isset($data['enabled']) && $data['enabled']) {
                $related_id = zipli_megamenu_get_post_related_menu($menu_id);
                if (!$related_id) {
                    zipli_megamenu_create_related_post($menu_id);
                    $related_id = zipli_megamenu_get_post_related_menu($menu_id);
                }

                if ($related_id && isset($_REQUEST['menu_id']) && is_admin()) {
                    $url                      = Elementor\Plugin::instance()->documents->get($related_id)->get_edit_url();
                    $data['edit_submenu_url'] = add_query_arg(array('zipli-menu-editable' => 1), $url);
                }
            } else {
                $url                      = admin_url();
                $data['edit_submenu_url'] = add_query_arg(array('zipli-menu-createable' => 1, 'menu_id' => $menu_id), $url);
            }
        }
    }

    $results = apply_filters('zipli_menu_settings_data', array(
        'status' => true,
        'data'   => $data
    ));

    wp_send_json($results);

}

add_action('wp_ajax_zipli_update_menu_item_data', 'zipli_megamenu_update_menu_item_data');
function zipli_megamenu_update_menu_item_data() {
    $nonce = !empty($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'zipli-update-menu-item')) {
        wp_send_json(array(
            'message' => esc_html__('Access denied', 'zipli')
        ));
    }

    $settings = !empty($_POST['zipli-menu-item']) ? ($_POST['zipli-menu-item']) : array();
    $menu_id  = !empty($_POST['menu_id']) ? absint($_POST['menu_id']) : false;

    do_action('zipli_before_update_menu_settings', $settings);


    zipli_megamenu_update_item_data($menu_id, $settings);

    do_action('zipli_menu_settings_updated', $settings);
    wp_send_json(array('status' => true));
}

add_action('admin_footer', 'zipli_megamenu_underscore_template');
function zipli_megamenu_underscore_template() {
    global $pagenow;
    if ($pagenow === 'nav-menus.php') { ?>
        <script type="text/html" id="tpl-zipli-menu-item-modal">
            <div id="zipli-modal" class="zipli-modal">
                <div class="zipli-modal-overlay"></div>
                <div id="zipli-modal-body" class="<%= data.edit_submenu === true ? 'edit-menu-active' : ( data.is_loading ? 'loading' : '' ) %>">
                    <% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
                    <form id="menu-edit-form">
                        <% } %>
                        <div class="zipli-modal-content">
                            <% if ( data.edit_submenu === true ) { %>
                            <iframe src="<%= data.edit_submenu_url %>"/>
                            <% } else if ( data.is_loading === true ) { %>
                            <i class="fa fa-spin fa-spinner"></i>
                            <% } else { %>
                            <div class="form-group toggle-select-setting">
                                <label for="icon"><?php esc_html_e('Icon', 'zipli') ?></label>
                                <select id="icon" name="zipli-menu-item[icon]" class="form-control icon-picker zipli-input-switcher zipli-input-switcher-true" data-target=".icon-custom" data-target2=".icon-custom-image">
                                    <option value="" <%= data.icon == '' ? ' selected' : '' %>><?php echo esc_html__('No Use', 'zipli') ?></option>
                                    <option value="1" <%= data.icon == 1 ? ' selected' : '' %>><?php echo esc_html__('Custom Class', 'zipli') ?></option>
                                    <option value="2" <%= data.icon == 2 ? ' selected' : '' %>><?php echo esc_html__('Custom Image', 'zipli') ?></option>
                                    <?php foreach (zipli_megamenu_get_fontawesome_icons() as $value) : ?>
                                        <option value="<?php echo 'zipli-icon-' . esc_attr($value) ?>"<%= data.icon == '<?php echo 'zipli-icon-' . esc_attr($value) ?>' ? ' selected' : '' %>><?php echo esc_html($value) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group icon-custom-image toggle-select-setting elementor-hidden" style="display: flex;">
                                <label for="icon-custom-image"><?php esc_html_e('Icon Image', 'zipli') ?></label>
                                <input type="hidden" name="zipli-menu-item[icon_custom_image]" class="input" id="icon-custom-image"/>
                                <input type="hidden" name="zipli-menu-item[icon_custom_image_url]" class="input" id="icon-custom-image-url"/>
                                <div class="megamenu-icon-image-wrapper">
                                    <% if (data.icon_custom_image_url !== ''){%>
                                    <img src="<%= data.icon_custom_image_url %>" style="margin-right:10px;padding:0;max-height:32px;float:none;" alt="">
                                    <% } %>
                                </div>
                                <button id="edit-megamenu-image" class="edit-megamenu-image button button-primary button-large">
                                    <?php esc_html_e('Choose image', 'zipli') ?>
                                </button>
                                <button style="margin-left:10px" id="edit-megamenu-image-remove" class="edit-megamenu-image-remove button button-primary button-large">
                                    <?php esc_html_e('Remove image', 'zipli') ?>
                                </button>
                            </div>
                            <div class="form-group icon-custom toggle-select-setting elementor-hidden">
                                <label for="icon-custom"><?php esc_html_e('Icon Class Name', 'zipli') ?></label>
                                <input type="text" name="zipli-menu-item[icon-custom]" class="input" id="icon-custom"/>
                            </div>
                            <div class="form-group">
                                <label for="icon_color"><?php esc_html_e('Icon Color', 'zipli') ?></label>
                                <input class="color-picker" name="zipli-menu-item[icon_color]" value="<%= data.icon_color %>" id="icon_color"/>
                            </div>
                            <div class="form-group">
                                <label for="icon_size"><?php esc_html_e('Icon Size', 'zipli') ?></label>
                                <input type="text" name="zipli-menu-item[icon_size]" value="<%= data.icon_size %>" id="icon_size"/>
                                <span class="unit">px</span>
                            </div>
                            <div class="form-group">
                                <label for="color"><?php esc_html_e('Color', 'zipli') ?></label>
                                <input class="color-picker" name="zipli-menu-item[color]" value="<%= data.color %>" id="color"/>
                            </div>
                            <div class="form-group">
                                <label for="badge_title"><?php esc_html_e('Badges Title', 'zipli') ?></label>
                                <input class="form-control" name="zipli-menu-item[badge_title]" value="<%= data.badge_title %>" id="badge_title"/>
                            </div>
                            <div class="form-group">
                                <label for="badge_color"><?php esc_html_e('Badges Color', 'zipli') ?></label>
                                <input class="color-picker" name="zipli-menu-item[badge_color]" value="<%= data.badge_color %>" id="badge_color"/>
                            </div>
                            <div class="form-group">
                                <label for="badges_bg_color"><?php esc_html_e('Badges Bg Color', 'zipli') ?></label>
                                <input class="color-picker" name="zipli-menu-item[badges_bg_color]" value="<%= data.badges_bg_color %>" id="badges_bg_color"/>
                            </div>

                            <div class="form-group submenu-setting toggle-select-setting">
                                <label><?php esc_html_e('Mega Submenu Enabled', 'zipli') ?></label>
                                <select name="zipli-menu-item[enabled]" class="zipli-input-switcher zipli-input-switcher-true" data-target=".submenu-width-setting">
                                    <option value="1"
                                    <%= data.enabled == 1? 'selected':''
                                    %>> <?php esc_html_e('Yes', 'zipli') ?></opttion>
                                    <option value="0"
                                    <%= data.enabled == 0? 'selected':''
                                    %>><?php esc_html_e('No', 'zipli') ?></opttion>
                                </select>
                                <button id="edit-megamenu" class="button button-primary button-large">
                                    <?php esc_html_e('Edit Megamenu Submenu', 'zipli') ?>
                                </button>
                            </div>

                            <div class="form-group submenu-width-setting toggle-select-setting elementor-hidden">
                                <label><?php esc_html_e('Sub Megamenu Width', 'zipli') ?></label>
                                <select name="zipli-menu-item[customwidth]" class="zipli-input-switcher zipli-input-switcher-true" data-target=".submenu-subwidth-setting">
                                    <option value="1"
                                    <%= data.customwidth == 1? 'selected':''
                                    %>> <?php esc_html_e('Yes', 'zipli') ?></opttion>
                                    <option value="0"
                                    <%= data.customwidth == 0? 'selected':''
                                    %>><?php esc_html_e('Full Width', 'zipli') ?></opttion>
                                    <option value="2"
                                    <%= data.customwidth == 2? 'selected':''
                                    %>><?php esc_html_e('Stretch Width', 'zipli') ?></opttion>
                                    <option value="3"
                                    <%= data.customwidth == 3? 'selected':''
                                    %>><?php esc_html_e('Container Width', 'zipli') ?></opttion>
                                </select>
                            </div>

                            <div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting elementor-hidden">
                                <label for="menu_subwidth"><?php esc_html_e('Sub Mega Menu Max Width', 'zipli') ?></label>
                                <input type="text" name="zipli-menu-item[subwidth]" value="<%= data.subwidth?data.subwidth:'600' %>" class="input" id="menu_subwidth"/>
                                <span class="unit">px</span>
                            </div>

                            <div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting elementor-hidden">
                                <label><?php esc_html_e('Sub Mega Menu Position Left', 'zipli') ?></label>
                                <select name="zipli-menu-item[menuposition]">
                                    <option value="0"
                                    <%= data.menuposition == 0? 'selected':''
                                    %>><?php esc_html_e('No', 'zipli') ?></opttion>
                                    <option value="1"
                                    <%= data.menuposition == 1? 'selected':''
                                    %>> <?php esc_html_e('Yes', 'zipli') ?></opttion>
                                </select>
                            </div>

                            <% } %>
                        </div>
                        <% if ( data.is_loading !== true && data.edit_submenu !== true ) { %>
                        <div class="zipli-modal-footer">
                            <a href="#" class="close button"><%= zipli_memgamnu_params.i18n.close %></a>
                            <?php wp_nonce_field('zipli-update-menu-item', 'nonce') ?>
                            <input name="menu_id" value="<%= data.menu_id %>" type="hidden"/>
                            <button type="submit" class="button button-primary button-large menu-save pull-right"><%=
                                zipli_memgamnu_params.i18n.submit %>
                            </button>
                        </div>
                        <% } %>
                        <% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
                    </form>
                    <% } %>
                </div>
            </div>
        </script>
    <?php }
}







