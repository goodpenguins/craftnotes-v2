<?php
/**
 * Woocommerce Tabs function & settings
 *
 * @package amani plus
 * @author Constantine Vasilyev
 */

defined( 'ABSPATH' ) || exit;


/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', function ( $tabs ) {

  // unset( $tabs['description'] );
  // unset( $tabs['reviews'] );
  // unset( $tabs['additional_information'] );

  return $tabs;
} );



/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'add_product_tabs' );
function add_product_tabs( $tabs ) {
	
	$tabs['cn_description'] = array(
		'title' 	=> __( 'Description', 'woocommerce' ),
		'priority' 	=> 5,
		'callback' 	=> 'description_tab_content'
	);
	$tabs['cn_map'] = array(
		'title' 	=> __( 'Map', 'woocommerce' ),
		'priority' 	=> 10,
		'callback' 	=> 'map_tab_content'
	);
	$tabs['cn_curated'] = array(
		'title' 	=> __( 'Curated', 'woocommerce' ),
		'priority' 	=> 15,
		'callback' 	=> 'curated_tab_content'
	);
	$tabs['cn_info'] = array(
		'title' 	=> __( 'Info', 'woocommerce' ),
		'priority' 	=> 20,
		'callback' 	=> 'info_tab_content'
	);

	return $tabs;

}

function description_tab_content() {
	$tabs = get_field('product_tabs_group');
  echo $tabs['product_description'];
}
function map_tab_content() {
	$tabs = get_field('product_tabs_group');
  echo $tabs['product_map'];
}
function curated_tab_content() {
	$tabs = get_field('product_tabs_group');
  echo $tabs['product_curated'];
}
function info_tab_content() {
	$tabs = get_field('product_tabs_group');
  echo $tabs['product_info'];
}