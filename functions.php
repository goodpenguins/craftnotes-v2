<?php
/**
 * Functions and definitions
 *
 * @package starter
 * @since starter 1.0
 */

/**
 * Manage assets
 */
require_once get_stylesheet_directory() . '/inc/assets.php';

/**
 * Customizer.
 */
require_once get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Image function & settings.
 */
require_once get_stylesheet_directory() . '/inc/image.php';

/**
 * Menu improvements: icons, font-size, colors and more.
 */
require_once get_stylesheet_directory() . '/inc/menu.php';

/**
 * Recaptcha feature
 */
require_once get_stylesheet_directory() . '/inc/recaptcha.php';

/**
 * WYSIWYG improvements: remove "Add media" button, add font-sizes/font-families/line-height/letter-spacing.
 */
require_once get_stylesheet_directory() . '/inc/tiny-mce-advanced.php';

/**
 * Twentyseventeen function forks: setup, unique id, icon-func
 */
require_once get_stylesheet_directory() . '/inc/twentyseventeen-functions.php';

/**
 * Include woocommerce funstions if plugin enabled.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_stylesheet_directory() . '/inc/woocommerce/woocommerce.php';
}

/**
 * Custom path save acf fields.
 *
 * @since starter 1.0
 *
 * @param string $path .
 */
function starter_custom_acf_save( $path ) {
	$path = get_stylesheet_directory() . '/inc/acf-json';
	return $path;
}
add_filter( 'acf/settings/save_json', 'starter_custom_acf_save' );

/**
 * Custom path load acf fields.
 *
 * @since starter 1.0
 *
 * @param string $paths .
 */
function starter_custom_acf_load( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'starter_custom_acf_load' );

/**
 * Add analytics code into <head>.
 *
 * @since starter 1.2
 */
function starter_add_analytics() {
	// @codingStandardsIgnoreStart can't filtered due unknow what code could be
	echo get_theme_mod( 'analytics', '' );
	// @codingStandardsIgnoreEnd
}
add_action( 'wp_head', 'starter_add_analytics' );

/**
 * Remove widget block editor
 */
add_filter( 'use_widgets_block_editor', '__return_false' );
