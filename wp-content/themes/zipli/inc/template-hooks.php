<?php
/**
 * =================================================
 * Hook zipli_page
 * =================================================
 */
add_action('zipli_page', 'zipli_page_header', 10);
add_action('zipli_page', 'zipli_page_content', 20);

/**
 * =================================================
 * Hook zipli_single_post_top
 * =================================================
 */
add_action('zipli_single_post_top', 'zipli_post_header', 10);

/**
 * =================================================
 * Hook zipli_single_post
 * =================================================
 */
add_action('zipli_single_post', 'zipli_post_content', 30);

/**
 * =================================================
 * Hook zipli_single_post_bottom
 * =================================================
 */
add_action('zipli_single_post_bottom', 'zipli_post_taxonomy', 5);
add_action('zipli_single_post_bottom', 'zipli_post_nav', 15);
add_action('zipli_single_post_bottom', 'zipli_display_comments', 20);

/**
 * =================================================
 * Hook zipli_loop_post
 * =================================================
 */
add_action('zipli_loop_post', 'zipli_post_header', 15);
add_action('zipli_loop_post', 'zipli_post_content', 30);

/**
 * =================================================
 * Hook zipli_footer
 * =================================================
 */
add_action('zipli_footer', 'zipli_footer_default', 20);

/**
 * =================================================
 * Hook zipli_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'zipli_template_account_dropdown', 1);
add_action('wp_footer', 'zipli_mobile_nav', 1);
add_action('wp_footer', 'render_html_back_to_top', 10);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'zipli_pingback_header', 1);

/**
 * =================================================
 * Hook zipli_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook zipli_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook zipli_content_top
 * =================================================
 */

/**
 * =================================================
 * Hook zipli_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook zipli_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook zipli_sidebar
 * =================================================
 */
add_action('zipli_sidebar', 'zipli_get_sidebar', 10);

/**
 * =================================================
 * Hook zipli_loop_after
 * =================================================
 */
add_action('zipli_loop_after', 'zipli_paging_nav', 10);

/**
 * =================================================
 * Hook zipli_page_after
 * =================================================
 */
add_action('zipli_page_after', 'zipli_display_comments', 10);
