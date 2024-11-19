<?php
get_header(); ?>
    <div id="primary" class="content">
        <main id="main" class="site-main">
            <div class="error-404 not-found">
                <div class="page-content">
                    <div class="error-content">
                        <img src="<?php echo get_theme_file_uri('assets/images/404-img.png'); ?>"
                             alt="<?php echo esc_attr__('404 Page', 'zipli'); ?>">
                        <h2 class="error-title"><?php esc_html_e('Oops! That page can’t be found.', 'zipli'); ?></h2>
                        <p class="error-text"><?php esc_html_e('The Page you are looking for doesn\'t exitst or an other error occured. Go to ', 'zipli'); ?>
                            <a href="javascript: history.go(-1)"
                               class="go-back"><?php esc_html_e('Home Page', 'zipli'); ?>
                            </a>
                        </p>
                    </div>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php

get_footer();
