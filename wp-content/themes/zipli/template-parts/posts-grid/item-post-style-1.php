<div class="post-inner blog-grid">
    <?php
    zipli_post_thumbnail('zipli-post-grid', true);
    ?>
    <div class="post-content">
        <div class="entry-header">
            <div class="entry-meta">
                <?php zipli_post_meta(['show_cat' => true, 'show_date' => true, 'show_author' => false, 'show_comment' => false]); ?>
            </div>
            <?php the_title('<h3 class="omega entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
        </div>
    </div>
</div>