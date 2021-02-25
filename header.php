<?php
/**
 * The header for our theme
 *
 * @package starter
 */

$starter_is_logged        = is_user_logged_in() ? ' user_logged' : ' user_unlogged';
$starter_ajax_filter_sort = get_theme_mod( 'product_filter_sort_ajax', true ) ? ' product_filter_sort_ajax' : '';
$starter_ajax_pagination  = get_theme_mod( 'product_pagination_ajax', true ) ? ' product_pagination_ajax' : '';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>

<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-156564336-1', 'auto');
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->

</head>
<body id="topPage" class="<?php echo esc_attr( $starter_is_logged . $starter_ajax_filter_sort . $starter_ajax_pagination ); ?>">
<a href="#topPage" class="scrollup js_scrollto" role="button" aria-label="<?php esc_attr_e( 'Scroll to top', 'starter' ); ?>">
	<?php echo starter_get_svg( array( 'icon' => 'arrow-up' ) ); ?>
</a>
<div class="main_wrap">
	<header class="main_header">
		<!-- TOP NAV AREA -->
			<?php if ( has_nav_menu( 'header_top_nav' ) ) : ?>
				<div class="header_top_nav">
					<div class="container">
						<nav aria-label="<?php esc_attr_e( 'Header Top Nav', 'starter' ); ?>">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'header_top_nav',
										'menu_class'     => 'menu list',
									)
								);
							?>
						</nav>
					</div>
				</div>
			<?php endif; ?>
		<!-- END TOP NAV AREA -->

		<!-- TOP MOBILE NAV AREA -->
			<?php if ( has_nav_menu( 'header_top_nav_mobile' ) ) : ?>
				<nav class="header_top_nav_mobile" aria-label="<?php esc_attr_e( 'Header Top Mobile Nav', 'starter' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header_top_nav_mobile',
								'menu_class'     => 'menu list',
							)
						);
					?>
				</nav>
			<?php endif; ?>
		<!-- END TOP MOBILE NAV AREA -->

		<!-- MAIN NAV AREA -->
			<?php if ( has_nav_menu( 'header_main_nav' ) ) : ?>
				<div class="header_main_nav">
					<div class="container">
						<nav class="jsInnerNav" aria-label="<?php esc_attr_e( 'Header Main Nav', 'starter' ); ?>">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'header_main_nav',
										'menu_class'     => 'menu list',
									)
								);
							?>
						</nav>
					</div>
				</div>
			<?php endif; ?>
		<!-- END MAIN NAV AREA -->

		<!-- MOBILE NAV AREA -->
			<?php if ( has_nav_menu( 'header_main_nav_mobile' ) ) : ?>
				<nav class="header_main_nav_mobile" aria-label="<?php esc_attr_e( 'Header Mobile Nav', 'starter' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header_main_nav_mobile',
								'menu_class'     => 'menu list',
							)
						);
					?>
				</nav>
			<?php endif; ?>
		<!-- END MOBILE NAV AREA -->

	</header>
