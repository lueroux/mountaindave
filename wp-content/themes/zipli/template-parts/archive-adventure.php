<?php
global $wp_query;

get_header();

$options     = get_option('zipli_adventure_archive');
$col_desktop = 3;
$col_tablet  = 2;
$col_mobile  = 1;
$gutter      = 30;
$style       = 'style-1';

$post_total = $post_count = 0;
if ($wp_query->is_main_query()) {
    $post_total = $wp_query->found_posts;
    $post_count = $wp_query->post_count;
}

if ($options && is_array($options)) {
    $style       = isset($options['archive_style']) ? $options['archive_style'] : 'style-1';
    $col_desktop = isset($options['columns_desktop']) ? $options['columns_desktop'] : 3;
    $col_tablet  = isset($options['columns_tablet']) ? $options['columns_tablet'] : 2;
    $col_mobile  = isset($options['columns_mobile']) ? $options['columns_mobile'] : 1;
    $gutter      = isset($options['gutter']) ? $options['gutter'] : 30;
}
echo '<div class="adventure-archive-' . esc_attr($style) . '">'
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="adventure-archive-content">
                <h3 class="navigation-adventure-title omega">
                    <?php echo esc_html__('Activity Types', 'zipli'); ?>
                </h3>
                <div class="navigation-adventure">
                    <?php
                    $class = is_post_type_archive('zipli_adventure') ? 'active' : '';
                    ?>
                    <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_post_type_archive_link('zipli_adventure')); ?>"><?php echo esc_html__('All Types', 'zipli'); ?></a>
                    <?php
                    $taxonomy = 'zipli_adventure_cat';
                    $terms    = $terms = get_terms([
                        'taxonomy'   => 'zipli_adventure_cat',
                        'hide_empty' => false,
                    ]);
                    foreach ($terms as $term) {
                        $item_class = is_tax($taxonomy, $term->slug) ? 'active' : '';
                        ?>
                        <a class="<?php echo esc_attr($item_class); ?>" href="<?php echo esc_url(get_term_link($term->slug, $taxonomy)) ?>"><?php echo esc_html($term->name); ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="adventure-count">
                    <?php
                    if ($post_total != 0) {
                        ?>
                        <span><?php echo esc_html($post_count . ' ' . _n('activity listed of', 'activities listed of', $post_count, 'zipli') . ' ' . $post_total); ?></span>
                        <?php
                    } else {
                        ?>
                        <span><?php echo esc_html__('No activities found', 'zipli'); ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="archive-content-inner">
                    <?php
                    echo '<div style="--gutter-width: ' . esc_attr($gutter) . 'px;" class="d-grid grid-columns-desktop-' . esc_attr($col_desktop) . ' grid-columns-tablet-' . esc_attr($col_tablet) . ' grid-columns-' . esc_attr($col_mobile) . '">';
                    while (have_posts()) : the_post();
                        ?>
                        <div class="grid-item">
                            <?php get_template_part('template-parts/adventure/item-adventure', $style); ?>
                        </div>
                    <?php
                    endwhile;
                    echo '</div>';
                    zipli_paging_nav();
                    ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
echo '</div>';
get_footer();