<?php
/**
 * Cart block presentation.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'render_block_woocommerce/empty-cart-block', 'drbotax_prepend_empty_cart_image' );

/**
 * Place the theme illustration inside the Cart block empty state.
 *
 * The Cart block replaces woocommerce/cart/cart-empty.php, so the classic
 * empty-cart template never renders on the block cart page.
 *
 * @param string $content Rendered empty-cart block.
 * @return string
 */
function drbotax_prepend_empty_cart_image( $content ) {
	if ( ! is_string( $content ) || false !== strpos( $content, 'empty-cart__image' ) ) {
		return $content;
	}

	ob_start();
	get_template_part( 'template-parts/cart/empty-image' );
	$image = (string) ob_get_clean();

	if ( '' === trim( $image ) ) {
		return $content;
	}

	$marker = 'wp-block-woocommerce-empty-cart-block';
	$pos    = strpos( $content, $marker );

	if ( false === $pos ) {
		return $image . $content;
	}

	$close = strpos( $content, '>', $pos );

	if ( false === $close ) {
		return $image . $content;
	}

	return substr( $content, 0, $close + 1 ) . $image . substr( $content, $close + 1 );
}
