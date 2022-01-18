<?php
/**
 * Template Name: Landing
 *
 * @package starter
 */

get_header();
?>


<div id="content" class="content_wrapper py-0" role="main">
	<!-- <div class="container service_page"> -->
	<div class="entry-content mt-0">

		<?php
		while ( have_posts() ) {
			the_post();
			the_content();
			// the_title( '<h1 class="entry-title text-center">', '</h1>' );
		}
		?>
	</div>
</div><!-- .content_wrapper -->


<?php
get_footer();
