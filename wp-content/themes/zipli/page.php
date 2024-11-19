<?php

get_header(); ?>

	<div id="primary">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'zipli_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to zipli_page_after action
				 *
				 * @see zipli_display_comments - 10
				 */
				do_action( 'zipli_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
