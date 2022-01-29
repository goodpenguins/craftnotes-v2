<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<div class="you">
	<p>
		<?php
			printf(
				/* translators: 1: user display name 2: logout url */
				__( 'Hello %1$s', 'woocommerce' ),
				'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
			);
		?>
	</p>
</div>

<?php 
// $user_id    = get_current_user_id();
// $user       = get_userdata($user_id);
// $username   = $user->user_login;
// $first_name = $user->first_name;
// $last_name  = $user->last_name;

// $ref_id = get_user_meta( get_current_user_id(), 'gens_referral_id', true );
// $ref_url = get_site_url() . '?raf=' . $ref_id;
// echo "<div>Ref ID = " . $ref_id . "</div>";
// echo "<div>Ref URL = " . $ref_url . "</div>";

// $all_meta_for_user = get_user_meta($user_id);
// echo "<pre>"; var_dump($all_meta_for_user); echo "</pre>";

?>




<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
