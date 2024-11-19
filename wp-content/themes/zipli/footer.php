
		</div><!-- .col-fluid -->
	</div><!-- #content -->

	<?php do_action( 'zipli_before_footer' );
    if (zipli_is_elementor_activated() && function_exists('hfe_init') && (hfe_footer_enabled() || hfe_is_before_footer_enabled())) {
        do_action('hfe_footer_before');
        do_action('hfe_footer');
    } else {
        ?>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <?php
            /**
             * Functions hooked in to zipli_footer action
             *
             * @see zipli_footer_default - 20
             *
             *
             */
            do_action('zipli_footer');

            ?>

        </footer><!-- #colophon -->

        <?php
    }

		/**
		 * Functions hooked in to zipli_after_footer action
		 *
		 */
		do_action( 'zipli_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see zipli_template_account_dropdown 	- 1
 * @see zipli_mobile_nav - 1
 * @see render_html_back_to_top - 10
 */

wp_footer();
?>
</body>
</html>
