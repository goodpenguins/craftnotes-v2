<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage starter
 * @since starter 1.0
 */

get_header();
$attributes = [
	'dataset' => '',
	'format' => '',
	'perRow' => 3,
];
?>

<style>
.Posts {
	display: grid;
	grid-template-columns: repeat(<?=$attributes['perRow']?>, 1fr);
	gap: 1rem;
}
@media (max-width: 576px) {
	.Posts {
		grid-template-columns: repeat(2, 1fr);
	}
}    
</style>


<div class="content_wrapper py-2 py-lg-5 js_wrap_post_archive" role="main">

	<div class="entry-content">

		<!-- breadcrumb -->
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div class="alignwide yoast_breadcrumb">', '</div>' );
		}
		?>
		<!-- END breadcrumb -->

		<div class="entry-header alignwide bg-white py-4 py-lg-5 px-lg-0">
			<?php
			if ( !is_front_page() ) {
				the_archive_title( '<h1 class="text-center fw-bold fst-italic has-secondary-font-family mb-3">', '</h1>' ); }
			?>
			<?php
			if ( $cat_desc = category_description() )
				echo '<div class="has-medium-font-size fw-medium text-center">'. $cat_desc .'</div>';
			?>
		</div>

		<div class="wp-block-query alignwide is-style-framed-items mt-5 wrap_posts">
			<ul class="wp-block-post-template columns-<?=$attributes['perRow']?>">
			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();
					?>
					<li class="wp-block-post post type-post status-publish format-standard has-post-thumbnail hentry">
						<a class="" href="<?php echo esc_url( get_permalink() ); ?>">
							<figure class="alignwide wp-block-post-featured-image">
								<picture class="">
									<?php
										echo wp_kses(
											starter_img_func(
												array(
													'img_src'   => 'w600',
													'img_sizes' => '(max-width: 575px) calc(100vw - 26px), (max-width: 767px) 244px, (max-width: 991px) 334px, (max-width: 1199px) 294px, (max-width: 1399px) 354px, 414px',
													'img_id'    => get_post_thumbnail_id(),
												)
											),
											wp_kses_allowed_html( 'post' )
										);
									?>
								</picture>
							</figure>
						</a>
						<a class="" href="<?php echo esc_url( get_permalink() ); ?>">
							<h2 class="has-text-align-center has-text-color has-red-color wp-block-post-title has-arvo-font-family"><?php the_title(); ?></h2>
						</a>
						<div class="has-text-align-center wp-block-post-excerpt has-medium-font-size">
							<?php the_excerpt(); ?>
						</div>
					</li>

				<?php endwhile; ?>
		
			</ul> <!-- .wp-block-post-template -->
		</div> <!-- .wp-block-query -->

			<?php
			the_posts_pagination(
				array(
					'class'              => 'js_ajax_pagination',
					'type'               => 'list',
					'prev_text'          => starter_get_svg( array( 'icon' => 'bi-chevron-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'starter' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'starter' ) . '</span>' . starter_get_svg( array( 'icon' => 'bi-chevron-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'starter' ) . ' </span>',
				)
			);
		endif;
		?>

	</div><!-- .entry-content -->

</div><!-- .content_wrapper -->

<?php
get_footer();
