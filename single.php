<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage starter
 * @since starter 2.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post(); ?>

<div class="content_wrapper bg-white single_post_page pt-md-5 pb-5" role="main">

	<div class="entry-content wrap_single_post_content">

		<div class="entry-header alignwide bg-white py-4 py-lg-5 px-lg-0">
			<?php get_template_part('meta-category'); ?>
			<?php the_title( '<h1 class="entry-title ">', '</h1>' ); ?>			
			<!-- <*?php the_title( '<h1 class="entry-title has-secondary-font-family fst-italic fw-bold text-uppercase">', '</h1>' ); ?>			 -->
			<p class='has-medium-font-size fw-medium text-center has-gray-color'>
				<?php echo get_the_excerpt(); ?>
			</p>				
		</div>

		

		<!-- post image -->
		<picture>
			<?php
				echo wp_kses(
					starter_img_func(
						array(
							'img_src'   => 'w800',
							'img_sizes' => '(max-width: 767px) calc(100vw - 24px), 776px',
							'img_id'    => get_post_thumbnail_id(),
						)
					),
					wp_kses_allowed_html( 'post' )
				);
			?>
		</picture>
		<!-- END post image -->

		<!-- post content -->
			<?php the_content(); ?>
		<!-- END post content -->

		<!-- post navigation -->
		<?php
			$starter_next = starter_get_svg( array( 'icon' => 'bi-chevron-right' ) );
			$starter_prev = starter_get_svg( array( 'icon' => 'bi-chevron-left' ) );

			$starter_next_label     = esc_html__( 'Next post', 'starter' );
			$starter_previous_label = esc_html__( 'Previous post', 'starter' );

			the_post_navigation(
				array(
					'next_text' => '<p class="meta-nav">' . $starter_next_label . $starter_next . '</p><p class="post-title">%title</p>',
					'prev_text' => '<p class="meta-nav">' . $starter_prev . $starter_previous_label . '</p><p class="post-title">%title</p>',
				)
			);
		?>
		<!-- END post navigation -->

	</div><!-- .entry-content -->

	<?php
	// If comments are open load up the comment template.
	if ( comments_open() ) {
		require get_stylesheet_directory() . '/templates/comment/comment-section.php';
	}
	?>

</div><!-- .content_wrapper -->

<?php endwhile; ?>

<?php
get_footer();
