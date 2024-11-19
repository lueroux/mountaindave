<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="post-inner">
        <?php
        zipli_post_thumbnail('post-thumbnail', true);
        ?>
        <div class="post-content">
            <?php
            /**
             * Functions hooked in to zipli_loop_post action.
             *
             * @see zipli_post_header          - 15
             * @see zipli_post_content         - 30
             */
            do_action('zipli_loop_post');
            ?>
        </div>
    </div>
</article><!-- #post-## -->