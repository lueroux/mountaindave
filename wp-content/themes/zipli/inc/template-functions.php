<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!function_exists('zipli_display_comments')) {
    /**
     * Rocland display comments
     *
     * @since  1.0.0
     */
    function zipli_display_comments() {
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || 0 !== intval(get_comments_number())) :
            comments_template();
        endif;
    }
}

if (!function_exists('zipli_comment')) {
    /**
     * Rocland comment template
     *
     * @param array $comment the comment array.
     * @param array $args the comment args.
     * @param int $depth the comment depth.
     *
     * @since 1.0.0
     */
    function zipli_comment($comment, $args, $depth) {
        if ('div' === $args['style']) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo esc_attr($tag) . ' '; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">

        <div class="comment-body">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, 80); ?>
            </div>
            <?php if ('div' !== $args['style']) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
                <?php endif; ?>
                <div class="comment-head">
                    <div class="comment-meta commentmetadata">
                        <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
                        <?php if ('0' === $comment->comment_approved) : ?>
                            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'zipli'); ?></em>
                            <br/>
                        <?php endif; ?>

                        <a href="<?php echo esc_url(htmlspecialchars(get_comment_link($comment->comment_ID))); ?>"
                           class="comment-date">
                            <?php echo '<time datetime="' . get_comment_date('c') . '">' . get_comment_date() . '</time>'; ?>
                        </a>
                    </div>
                </div>
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
                <div class="reply">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args, array(
                                'add_below' => $add_below,
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                            )
                        )
                    );
                    ?>
                    <?php edit_comment_link(esc_html__('Edit', 'zipli'), '  ', ''); ?>
                </div>
                <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('zipli_credit')) {
    /**
     * Display the theme credit
     *
     * @return void
     * @since  1.0.0
     */
    function zipli_credit() {
        ?>
        <div class="site-info">
            <?php echo apply_filters('zipli_copyright_text', $content = '&copy; ' . date('Y') . ' ' . '<a class="site-url" href="' . esc_url(site_url()) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'zipli')); ?>
        </div><!-- .site-info -->
        <?php
    }
}

if (!function_exists('zipli_site_branding')) {
    /**
     * Site branding wrapper and display
     *
     * @return void
     * @since  1.0.0
     */
    function zipli_site_branding() {
        ?>
        <div class="site-branding">
            <?php echo zipli_site_title_or_logo(); ?>
        </div>
        <?php
    }
}

