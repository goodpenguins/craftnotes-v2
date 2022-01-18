<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
global $wp_query;
$starter_all_count_item = $wp_query->found_posts;
$attributes = [
	'dataset' => '',
	'format' => '',
	'perRow' => 3,
];
?>

<style>
.Orderby 		{grid-area: Orderby; justify-self: end;}
.Filters 		{grid-area: Filters}
.Posts 			{grid-area: Posts}
.Pagination {grid-area: Pagination}
.Layout {
	display: grid;
  grid: [row1-start] ". Orderby" [row1-end]
				[row2-start] "Filters Posts" [row2-end]
				[row3-start] "Pagination Pagination" [row3-end]
  			/ 1fr 4fr;
	gap: 1rem;
}
.Posts {
	display: grid;
	grid-template-columns: repeat(<?=$attributes['perRow']?>, 1fr);
	gap: 1rem;
}
@media (max-width: 576px) {
	.Orderby {justify-self: start}
	.Filters {justify-self: end}
	.Orderby, .Filters {
		display: flex;
		width: 100%;
		padding: .5rem .5rem;
		border: 1px solid var(--wp--preset--color--silver);
		border-width: 1px 0 1px 0;
		margin: .5rem 0;
	}
	.Layout {
		grid: [row1-start] "Orderby Filters" auto [row1-end]
					[row2-start] "Posts Posts" auto [row2-end] 
					[row3-start] "Pagination Pagination" auto [row3-end] 
					/ 1fr;
		gap: 0;
	}
	.Posts {
		grid-template-columns: repeat(2, 1fr);
	}
}    
</style>


<?php
/*filters - get canonical URL*/
global $wp;
if ( '' === get_option( 'permalink_structure' ) ) {
	$starter_archive_url = remove_query_arg( array( 'page', 'paged', 'product-page' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
} else {
	$starter_archive_url = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
}
?>
<input class="js_archive_url" type="hidden" value="<?php echo esc_url( $starter_archive_url ); ?>">
<!-- filters - get canonical URL -->

<div id="content"
class="content_wrapper archive_product js_wrap_archive" 
role="main">

<div class="entry-content">

	<!-- breadcrumb -->
	<?php
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="yoast_breadcrumb">', '</div>' );
	}
	?>
	<!-- END breadcrumb -->

	<h1 class="mb-0 text-center">
		<?php
		if ( is_product_taxonomy() ) {
			woocommerce_page_title();
		} elseif ( is_search() ) {
			printf( 'Search Results for: “%s”', '<span>' . get_search_query() . '</span>' );
		} else {
			esc_html_e( 'All products', 'starter' );
		}
		?>
	</h1>
	<h2 class="mb-5 text-center text-muted"><small>(<?php echo esc_html( $starter_all_count_item ); ?><?php esc_html_e( ' products', 'starter' ); ?>)</small></h2>

	<div class="Layout alignwide">

		<!-- filters layout -->

			<div class="Orderby filter_block">
				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<span class="widget-title border-0"><?php esc_html_e( 'Sort by', 'starter' ); ?></span>
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
				<?php else : /*for a case when no results*/ ?>
					<form class="woocommerce-ordering">
						<input type="hidden" name="noresults" value="1">
					</form>
				<?php endif; ?>
			</div>
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="Filters filter_block all_filters offcanvas offcanvas-start" id="filtersSection" aria-labelledby="filtersSectionLabel">
					<div class="offcanvas-header d-md-none">
						<h5 class="offcanvas-title" id="filtersSectionLabel">Filters</h5>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<?php do_action( 'woocommerce_sidebar' ); ?>
						<a href="<?php echo esc_url( $starter_archive_url ); ?>" class="btn btn-outline-primary btn-sm d-none filter_reset_btn js_reset_filters" role="button"><?php esc_html_e( 'Reset', 'starter' ); ?></a>
					</div>
				</div>
				<a href="#" class="Filters filter_block mobile_filters_btn" data-bs-target=".js_filter_section" data-bs-toggle="offcanvas" role="button"><?php esc_html_e( 'Filters', 'starter' ); ?><span class="ml-1 notifications_text badge rounded-pill bg-dark js_all_selected_filter"></span></a>
			<?php endif; ?>
		<!-- END filters layout -->

		<div class="Posts">
		<?php
		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();
				global $product;
				echo "<div class='wraper_product js_product'>";
				$starter_img_sizes = '(max-width: 575px) calc(50vw - 10px), (max-width: 767px) 260px, (max-width: 991px) 216px, (max-width: 1199px) 216px, (max-width: 1399px) 204px, 240px';
				require get_stylesheet_directory() . '/woocommerce-custom/global/product-item.php';
				echo '</div>';
			}
				wp_reset_postdata();
		} else {
			esc_html_e( 'No products found', 'starter' );
		}
			do_action( 'woocommerce_after_shop_loop' );
		?>
		</div>

	</div><!-- .Layout -->

</div><!-- .entry-content -->

</div><!-- .content_wrapper -->

<?php
get_footer();
