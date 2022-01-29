<?php
/**
* My Account
*/

function theme_remove_my_account_links( $menu_links ){
  // unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	// unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	// unset( $menu_links['edit-address'] ); // Addresses
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link

  return $menu_links;
}
add_filter ( 'woocommerce_account_menu_items', 'theme_remove_my_account_links' );

// Number of orders and Message in My account Dashboard
function wc_get_customer_orders() {
  
  // Get customer object
  $customer = wp_get_current_user();

  // Get orders by ref_id
  $ref_id = get_user_meta( get_current_user_id(), 'gens_referral_id', true );
	$ref_orders = get_posts( array(
			'numberposts' => -1,
			'meta_key'    => '_raf_id',
			'meta_value'  => $ref_id,
			'post_type'   => wc_get_order_types(),
			'post_status' => array_keys( wc_get_order_statuses() ),
	) );

  echo "You have " . count( $ref_orders ) . " referral orders.";

  // Order count for a "loyal" customer
  $loyal_count = 5;
  
  // Text for our "thanks for loyalty" message
  $notice_text = sprintf( 'Hey %1$s &#x1f600; We noticed you\'ve placed more than %2$s orders with us – thanks for being a loyal customer!', $customer->display_name, $loyal_count );

  // Display our notice if the customer has at least 5 orders
  if ( count( $ref_orders ) >= $loyal_count ) {
      wc_print_notice( $notice_text, 'notice' );
  }
}
add_action( 'woocommerce_before_my_account', 'wc_get_customer_orders' );