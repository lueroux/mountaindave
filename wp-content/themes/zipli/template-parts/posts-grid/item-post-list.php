<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="post-inner blog-list">
        <?php zipli_post_thumbnail('zipli-post-grid', true); ?>
        <div class="post-content">
            <div class="entry-header">
                <div class="entry-meta">
                    <?php zipli_post_meta(['show_cat' => true, 'show_date' => false, 'show_author' => false, 'show_comment' => false]); ?>
                </div>
                <?php
                the_title('<h3 class="delta entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->