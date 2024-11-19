<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to zipli_page action
	 *
	 * @see zipli_page_header          - 10
	 * @see zipli_page_content         - 20
	 *
	 */
	do_action( 'zipli_page' );
	?>
</article><!-- #post-## -->
