<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <div class="single-content">
        <?php
            zipli_post_thumbnail('zipli-post-grid', true);
        ?>
        <div class="post-single-content">
        <?php
        /**
         * Functions hooked in to zipli_single_post_top action
         *
         *
         * @see zipli_post_header         - 10
         */
        do_action('zipli_single_post_top');

        /**
         * Functions hooked in to zipli_single_post action
         * @see zipli_post_content        - 30
         */
        do_action('zipli_single_post');

        /**
         * Functions hooked in to zipli_single_post_bottom action
         *
         * @see zipli_post_taxonomy      - 5
         * @see zipli_post_nav            - 15
         * @see zipli_display_comments    - 20
         */
        do_action('zipli_single_post_bottom');
        ?>

        </div>
    </div>

</article><!-- #post-## -->
