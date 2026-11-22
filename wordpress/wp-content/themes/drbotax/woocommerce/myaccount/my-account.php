<?php
/**
 * My Account page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Drbotax
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="account-shell">
	<?php
	/**
	 * My Account navigation.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_navigation' );
	?>

	<div class="woocommerce-MyAccount-content account-panel">
		<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
		?>
	</div>
</div>
