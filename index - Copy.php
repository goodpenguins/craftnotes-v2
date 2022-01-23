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


<div class="content_wrapper pt-5 pb-5 js_wrap_post_archive" role="main">

	<div class="entry-content">

	<?php
	if ( !is_front_page() ) {
		the_archive_title( '<h1 class="alignnone text-center fw-bold fst-italic mb-3">', '</h1>' ); }
	?>
	<?php
	if ( $cat_desc = category_description() )
		echo '<div class="alignnone has-medium-font-size fw-medium text-center px-5">'. $cat_desc .'</div>';
	?>

	<div class="alignwide Posts mt-5 wrap_posts">
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				?>
				<article class="">
					<a class="card" href="<?php echo esc_url( get_permalink() ); ?>">
						<picture class="item_img">
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
						<div class="card-body">
							<h2 class="card-text h5"><?php the_title(); ?></h2>
						</div>
					</a>
				</article>

			<?php endwhile; ?>
	</div>

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
