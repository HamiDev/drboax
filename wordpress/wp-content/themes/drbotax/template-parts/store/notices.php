<?php
/**
 * WooCommerce notices on pages that do not use WooCommerce templates.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_notice_count' ) || ! function_exists( 'wc_print_notices' ) ) {
	return;
}

if ( wc_notice_count() < 1 ) {
	return;
}
?>
<div class="wrap store-notices">
	<?php wc_print_notices(); ?>
</div>
