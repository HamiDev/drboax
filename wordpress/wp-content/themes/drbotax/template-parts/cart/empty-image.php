<?php
/**
 * Empty cart illustration.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_image = drbotax_empty_cart_image_url();

if ( '' === $drbotax_image ) {
	return;
}
?>
<figure class="empty-cart__visual">
	<img
		class="empty-cart__image"
		src="<?php echo esc_url( $drbotax_image ); ?>"
		alt=""
		width="1024"
		height="682"
		loading="eager"
		decoding="async"
	>
</figure>
