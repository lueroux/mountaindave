<?php

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            while ( have_posts() ) :
                the_post();

                the_content();

            endwhile; // End of the loop.

            $args = ['taxonomy' => 'zipli_project_cat'];
            $args['next_text'] = '<span class="nav-content"><span>'.esc_html__('Next Project','zipli').'</span><i class="zipli-icon-arrow-right"></i></span>';
            $args['prev_text'] = '<span class="nav-content"><i class="zipli-icon-arrow-left"></i><span>'.esc_html__('Previous Project','zipli').'</span></span> ';
            the_post_navigation($args);
            ?>
            
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