if (!function_exists('zipli_site_title_or_logo')) {
    /**
     * Display the site title or logo
     *
     * @param bool $echo Echo the string or return it.
     *
     * @return string
     * @since 2.1.0
     */
    function zipli_site_title_or_logo() {
        ob_start();
        the_custom_logo(); ?>
        <div class="site-branding-text">
            <?php if (is_front_page()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                          rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                         rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo('description', 'display');

            if ($description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->
        <?php
        $html = ob_get_clean();
        return $html;
    }
}

if (!function_exists('zipli_primary_navigation')) {
    /**
     * Display Primary Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function zipli_primary_navigation() {
        ?>
        <nav class="main-navigation" role="navigation"
             aria-label="<?php esc_attr_e('Primary Navigation', 'zipli'); ?>">
            <?php
            wp_nav_menu(apply_filters('zipli_nav_menu_args', [
                'fallback_cb'     => '__return_empty_string',
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            ]));
            ?>
        </nav>
        <?php
    }
}

if (!function_exists('zipli_mobile_navigation')) {
    /**
     * Display Handheld Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function zipli_mobile_navigation() {
        if (isset(get_nav_menu_locations()['handheld']) && isset(get_nav_menu_locations()['handheld_categories'])) {
            ?>
            <div class="mobile-nav-tabs">
                <ul>
                    <?php if (isset(get_nav_menu_locations()['handheld'])) { ?>
                        <li class="mobile-tab-title mobile-pages-title active" data-menu="pages">
                            <span><?php echo esc_html(get_term(get_nav_menu_locations()['handheld'], 'nav_menu')->name); ?></span>
                        </li>
                    <?php } ?>
                    <?php if (isset(get_nav_menu_locations()['handheld_categories'])) { ?>
                        <li class="mobile-tab-title mobile-categories-title" data-menu="categories">
                            <span><?php echo esc_html(get_term(get_nav_menu_locations()['handheld_categories'], 'nav_menu')->name); ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
        }
        ?>
        <nav class="mobile-menu-tab mobile-navigation mobile-pages-menu active"
             aria-label="<?php esc_attr_e('Mobile Navigation', 'zipli'); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'handheld',
                    'container_class' => 'handheld-navigation',
                )
            );
            ?>
        </nav>
        <?php
        if (isset(get_nav_menu_locations()['handheld_categories'])) {

            ?>
            <nav class="mobile-menu-tab mobile-navigation-categories mobile-categories-menu"
                 aria-label="<?php esc_attr_e('Mobile Navigation', 'zipli'); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'handheld_categories',
                        'container_class' => 'handheld-navigation',
                    )
                );
                ?>
            </nav>
            <?php
        }
    }
}

if (!function_exists('zipli_page_header')) {
    /**
     * Display the page header
     *
     * @since 1.0.0
     */
    function zipli_page_header() {

        if (is_front_page() || !is_page_template('default')) {
            return;
        }

        if (zipli_is_elementor_activated() && function_exists('hfe_init')) {
            if (Zipli_breadcrumb::get_template_id() !== '') {
                return;
            }
        }

        ?>
        <header class="entry-header">
            <?php
            if (has_post_thumbnail()) {
                zipli_post_thumbnail('full');
            }
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('zipli_page_content')) {
    /**
     * Display the post content
     *
     * @since 1.0.0
     */
    function zipli_page_content() {
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'zipli'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if (!function_exists('zipli_post_header')) {
    /**
     * Display the post header with a link to the single post
     *
     * @param string $size the post thumbnail size.
     *
     * @since 1.0.0
     * Display post thumbnail
     *
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @var $size . thumbnail|medium|large|full|$custom
     */
    function zipli_post_header($size = 'post-thumbnail') {
        ?>
        <header class="entry-header <?php echo has_post_thumbnail() ? esc_attr('header-post-thumbnail') : ''; ?>">

            <?php if (is_single()) { ?>
                <div class="entry-meta">
                    <?php zipli_post_meta(['show_author' => true, 'show_cat' => true, 'show_date' => true, 'show_comment' => false]); ?>
                </div>
                <?php
                the_title('<h1 class="beta entry-title">', '</h1>');
            } ?>
            <?php if (!is_single()) { ?>
                <div class="entry-meta">
                    <?php zipli_post_meta(['show_author' => true, 'show_cat' => true, 'show_date' => true, 'show_comment' => false]); ?>
                </div>
                <?php
                the_title('<h3 class="gamma entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
            } ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('zipli_post_content')) {
    /**
     * Display the post content with a link to the single post
     *
     * @since 1.0.0
     */
    function zipli_post_content() {
        ?>
        <div class="entry-content">
            <?php

            /**
             * Functions hooked in to zipli_post_content_before action.
             *
             */
            do_action('zipli_post_content_before');


            if (is_single()) {
                the_content(
                    sprintf(
                    /* translators: %s: post title */
                        esc_html__('Read More', 'zipli') . ' %s',
                        '<span class="screen-reader-text">' . get_the_title() . '</span>'
                    )
                );
            } else { ?>
                <div class="entry-info">
                    <div class="entry-excerpt"> <?php the_excerpt(); ?></div>
                </div>
                <?php
            }

            /**
             * Functions hooked in to zipli_post_content_after action.
             *
             */
            do_action('zipli_post_content_after');

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'zipli'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}


if (!function_exists('zipli_post_meta')) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function zipli_post_meta($atts = array()) {
        global $post;
        if ('post' !== get_post_type()) {
            return;
        }

        extract(
            shortcode_atts(
                array(
                    'show_date'    => true,
                    'show_cat'     => true,
                    'show_author'  => false,
                    'show_comment' => true,
                ),
                $atts
            )
        );
        $author = '';
        // Author.
        if ($show_author == 1) {
            $author_id = $post->post_author;
            $author    = sprintf(
                '<div class="post-author"><span class="text-author">%1$s</span><a href="%2$s" class="url fn" rel="author">%3$s</a></div>',
                esc_html__('', 'zipli'),
                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                esc_html(get_the_author_meta('display_name', $author_id))
            );
        }

        $posted_on = '';
        // Posted on.
        if ($show_date) {

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf(
                $time_string,
                esc_attr(get_the_date('c')),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date('c')),
                esc_html(get_the_modified_date())
            );

            $posted_on = '<div class="posted-on">' . sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string) . '</div>';
        }

        $categories_list = get_the_category_list(', ');
        $categories      = '';
        if ($show_cat && $categories_list) {
            // Make sure there's more than one category before displaying.
            $categories = '<div class="categories-link"><span class="screen-reader-text">' . esc_html__('Categories', 'zipli') . '</span>' . $categories_list . '</div>';
        }


        echo wp_kses(
            sprintf('%1$s %2$s %3$s', $categories, $posted_on, $author), array(
                'div'  => array(
                    'class' => array(),
                ),
                'span' => array(
                    'class' => array(),
                ),
                'i'    => array(
                    'class' => array(),
                ),
                'a'    => array(
                    'href'  => array(),
                    'rel'   => array(),
                    'class' => array(),
                ),
                'time' => array(
                    'datetime' => array(),
                    'class'    => array(),
                )
            )
        );

        if ($show_comment) { ?>
            <div class="meta-reply">
                <?php
                comments_popup_link(esc_html__('Comment (0)', 'zipli'), esc_html__('comment (1)', 'zipli'), esc_html__('Comments (%)', 'zipli'));
                ?>
            </div>
            <?php
        }

    }
}

if (!function_exists('zipli_get_allowed_html')) {
    function zipli_get_allowed_html() {
        return apply_filters(
            'zipli_allowed_html',
            array(
                'br'     => array(),
                'i'      => array(),
                'b'      => array(),
                'u'      => array(),
                'em'     => array(),
                'del'    => array(),
                'a'      => array(
                    'href'  => true,
                    'class' => true,
                    'title' => true,
                    'rel'   => true,
                ),
                'strong' => array(),
                'span'   => array(
                    'style' => true,
                    'class' => true,
                ),
            )
        );
    }
}

if (!function_exists('zipli_post_taxonomy')) {
    /**
     * Display the post taxonomies
     *
     * @since 2.4.0
     */
    function zipli_post_taxonomy() {
        /* translators: used between list items, there is a space after the comma */

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', '');
        ?>
        <aside class="entry-taxonomy">
            <?php if ($tags_list) : ?>
                <div class="tags-links">
                    <span class="screen-reader-text"><?php echo esc_html(_n('Tag:', 'Tags:', count(get_the_tags()), 'zipli')); ?></span>
                    <?php printf('%s', $tags_list); ?>
                </div>
            <?php endif;
            zipli_social_share();
            ?>
        </aside>
        <?php
    }
}

if (!function_exists('zipli_paging_nav')) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function zipli_paging_nav() {

        $args = array(
            'type'      => 'list',
            'prev_text' => esc_html__('', 'zipli'),
            'next_text' => esc_html__('', 'zipli'),
        );
        the_posts_pagination($args);
    }
}

if (!function_exists('zipli_post_nav')) {
    /**
     * Display navigation to next/previous post when applicable.
     */
    function zipli_post_nav() {
        $prev_post      = get_previous_post();
        $next_post      = get_next_post();
        $args           = [];
        $thumbnail_prev = '';
        $thumbnail_next = '';

        if ($prev_post) {
            $thumbnail_prev = get_the_post_thumbnail($prev_post->ID, array(100, 100));
        };

        if ($next_post) {
            $thumbnail_next = get_the_post_thumbnail($next_post->ID, array(100, 100));
        };
        if ($next_post) {
            $args['next_text'] = '<span class="nav-content"><span class="reader-text">' . esc_html__('Next', 'zipli') . '</span><span class="title">%title</span></span> ' . $thumbnail_next;
        }
        if ($prev_post) {
            $args['prev_text'] = $thumbnail_prev . '<span class="nav-content"><span class="reader-text">' . esc_html__('Prev', 'zipli') . ' </span><span class="title">%title</span></span> ';
        }

        the_post_navigation($args);

    }
}

if (!function_exists('zipli_get_sidebar')) {
    /**
     * Display zipli sidebar
     *
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function zipli_get_sidebar() {
        get_sidebar();
    }
}

if (!function_exists('zipli_post_thumbnail')) {
    /**
     * Display post thumbnail
     *
     * @param string $size the post thumbnail size.
     *
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @var $size . thumbnail|medium|large|full|$custom
     * @since 1.5.0
     */
    function zipli_post_thumbnail($size = 'post-thumbnail') {
        if (has_post_thumbnail()) {
            echo '<div class="post-thumbnail">';
            the_post_thumbnail($size ? $size : 'post-thumbnail');
            echo '</div>';
        }
    }
}


if (!function_exists('zipli_header_account')) {
    function zipli_header_account() {

        if (!zipli_get_theme_option('show_header_account', true)) {
            return;
        }

        $account_link = wp_login_url();

        ?>
        <div class="site-header-account">
            <a href="<?php echo esc_url($account_link); ?>">
                <i class="zipli-icon-user"></i>
                <span class="account-content">
                    <?php
                    if (!is_user_logged_in()) {
                        esc_attr_e('Login / Register', 'zipli');
                    } else {
                        $user = wp_get_current_user();
                        echo esc_html($user->display_name);
                    }

                    ?>
                </span>
            </a>
            <div class="account-dropdown">

            </div>
        </div>
        <?php
    }

}

if (!function_exists('zipli_template_account_dropdown')) {
    function zipli_template_account_dropdown() {
        if (!zipli_get_theme_option('show_header_account', true)) {
            return;
        }
        ?>
        <div class="account-wrap d-none">
            <div class="account-inner <?php if (is_user_logged_in()): echo "dashboard"; endif; ?>">
                <?php if (!is_user_logged_in()) {
                    zipli_form_login();
                } else {
                    zipli_account_dropdown();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('zipli_form_login')) {
    function zipli_form_login() {

        $register_link = wp_registration_url();
        ?>
        <div class="login-form-head">
            <span class="login-form-title"><?php esc_html_e('Sign in', 'zipli') ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url($register_link); ?>"
                   title="<?php esc_attr_e('Register', 'zipli'); ?>"><?php esc_html_e('Create an Account', 'zipli'); ?></a>
            </span>
        </div>
        <form class="zipli-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_html_e('Username or email', 'zipli'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'zipli') ?>">
            </p>
            <p>
                <label><?php esc_html_e('Password', 'zipli'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required
                       placeholder="<?php esc_attr_e('Password', 'zipli') ?>">
            </p>
            <button type="submit" data-button-action
                    class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'zipli') ?></button>
            <input type="hidden" name="action" value="zipli_login">
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="lostpass-link"
               title="<?php esc_attr_e('Lost your password?', 'zipli'); ?>"><?php esc_html_e('Lost your password?', 'zipli'); ?></a>
        </div>
        <?php
    }
}

if (!function_exists('zipli_account_dropdown')) {
    function zipli_account_dropdown() { ?>
        <?php if (has_nav_menu('my-account')) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Dashboard', 'zipli'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'my-account',
                    'menu_class'     => 'account-links-menu',
                    'depth'          => 1,
                ));
                ?>
            </nav><!-- .social-navigation -->
        <?php else: ?>
            <ul class="account-dashboard">
                <li>
                    <a href="<?php echo esc_url(get_dashboard_url(get_current_user_id())); ?>"
                       title="<?php esc_attr_e('Dashboard', 'zipli'); ?>"><?php esc_html_e('Dashboard', 'zipli'); ?></a>
                </li>
                <li>
                    <a title="<?php esc_attr_e('Log out', 'zipli'); ?>" class="tips"
                       href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'zipli'); ?></a>
                </li>
            </ul>
        <?php endif;

    }
}

if (!function_exists('zipli_header_search_popup')) {
    function zipli_header_search_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <div class="site-search widget_search">
                    <?php get_search_form(); ?>
                </div>
                <a href="#" class="site-search-popup-close">
                    <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" width="23.691" height="22.723" viewBox="0 0 23.691 22.723">
                        <g transform="translate(-126.154 -143.139)">
                            <line x2="23" y2="22" transform="translate(126.5 143.5)" fill="none" stroke="CurrentColor" stroke-width="1"></line>
                            <path d="M0,22,23,0" transform="translate(126.5 143.5)" fill="none" stroke="CurrentColor" stroke-width="1"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>

        <?php
    }
}

if (!function_exists('zipli_header_search_button')) {
    function zipli_header_search_button() {
        add_action('wp_footer', 'zipli_header_search_popup', 1);
        ?>
        <div class="site-header-search">
            <a href="#" class="button-search-popup"><i class="zipli-icon-search"></i></a>
        </div>
        <?php
    }
}

if (!function_exists('zipli_mobile_nav')) {
    function zipli_mobile_nav() {
        if (isset(get_nav_menu_locations()['handheld'])) {
            ?>
            <div class="zipli-mobile-nav">
                <div class="menu-scroll-mobile">
                    <?php
                    zipli_site_branding();
                    ?>
                    <a href="#" class="mobile-nav-close"><i class="zipli-icon-times"></i></a>
                    <?php
                    zipli_mobile_navigation();
                    ?>
                </div>
            </div>
            <div class="zipli-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('zipli_mobile_nav_button')) {
    function zipli_mobile_nav_button() {
        if (isset(get_nav_menu_locations()['handheld'])) {
            ?>
            <a href="#" class="menu-mobile-nav-button">
				<span
                        class="toggle-text screen-reader-text"><?php echo esc_html(apply_filters('zipli_menu_toggle_text', esc_html__('Menu', 'zipli'))); ?></span>
                <div class="zipli-icon">
                    <span class="icon-1"></span>
                    <span class="icon-2"></span>
                    <span class="icon-3"></span>
                </div>
            </a>
            <?php
        }
    }
}

if (!function_exists('zipli_language_switcher')) {
    function zipli_language_switcher() {
        $languages = apply_filters('wpml_active_languages', []);
        if (zipli_is_wpml_activated() && count($languages) > 0) {
            ?>
            <div class="zipli-language-switcher">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <span class="title"><?php echo esc_html($languages[ICL_LANGUAGE_CODE]['translated_name']); ?></span>
                            <i class="zipli-icon-angle-down"></i>
                        </div>

                        <ul class="sub-item">
                            <?php
                            foreach ($languages as $key => $language) {
                                if (ICL_LANGUAGE_CODE === $key) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($language['url']) ?>">
                                        <img width="18" height="12" src="<?php echo esc_url($language['country_flag_url']) ?>" alt="<?php esc_attr($language['default_locale']) ?>">
                                        <span><?php echo esc_html($language['translated_name']); ?></span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }

    }
}


if (!function_exists('zipli_footer_default')) {
    function zipli_footer_default() {
        get_template_part('template-parts/copyright');
    }
}

if (!function_exists('zipli_social_share')) {
    function zipli_social_share() {
        get_template_part('template-parts/socials');
    }
}

if (!function_exists('zipli_pingback_header')) {
    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function zipli_pingback_header() {
        if (is_singular() && pings_open()) {
            echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
        }
    }
}


if (!function_exists('zipli_update_comment_fields')) {
    function zipli_update_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req       = get_option('require_name_email');
        $aria_req  = $req ? "aria-required='true'" : '';

        $fields['author']
            = '<p class="comment-form-author">
			<input id="author" name="author" type="text" placeholder="' . esc_attr__('Name *', 'zipli') . '" value="' . esc_attr($commenter['comment_author']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['email']
            = '<p class="comment-form-email">
			<input id="email" name="email" type="email" placeholder="' . esc_attr__('Email *', 'zipli') . '" value="' . esc_attr($commenter['comment_author_email']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['url']
            = '<p class="comment-form-url">
			<input id="url" name="url" type="url" placeholder="' . esc_attr__('Website', 'zipli') . '" value="' . esc_attr($commenter['comment_author_url']) .
              '" size="30" />
			</p>';

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'zipli_update_comment_fields');


if (!function_exists('zipli_comment_form_defaults')) {
    function zipli_comment_form_defaults($defaults) {

        $html5              = 'html5' == current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
        $required_attribute = ($html5 ? ' required' : ' required="required"');

        $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr__('Comment *', 'zipli') . '"cols="45" rows="5" maxlength="65525"' . $required_attribute . '></textarea></p>';
        $defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s"><span>%4$s</span><i class="zipli-icon-arrow-right"></i> </button>';
        return $defaults;
    }
}

add_filter('comment_form_defaults', 'zipli_comment_form_defaults');

function zipli_replace_categories_list($output, $args) {
    if ($args['show_count'] = 1) {
        $pattern     = '#<li([^>]*)><a([^>]*)>(.*?)<\/a>\s*\(([0-9]*)\)\s*#i';  // removed ( and )
        $replacement = '<li$1><a$2><span class="cat-name">$3</span> <span class="cat-count">($4)</span></a>';
        return preg_replace($pattern, $replacement, $output);
    }
    return $output;
}

add_filter('wp_list_categories', 'zipli_replace_categories_list', 10, 2);

function zipli_replace_archive_list($link_html, $url, $text, $format, $before, $after, $selected) {
    if ($format == 'html') {
        $pattern     = '#<li><a([^>]*)>(.*?)<\/a>&nbsp;\s*\(([0-9]*)\)\s*#i';  // removed ( and )
        $replacement = '<li><a$1><span class="archive-name">$2</span> <span class="archive-count">($3)</span></a>';
        return preg_replace($pattern, $replacement, $link_html);
    }
    return $link_html;
}

add_filter('get_archives_link', 'zipli_replace_archive_list', 10, 7);


add_filter('bcn_breadcrumb_title', 'zipli_breadcrumb_title_swapper', 3, 10);
function zipli_breadcrumb_title_swapper($title, $type, $id) {
    if (in_array('home', $type)) {
        $title = esc_html__('Home', 'zipli');
    }
    return $title;
}

if (!function_exists('render_html_back_to_top')) {
    function render_html_back_to_top() {
        $enable = zipli_get_theme_option('enable_backtop', '');
        if ($enable) {
            echo <<<HTML
        <div class="progress-wrap">
          <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
          </svg>
          <span class="icon-arrow">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m17.1 18.9 5.9-6.4L17.1 6m5.9 6.4H0" stroke="currentColor" stroke-width="2"></path></svg>
          </span>
        </div>
HTML;
        }
    }
}

if (!function_exists('zipli_class_meta')) {
    function zipli_class_meta() {
        ?>
        <div class="class-meta">
            <?php
            $level = get_post_meta(get_the_ID(), 'zipli_class_level', true);
            if ($level && !empty($level)) {
                ?>
                <div class="meta-item">
                    <div class="meta-label"><?php esc_html_e('Level', 'zipli'); ?></div>
                    <div class="meta-value"><?php echo esc_html($level); ?></div>
                </div>
                <?php
            }
            $duration = get_post_meta(get_the_ID(), 'zipli_class_duration', true);
            if ($duration && !empty($duration)) {
                ?>
                <div class="meta-item">
                    <div class="meta-label"><?php esc_html_e('Duration', 'zipli'); ?></div>
                    <div class="meta-value"><?php echo esc_html($duration); ?></div>
                </div>
                <?php
            }
            $session = get_post_meta(get_the_ID(), 'zipli_class_session', true);
            if ($session && !empty($session)) {
                ?>
                <div class="meta-item">
                    <div class="meta-label"><?php esc_html_e('Session', 'zipli'); ?></div>
                    <div class="meta-value"><?php echo esc_html($session); ?></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

