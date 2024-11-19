<div class="post-inner blog-grid blog-grid2">
    <div class="post-content">
        <div class="entry-meta">
            <?php zipli_post_meta(['show_cat' => true, 'show_date' => true, 'show_author' => false, 'show_comment' => false]); ?>
        </div>
        <?php
        the_title('<h5 class="omega entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h5>');
        ?>
    </div>
    <?php zipli_post_thumbnail('zipli-post-grid', true); ?>
</div>